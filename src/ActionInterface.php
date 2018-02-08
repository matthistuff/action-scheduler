<?php
/**
 *
 */

namespace ActionScheduler;


interface ActionInterface {

	/**
	 * Execute the Action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function execute();

	/**
	 * Get the hook for the Action.
	 *
	 * @author Jeremy Pry
	 * @return string
	 */
	public function get_hook();

	/**
	 * Get the arguments used for the Action.
	 *
	 * @author Jeremy Pry
	 * @return array
	 */
	public function get_args();
}
