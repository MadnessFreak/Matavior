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
		// login
		Mata::getSession()->register('LoggedIn', true);

		// refresh
		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/index';
		header("Refresh: 3; $referer");

		// show
		parent::show();
	}

	/**
	 * @see	\Controller\IController::checkPermissions()
	 */
	public function checkPermissions() {
		//throw new PermissionDeniedException();
	}
}