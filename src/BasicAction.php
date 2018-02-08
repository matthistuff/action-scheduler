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
	 * BasicAction constructor.
	 *
	 * @param string $hook
	 * @param array  $args
	 */
	public function __construct( $hook, array $args ) {
		$this->hook     = $hook;
		$this->args     = $args;
	}

	public function execute() {
		do_action_ref_array( $this->get_hook(), $this->get_args() );
	}

	public function get_hook() {
		return $this->hook;
	}

	public function get_args() {
		return $this->args;
	}
}
