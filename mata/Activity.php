<?php

class Activity {
	/**
	 * event type wall
	 * @var	integer
	 */
	const WALL = 4;
	/**
	 * event type message
	 * @var	integer
	 */
	const MESSAGE = 2;
	/**
	 * event type test
	 * @var	integer
	 */
	const TEST = 3;

	/**
	 * Adds a new action to the current user.
	 *
	 * @param	int		$eventType
	 * @param	int		$userID
	 * @param	int		$objectID
	 * @param	string	$objectData
	 * @return	mixed
	 */
	public static function add($eventType, $userID, $objectID, $objectData = '') {
		if (Mata::getUser() === null) return null;

		$sql = "INSERT INTO	mata_activity
							(objectID, objectData, userID, eventID, timeTriggered)
				VALUES		(?, ?, ?, ?, ?)";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$objectID,
			$objectData,
			Mata::getUser()->userID,
			$eventType,
			TIME_NOW
		));

		return Mata::getDB()->getInsertID('mata_activity', 'activityID');
	}

	public static function get($userID) {
		if (Mata::getUser() === null) return array();

		$sql = "SELECT		activity.*, event.eventName
				FROM		mata_activity activity
				LEFT JOIN	mata_event event ON (activity.eventID = event.eventID)
				WHERE		activity.userID = ?
				ORDER BY	timeTriggered DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array($userID));
		$activities = array();

		while ($row = $statement->fetchArray()) {
			array_push($activities, $row);
		}

		return $activities;
	}
}