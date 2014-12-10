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

		// check
		$this->checkNotificationFlyout();

		// add data
		$this->addData();

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
					FROM		mata_navigation
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

	public function addData() {
		if (Mata::getUser() === null) return;

		$sql = "SELECT		COUNT(notification.notificationID) as notificationCount
				FROM		mata_user_to_notification user
				LEFT JOIN	mata_notifications notification ON (user.notificationID = notification.notificationID)
				WHERE		user.userID = ? AND notification.timeRead = 0";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(Mata::getUser()->userID));
		
		Mata::getTPL()->assign('notificationCount', $statement->fetchArray()['notificationCount']);
	}

	public function checkNotificationFlyout() {
		$reference = isset(Request::getParams()['ref']) ? Request::getParams()['ref'] : '';
		$objectID = isset(Request::getParams()['refid']) && is_numeric(Request::getParams()['refid']) ? Request::getParams()['refid'] : 0;

		if ($reference != 'notyflyout') return;
		
		$sql = "UPDATE		mata_notifications noty
				SET			noty.timeRead = ?
				WHERE		noty.notificationID = ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			TIME_NOW,
			$objectID
		));
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