<?php
/**
 *
 */

namespace ActionScheduler;


class ScheduledAction extends BasicAction implements Scheduled {

	/**
	 * The schedule for the action.
	 *
	 * @var \ActionScheduler_Schedule
	 */
	protected $schedule;

	/**
	 * BasicAction constructor.
	 *
	 * @param string                    $hook
	 * @param array                     $args
	 * @param \ActionScheduler_Schedule $schedule
	 */
	public function __construct( $hook, array $args, $schedule ) {
		parent::__construct( $hook, $args );
		$this->schedule = $schedule;
	}

	/**
	 * Get the schedule for the action.
	 *
	 * @author Jeremy Pry
	 * @return \ActionScheduler_Schedule
	 */
	public function get_schedule() {
		return $this->schedule;
	}
}
