<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class MembersTeamController extends AbstractController {
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
		$sql = "SELECT		user.userID, user.username, user.primaryGroup, user.avatarID,
							groups.groupName, groups.userOnlineMarking,
							sessions.userID as session
				FROM		mata_users user
				LEFT JOIN	mata_groups groups ON (user.primaryGroup = groups.groupID)
				LEFT JOIN	mata_session sessions ON (user.userID = sessions.userID)
				WHERE		groups.showOnTeamPage = 1
				ORDER BY	user.username ASC";
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