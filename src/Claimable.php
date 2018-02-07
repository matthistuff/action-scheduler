<?php
/**
 *
 */

namespace ActionScheduler;


interface Claimable {

	/**
	 * Get the claim ID of the action.
	 *
	 * @author Jeremy Pry
	 * @return mixed
	 */
	public function get_claim_id();
}
