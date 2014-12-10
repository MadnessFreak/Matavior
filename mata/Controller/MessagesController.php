<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class MessagesController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// login required
		$this->loginRequired = true;

		// check if active user is logged in
		if (Mata::getSession()->loggedIn) {
			// call basic methods
			$this->addMessages();

			// check permission
			$this->checkPermissions();
		}		

		// show
		parent::init();
	}

	public function addMessages() {
		// prepare
		$sql = "SELECT		notification.*, event.*, users.username as authorName
				FROM		mata_user_to_notification user
				LEFT JOIN	mata_notifications notification ON (user.notificationID = notification.notificationID)
				LEFT JOIN	mata_event event ON (event.eventID = notification.eventID)
				LEFT JOIN	mata_users users ON (users.userID = notification.authorID)
				WHERE		user.userID = ?
				ORDER BY	notification.timeTriggered DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(Mata::getUser()->userID));
		$messages = array();
		
		// fetch
		while ($row = $statement->fetchArray()) {
			array_push($messages, $row);
		}

		Mata::getTPL()->assign('messages', $messages);
	}
}