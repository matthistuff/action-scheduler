<?php
/**
 *
 */

namespace ActionScheduler;


interface Scheduled extends ActionInterface {

	/**
	 * Get the schedule for the action.
	 *
	 * @author Jeremy Pry
	 * @return \ActionScheduler_Schedule
	 */
	public function get_schedule();
}
