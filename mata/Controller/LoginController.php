<?php
/**
 * Shows the index page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class LoginController extends AbstractController {
	protected $referer = '';
	protected $user = null;

	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// check permission
		$this->checkPermissions();

		// read
		$this->readParameters();

		// show
		parent::init();
	}

	/**
	 * @see	\Controller\IController::readParameters()
	 */
	public function readParameters() {
		if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

		$fields = array();
		$error = array(
			'type' => 'danger',
			'message' => 'Please correct the erroneous fields marked below.'
			);

		if (empty($_POST['password'])) {
			array_push($fields, 'password');
		}

		if (empty($_POST['username'])) {
			array_push($fields, 'username');
		} else {
			$this->user = User::getUserByUsername($_POST['username']);

			if ($this->user->username == false) {
				array_push($fields, 'username');
				$error['message'] = 'The entered username does not exist.';
			} else {
				if (md5($_POST['password']) == $this->user->password) {
					$error['type'] = 'success';
					$error['message'] = Mata::getLang()->get('mata.global.login.success') . '<br>' . Mata::getLang()->get('mata.global.redirection');
				} else {
					array_push($fields, 'password');
					$error['message'] = 'The entered password is wrong.';
				}
			}
		}

		if (isset($_POST['remember'])) {
			setcookie('mata_remember', $_POST['remember'] == 'on' ? true : false, time()+60*60*24*90, '/');
		}
		if (isset($_POST['ref'])) {
			$this->referer = $_POST['ref'];
		}

		$error['fields'] = $fields;

		$action = array(
			'method' => $_SERVER['REQUEST_METHOD'],
			'error' => $error
			);

		Mata::getTPL()->assign('action', $action);

		if ($error['type'] == 'success') {
			$this->execute();
		}
	}

	/**
	 * @see	\Controller\IController::checkPermissions()
	 */
	public function checkPermissions() {
		// check if active user is logged in
		if (Mata::getSession()->loggedIn) {
			throw new PermissionDeniedException();
		}
	}

	/**
	 * Performs the login.
	 */
	public function execute() {
		// login
		Mata::setUser($this->user);
		Mata::getSession()->register('loggedIn', true);
		Mata::getSession()->register('userID', Mata::getSession()->user->userID);
		Mata::getSession()->register('username', Mata::getSession()->user->username);

		$sql = "UPDATE		mata_users user
				SET			user.lastActivityTime = ?
				WHERE		user.userID = ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			TIME_NOW,
			Mata::getSession()->user->userID
		));

		// refresh
		header("Refresh: 3; /dashboard"/* . (!empty($this->referer) ? $this->referer : '/dashboard')*/);
	}
}