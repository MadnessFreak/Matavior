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
		$this->checkLanguage();
		$this->addNavigation();

		// call default methods
		$this->show();
	}

	public function checkLanguage() {
		if (array_key_exists('language', Request::getParams())) {
			Mata::setLang(Request::getParams()['language']);
		}
	}

	public function addNavigation() {
		$file = 'Navigation.cache';
		$navigation = array();

		// check for cache
		if (Cache::available($file)) {
			$navigation = Cache::unserialize($file);
		} else {
			// prepare
			$sql = "SELECT		*
					FROM		".DB_PREFIX."_navigation
					ORDER BY	showOrder ASC";
			$statement = Mata::getDB()->prepareStatement($sql);
			$statement->execute();
			$navigation = array();
			
			// fetch
			while ($row = $statement->fetchArray()) {
				array_push($navigation, $row);
			}

			// cache
			Cache::serialize($file, $navigation);
		}

		// assign
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