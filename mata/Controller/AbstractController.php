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
		// call basic methods
		$this->addNavigation();

		// call default methods
		$this->show();
	}

	public function addNavigation() {
		$navigation = array(
			array('navID' => 1, 'navName' => 'Dashboard', 'navLink' => 'dashboard'),
			array('navID' => 2, 'navName' => 'Members', 'navLink' => 'members'),
			array('navID' => 3, 'navName' => 'Team', 'navLink' => 'members/team'),
			array('navID' => 4, 'navName' => 'Blog', 'navLink' => 'blog'),
			array('navID' => 5, 'navName' => 'Community', 'navLink' => 'community'),
			array('navID' => 6, 'navName' => 'Search', 'navLink' => 'search')
			);

		Mata::getTPL()->assign('navigation', $navigation);
	}

	public function addPagination($count = 1) {
		$value = Request::getValue();
		$action = Request::getAction();
		$value = empty($value) ? 1 : $value;
		$page = !empty($action) && $action != 'page' ? 1 : $value;

		if (is_numeric($page)) {
			Mata::getTPL()->assign('paginationActive', $page);
			Mata::getTPL()->assign('paginationCount', $count);
		} else {
			throw new UserException("Pagination page number is not valid ($page)");
		}

		return $page;
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
		if ($this->loginRequired && !Mata::getSession()->loggedIn) {
			throw new PermissionDeniedException();
		}

		// show template
		Mata::getTPL()->display();
	}
}