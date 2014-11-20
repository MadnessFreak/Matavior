<?php
/**
 * Shows the index page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class LoginController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// check permission
		$this->checkPermissions();

		// execute
		$this->execute();

		// show
		parent::init();
	}

	/**
	 * @see	\Controller\IController::checkPermissions()
	 */
	public function checkPermissions() {
		// check if active user is logged in
		if (Mata::getUser()->userID || Mata::getSession()->loggedIn) {
			throw new PermissionDeniedException();
		}
	}

	public function execute() {
		// login
		Mata::setUser(User::create());
		Mata::getSession()->register('loggedIn', true);
		Mata::getSession()->register('userID', Mata::getUser()->userID);
		Mata::getSession()->register('username', Mata::getUser()->username);

		// refresh
		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/index';
		header("Refresh: 3; $referer");
	}
}