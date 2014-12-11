<?php
/**
 * Shows the dashboard page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class DashboardController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// add
		$this->addMembers();
		
		// show
		parent::init();
	}

	public function addMembers() {
		$sql = "SELECT		session.*, user.userID, user.username
				FROM		mata_session session
				LEFT JOIN	mata_users user ON (user.userID = session.userID)
				ORDER BY	user.username ASC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();
		$members = array();
		$guests = 0;
		
		// fetch
		while ($row = $statement->fetchArray()) {
			if ($row['userID']) {
				array_push($members, $row);
			} else {
				$guests++;
			}
		}

		Mata::getTPL()->assign('memberOnlineList', $members);
		Mata::getTPL()->assign('memberOnlineCount', count($members));
		Mata::getTPL()->assign('guestOnlineCount', $guests);

		$sql = "SELECT		COUNT(user.userID) as count
				FROM		mata_users user";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();

		Mata::getTPL()->assign('memberTotalCount', $statement->fetchArray()['count']);

		$sql = "SELECT		COUNT(wall.entryID) as count
				FROM		mata_user_wall wall";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();

		Mata::getTPL()->assign('wallPostTotalCount', $statement->fetchArray()['count']);

		$sql = "SELECT		user.userID, user.username
				FROM		mata_users user
				ORDER BY	user.userID DESC
				LIMIT		1";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();

		Mata::getTPL()->assign('latestMember', $statement->fetchArray());
	}
}