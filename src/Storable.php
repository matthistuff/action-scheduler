<?php
/**
 *
 */

namespace ActionScheduler;


interface Storable {

	/**
	 * Get the ID of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_id();

	/**
	 * Get the status of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_status();
}
