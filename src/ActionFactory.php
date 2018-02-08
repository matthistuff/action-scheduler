<?php
/**
 *
 */

namespace ActionScheduler;


class ActionFactory {

	public static function storable_scheduled_action( $hook, $args, $when, $id, $claim_id, $status ) {
		$schedule     = new \ActionScheduler_SimpleSchedule( as_get_datetime_object( $when ) );
		$scheduled_action = new ScheduledAction( $hook, $args, $schedule );

		return new StoredAction( $scheduled_action, $id, $claim_id, $status );
	}


	public static function storable_action( $hook, $args, $id, $claim_id, $status ) {
		$action = new BasicAction( $hook, $args );

		return new StoredAction( $action, $id, $claim_id, $status );
	}
}
