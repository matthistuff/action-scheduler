<?php
/**
 *
 */

namespace ActionScheduler;


class StoredAction implements Storable, Claimable, ActionInterface {

	/**
	 * The base action.
	 *
	 * @var ActionInterface
	 */
	protected $action;

	/**
	 * The claim ID.
	 *
	 * @var int
	 */
	protected $claim_id;

	/**
	 * The action ID.
	 *
	 * @var int
	 */
	protected $id;

	/**
	 * The action status.
	 *
	 * @var string
	 */
	protected $status;

	/**
	 * StoredAction constructor.
	 *
	 * @param ActionInterface $action
	 * @param int             $id
	 * @param int             $claim_id
	 * @param string          $status
	 */
	public function __construct( ActionInterface $action, $id, $claim_id, $status ) {
		$this->action   = $action;
		$this->id       = $id;
		$this->claim_id = $claim_id;
		$this->status   = $status;
	}

	/**
	 * Get the claim ID of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_claim_id() {
		return $this->claim_id;
	}

	/**
	 * Get the ID of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get the status of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_status() {
		return $this->status;
	}

	/**
	 * Execute the Action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function execute() {
		return $this->action->execute();
	}

	/**
	 * Get the hook for the Action.
	 *
	 * @author Jeremy Pry
	 * @return string
	 */
	public function get_hook() {
		return $this->action->get_hook();
	}

	/**
	 * Get the schedule for the Action.
	 *
	 * @author Jeremy Pry
	 * @return \ActionScheduler_Schedule
	 */
	public function get_schedule() {
		return $this->action->get_schedule();
	}

	/**
	 * Get the arguments used for the Action.
	 *
	 * @author Jeremy Pry
	 * @return array
	 */
	public function get_args() {
		return $this->action->get_args();
	}
}
