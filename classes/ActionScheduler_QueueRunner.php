<?php

/**
 * Class ActionScheduler_QueueRunner
 */
class ActionScheduler_QueueRunner {
	const WP_CRON_HOOK = 'action_scheduler_run_queue';

	const WP_CRON_SCHEDULE = 'every_minute';

	/** @var ActionScheduler_QueueRunner  */
	private static $runner = NULL;
	/** @var ActionScheduler_Store */
	private $store = NULL;

	/**
	 * @return ActionScheduler_QueueRunner
	 * @codeCoverageIgnore
	 */
	public static function instance() {
		if ( empty(self::$runner) ) {
			$class = apply_filters('action_scheduler_queue_runner_class', 'ActionScheduler_QueueRunner');
			self::$runner = new $class();
		}
		return self::$runner;
	}

	public function __construct( ActionScheduler_Store $store = NULL ) {
		$this->store = $store ? $store : ActionScheduler_Store::instance();
	}

	/**
	 * @codeCoverageIgnore
	 */
	public function init() {

		add_filter( 'cron_schedules', array( self::instance(), 'add_wp_cron_schedule' ) );

		if ( !wp_next_scheduled(self::WP_CRON_HOOK) ) {
			$schedule = apply_filters( 'action_scheduler_run_schedule', self::WP_CRON_SCHEDULE );
			wp_schedule_event( time(), $schedule, self::WP_CRON_HOOK );
		}

		add_action( self::WP_CRON_HOOK, array( self::instance(), 'run' ) );
	}

	public function run() {
		do_action( 'action_scheduler_before_process_queue' );
		$this->run_cleanup();
		$count = 0;
		$batch_size = apply_filters( 'action_scheduler_queue_runner_batch_size', 10 );
		do {
			$actions_run = $this->do_batch( $batch_size );
			$count += $actions_run;
		} while ( $actions_run > 0 ); // keep going until we run out of actions, time, or memory
		do_action( 'action_scheduler_after_process_queue' );
		return $count;
	}

	protected function run_cleanup() {
		$cleaner = new ActionScheduler_QueueCleaner( $this->store );
		$cleaner->delete_old_actions();
		$cleaner->reset_timeouts();
	}

	protected function do_batch( $size = 10 ) {
		$claim = $this->store->stake_claim($size);
		foreach ( $claim->get_actions() as $action_id ) {
			$this->process_action( $action_id );
		}
		return count($claim->get_actions());
	}

	protected function process_action( $action_id ) {
		$action = $this->store->fetch_action( $action_id );
		do_action( 'action_scheduler_before_execute', $action_id );
		try {
			$this->store->log_execution( $action_id );
			$action->execute();
			do_action( 'action_scheduler_after_execute', $action_id );
		} catch ( Exception $e ) {
			do_action( 'action_scheduler_failed_execution', $action_id, $e );
		}
		$this->store->mark_complete( $action_id );
		$this->schedule_next_instance( $action );
	}

	protected function schedule_next_instance( ActionScheduler_Action $action ) {
		$next = $action->get_schedule()->next( new DateTime() );
		if ( $next ) {
			$this->store->save_action( $action, $next );
		}
	}

	public function add_wp_cron_schedule( $schedules ) {
		$schedules['every_minute'] = array(
			'interval' => 60, // in seconds
			'display'  => __( 'Every minute' ),
		);

		return $schedules;
	}
}
 