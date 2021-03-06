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

		if (Mata::getSession()->loggedIn) {
			// add account data
			Mata::getTPL()->assign('account', Mata::getUser()->getUserData());
		}

		// show
		parent::init();
	}
}