<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class MembersProfileController extends AbstractController {
	/**
	 * user id
	 */
	protected $userID = 0;

	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// read data
		$this->readParamerters();

		// call basic methods
		$this->addMember(Request::getValue());
		$this->addWallEntries();
		$this->addActivities();
		
		// check permission
		$this->checkPermissions();

		// show
		parent::init();
	}

	public function readParamerters() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') return;
		if (!isset($_POST['action']) && $_POST['action'] != 'postonwall') return;

		$userID = (isset($_POST['userID']) && is_numeric($_POST['userID']) ? $_POST['userID'] : 0);
		$authorID = (isset($_POST['authorID']) && is_numeric($_POST['authorID']) ? $_POST['authorID'] : 0);
		$content = (isset($_POST['content']) ? trim($_POST['content']) : '');

		$sql = "SELECT		count(wall.timeCreated) as count
				FROM		mata_user_wall wall
				WHERE		wall.userID = ? AND wall.timeCreated >= ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$userID, 
			(TIME_NOW - 30)
		));

		$count = $statement->fetchArray()['count'];

		if ($count == 0) {
			$sql = "INSERT INTO	mata_user_wall
								(userID, authorID, content, timeCreated)
					VALUES		(?, ?, ?, ?)";
			$statement = Mata::getDB()->prepareStatement($sql);
			$statement->execute(array(
				$userID,
				$authorID,
				$content,
				TIME_NOW
			));

			$objectID = Mata::getDB()->getInsertID('mata_user_wall', 'entryID');

			$sql = "INSERT INTO	mata_notifications
								(objectID, eventID, authorID, timeTriggered)
					VALUES		(?, ?, ?, ?)";
			$statement = Mata::getDB()->prepareStatement($sql);
			$statement->execute(array(
				$objectID,
				1, // event wall
				$authorID,
				TIME_NOW
			));

			$notificationID = Mata::getDB()->getInsertID('mata_notifications', 'notificationID');

			$sql = "INSERT INTO	mata_user_to_notification
								(userID, notificationID)
					VALUES		(?, ?)";
			$statement = Mata::getDB()->prepareStatement($sql);
			$statement->execute(array(
				$userID,
				$notificationID
			));

			Activity::add(Activity::WALL, $userID, $objectID, Request::getValue());

			header("Location: /members/profile/" . Request::getValue() . "?tab=wall&entry=" . $objectID);
		}
	}

	public function addMember($username) {
		$sql = "SELECT		user.*,
							groups.groupName, groups.userOnlineMarking,
							sessions.userID as session
				FROM		mata_users user
				LEFT JOIN	mata_groups groups ON (user.primaryGroup = groups.groupID)
				LEFT JOIN	mata_session sessions ON (user.userID = sessions.userID)
				WHERE		user.username = ?
				ORDER BY	user.username ASC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array($username));
		$member = array();
		
		while ($row = $statement->fetchArray()) {
			$this->userID = $row['userID'];
			$member = $row;
			break;
		}

		Mata::getTPL()->assign('member', $member);
	}

	public function addWallEntries() {
		$sql = "SELECT		wall.*, user.username as authorName, user.avatarID as authorAvatarID
				FROM		mata_user_wall wall
				LEFT JOIN	mata_users user ON (wall.authorID = user.userID)
				WHERE		wall.userID = ?
				ORDER BY	wall.timeCreated DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array($this->userID));
		$wall = array();
		
		while ($row = $statement->fetchArray()) {
			array_push($wall, $row);
		}

		Mata::getTPL()->assign('wall', $wall);
	}

	public function addActivities() {
		Mata::getTPL()->assign('activities', Activity::get($this->userID));
	}
}