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

		if (!isset($_POST['username']) || $_POST['username'] != 'MadnessFreak') {
			array_push($fields, 'username');
			$error['message'] = 'The entered username does not exist.';
		}
		if (!isset($_POST['password']) || $_POST['password'] != 'test123') {
			array_push($fields, 'password');
			$error['message'] = 'The entered password is wrong.';
		}
		if ($_POST['username'] == 'MadnessFreak' && $_POST['password'] == 'test123') {
			$error['type'] = 'success';
			$error['message'] = Mata::getLang()->get('mata.global.login.success') . '<br>' . Mata::getLang()->get('mata.global.redirection');
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
		Mata::setUser(User::create());
		Mata::getSession()->register('loggedIn', true);
		Mata::getSession()->register('userID', Mata::getSession()->user->userID);
		Mata::getSession()->register('username', Mata::getSession()->user->username);

		// refresh
		header("Refresh: 3; " . (!empty($this->referer) ? $this->referer : '/dashboard'));
	}
}