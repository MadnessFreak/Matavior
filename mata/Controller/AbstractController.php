<?php
/**
 * Provides the callback for handling requests.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
abstract class AbstractController implements IController {
	/**
	 * indicates if you need to be logged in to access this page
	 * @var	boolean
	 */
	public $loginRequired = false;

	/**
	 * needed permissions to view this page
	 * @var	array<string>
	 */
	public $neededPermissions = array();

	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		// call default methods
		$this->show();
	}

	/**
	 * @see	\Controller\IController::checkPermissions()
	 */
	public function checkPermissions() {
	}

	/**
	 * @see	\Controller\IController::show()
	 */
	public function show() {
		// check if active user is logged in
		if ($this->loginRequired && !Mata::getUser()->userID) {
			throw new PermissionDeniedException();
		}

		// check permission
		$this->checkPermissions();

		// show template
		Mata::getTPL()->display();
	}
}