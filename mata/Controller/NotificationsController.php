<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class NotificationsController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// login required
		$this->loginRequired = true;

		// check if active user is logged in
		if (Mata::getSession()->loggedIn) {
			// check read noty
			$this->checkReadNotification();

			// call basic methods
			$this->addNotifications();

			// check permission
			$this->checkPermissions();
		}

		// show
		parent::init();
	}

	public function addNotifications() {
		// prepare
		$sql = "SELECT		notification.*, event.*, users.username as authorName, users.avatarID as authorAvatarID
				FROM		mata_user_to_notification user
				LEFT JOIN	mata_notifications notification ON (user.notificationID = notification.notificationID)
				LEFT JOIN	mata_event event ON (event.eventID = notification.eventID)
				LEFT JOIN	mata_users users ON (users.userID = notification.authorID)
				WHERE		user.userID = ?
				ORDER BY	notification.timeTriggered DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(Mata::getUser()->userID));
		$notifications = array();
		
		// fetch
		while ($row = $statement->fetchArray()) {
			array_push($notifications, $row);
		}

		Mata::getTPL()->assign('notifications', $notifications);
	}

	public function checkReadNotification() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') return;
		if (!isset($_POST['readnoty']) && !isset($_POST['notificationID']) && !is_numeric($_POST['notificationID'])) return;

		try {
			$notificationID = $_POST['notificationID'];

			$sql = "UPDATE		mata_notifications noty
					SET			noty.timeRead = ?
					WHERE		noty.notificationID = ?";
			$statement = Mata::getDB()->prepareStatement($sql);
			$statement->execute(array(
				TIME_NOW,
				$notificationID
			));
		} catch (Exception $e) {
			@header("Content-Type: application/json");
			die(json_encode(array(
				"sucess" => false, 
				"error" => array(
					"type" => get_class($e),
					"code" => $e->getCode(), 
					"message" => $e->getMessage())
				)
			));
		}

		@header("Content-Type: application/json");
		die(json_encode(array(
			"sucess" => true
			)
		));
	}
}