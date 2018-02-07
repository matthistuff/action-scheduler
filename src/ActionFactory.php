<?php
/**
 *
 */

namespace ActionScheduler;


class ActionFactory {

	public static function storable_action( $hook, $args, $when, $id, $claim_id, $status ) {
		$schedule     = new \ActionScheduler_SimpleSchedule( as_get_datetime_object( $when ) );
		$basic_action = new BasicAction( $hook, $args, $schedule );

		return new StoredAction( $basic_action, $id, $claim_id, $status );
	}
}
