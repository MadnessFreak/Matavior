<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class MembersOnlineController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// call basic methods
		$this->addMembers();

		// check permission
		$this->checkPermissions();

		// show
		parent::init();
	}

	public function addMembers() {
		// prepare
		$sql = "SELECT		session.*, user.userID, user.username
				FROM		mata_session session
				LEFT JOIN	mata_users user ON (user.userID = session.userID)
				ORDER BY	session.lastActivityTime DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();
		$members = array();
		
		// fetch
		while ($row = $statement->fetchArray()) {
			array_push($members, $row);
		}

		Mata::getTPL()->assign('members', $members);
		Mata::getTPL()->assign('membersCount', count($members));

		$sql = "SELECT		groups.groupID, groups.groupName, groups.userOnlineMarking
				FROM		mata_groups groups
				WHERE		groups.showOnTeamPage = 1
				ORDER BY	groups.priority DESC";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();
		$groups = array();
		
		// fetch
		while ($row = $statement->fetchArray()) {
			array_push($groups, $row);
		}

		Mata::getTPL()->assign('teamGroups', $groups);
	}
}