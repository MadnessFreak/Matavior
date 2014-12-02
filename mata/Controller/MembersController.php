<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class MembersController extends AbstractController {
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
		$members = array(
			array('userID' => 1, 'username' => 'MadnessFreak', 'groupName' => 'Administrators'),
			array('userID' => 2, 'username' => 'Arbok', 'groupName' => 'Registered Users'),
			array('userID' => 3, 'username' => 'Bibor', 'groupName' => 'Registered Users'),
			array('userID' => 4, 'username' => 'Bisaflor', 'groupName' => 'Registered Users'),
			array('userID' => 5, 'username' => 'Glumanda', 'groupName' => 'Registered Users'),
			array('userID' => 6, 'username' => 'Habitak', 'groupName' => 'Registered Users'),
			array('userID' => 7, 'username' => 'Ibitak', 'groupName' => 'Registered Users'),
			array('userID' => 8, 'username' => 'Jack', 'groupName' => 'Registered Users'),
			array('userID' => 9, 'username' => 'Kokuna', 'groupName' => 'Registered Users'),
			array('userID' => 10, 'username' => 'Nidoran', 'groupName' => 'Registered Users'),
			array('userID' => 11, 'username' => 'Max', 'groupName' => 'Registered Users'),
			array('userID' => 12, 'username' => 'Nidorina', 'groupName' => 'Registered Users'),
			array('userID' => 13, 'username' => 'Raichu', 'groupName' => 'Registered Users'),
			array('userID' => 14, 'username' => 'Raupy', 'groupName' => 'Registered Users'),
			array('userID' => 15, 'username' => 'Rettan', 'groupName' => 'Registered Users'),
			array('userID' => 16, 'username' => 'Sandan', 'groupName' => 'Registered Users'),
			array('userID' => 17, 'username' => 'Schiggy', 'groupName' => 'Registered Users'),
			array('userID' => 18, 'username' => 'Smettbo', 'groupName' => 'Registered Users'),
			array('userID' => 19, 'username' => 'Tauboga', 'groupName' => 'Registered Users'),
			array('userID' => 20, 'username' => 'Taubsi', 'groupName' => 'Registered Users'),
			array('userID' => 21, 'username' => 'Turtok', 'groupName' => 'Registered Users'),
			array('userID' => 22, 'username' => 'Xenon', 'groupName' => 'Registered Users'),);
		
		$count = count($members);
		$pagination = ceil($count / 15);

		$page = $this->addPagination($pagination);

		Mata::getTPL()->assign('members', $members);
		Mata::getTPL()->assign('membersCount', $count);
		Mata::getTPL()->assign('membersStart', (15 * $page) - 15);
		Mata::getTPL()->assign('membersEnd', 15 * $page);
	}
}