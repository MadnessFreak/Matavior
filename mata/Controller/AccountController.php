<?php
/**
 * Shows the index page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class AccountController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// yo
		$this->loginRequired = true;

		// show
		parent::init();
	}

	/**
	 * @see	\Controller\IController::checkPermissions()
	 */
	public function checkPermissions() {
		//throw new PermissionDeniedException();
	}
}