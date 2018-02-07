<?php
/**
 *
 */

namespace ActionScheduler;


class BasicAction implements ActionInterface {

	/**
	 * The hook for the action.
	 *
	 * @var string
	 */
	protected $hook = '';

	/**
	 * Array of args for the action.
	 *
	 * @var array
	 */
	protected $args = array();

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
	public function __construct( $hook, array $args, \ActionScheduler_Schedule $schedule ) {
		$this->hook     = $hook;
		$this->args     = $args;
		$this->schedule = $schedule;
	}

	public function execute() {
		do_action_ref_array( $this->get_hook(), $this->get_args() );
	}

	public function get_hook() {
		return $this->hook;
	}

	public function get_schedule() {
		return $this->schedule;
	}

	public function get_args() {
		return $this->args;
	}

}
