<?php

// define current unix timestamp
define('TIME_NOW', time());

// define version
define('MATA_VERSION', '0.1210.14 Alpha');

/**
* Provides the application central class.
* 
* @author     MadnessFreak <madnessfreak@happyduckz.co>
* @copyright  2014 MadnessFreak
* @package    Matavior
*/
class Mata {
	/**
	 * template object
	 * @var	\Template\TemplateWrapper
	 */
	protected static $templateObj = null;
	/**
	 * session object
	 * @var	\Session
	 */
	protected static $sessionObj = null;
	/**
	 * language object
	 * @var	\Language
	 */
	protected static $langObj = null;
	/**
	 * database object
	 * @var	\Database\Database
	 */
	protected static $dbObj = null;

	/* ************************************************ */

	/**
	 * Initializes Matavoir.
	 */
	public static function init() {
		// set error handler
		self::seterrh();

		// preload
		self::preload();

		// init
		self::initTemplateEngine();
		self::initSession();
		self::initLang();
		self::initDatabase();

		// assign
		Mata::getTPL()->assign('SESSION', $_SESSION);
		Mata::getTPL()->assign('cookie', $_COOKIE);

		/*Mata::getTPL()->assign('notifications', array(
			array('id' => 1, 'asd')
			));*/

		Mata::getTPL()->assign('messages', array(
			array('id' => 1, 'asd')
			));

		if (Mata::getUser() !== null) {
			Mata::getTPL()->assign('user', Mata::getUser()->getUserData());
		}

		// debug
		Debug::add('SESSION', print_r($_SESSION, true));

		

		// display debug
		if (self::debugModeIsEnabled()) Debug::display();

		// handle
		self::handle();
	}
	
	/* ************************************************ */
	
	/**
	 * Returns true if the debug mode is enabled, otherwise false.
	 * 
	 * @return	boolean
	 */
	public static function debugModeIsEnabled() {
		if (defined('ENABLE_DEBUG_MODE') && ENABLE_DEBUG_MODE) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Sets the exception handler.
	 */
	protected static function seterrh() {
		// set exception handler
		set_exception_handler(array(__CLASS__, 'handleException'));

		// set php error handler
		set_error_handler(array(__CLASS__, 'handleError'), E_ALL);
	}
	
	/**
	 * Preloads essential classes and registers the autoloader.
	 */
	protected static function preload() {
		// include
		require_once 'Config/options.inc.php';
		require_once 'Utility.php';
		require_once 'Autoloader.php';

		// register
		Autoloader::register();
	}

	/**
	 * Initializes the template engine.
	 */
	protected static function initTemplateEngine() {
		// create
		self::$templateObj = new TemplateEngine();

		// assign
		$defines = get_defined_constants(true)['user'];
		foreach ($defines as $key => $value) {
			self::$templateObj->assign($key, $value);
		}

		// add subsearch
		Mata::getTPL()->addFunction(new Twig_SimpleFunction('subsearch', function($key, $value, $array) {
			foreach ($array as $sub) {
				if (array_key_exists($key, $sub) && $sub[$key] == $value) return true;
			}
			return false;
		}));

		// add timeago
		Mata::getTPL()->addFilter(new Twig_SimpleFilter('timeago', function($timestamp) {
			$time = TIME_NOW - $timestamp;

			$units = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'minute',
				1 => 'second'
			);

			foreach ($units as $unit => $val) {
				if ($time < $unit) continue;
				$numberOfUnits = floor($time / $unit);
				return ($val == 'second') ? 'a few seconds ago' : (($numberOfUnits>1) ? $numberOfUnits : 'a').' '.$val.(($numberOfUnits>1) ? 's' : '').' ago';
			}

			return 'just now';
		}));

		// add timeago
		Mata::getTPL()->addFilter(new Twig_SimpleFilter('avatar', function($avatarID) {
			if ($avatarID == 0) {
				return "/images/avatar/default.png";
			} else {
				return "/images/avatar/upload/$avatarID.png";
			}
		}));

		// add string loader
		//Mata::getTPL()->addExtension(new Twig_Extension_StringLoader());
	}

	/**
	 * Initializes the session.
	 */
	protected static function initSession() {
		self::$sessionObj = new Session();
	}

	/**
	 * Initializes the language.
	 */
	protected static function initLang() {
		// set lang
		Mata::setLang(empty($_COOKIE['mata_lang']) ? 'en' : $_COOKIE['mata_lang']);
		
		// add filter
		Mata::getTPL()->addFilter(new Twig_SimpleFilter('lang', function($key) {
			return Mata::getLang()->get($key);
		}));
	}

	/**
	 * Initializes the database.
	 */
	private static function initDatabase() {
		// get configuration
		$dbHost = $dbUser = $dbPassword = $dbName = '';
		$dbPort = 0;

		// include configuration
		require_once Utility::unidir(SYS_DIR.'Config/database.inc.php');

		// create database connection
		self::$dbObj = new Database($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);
	}
	
	/**
	 * Handles the request.
	 */
	protected static function handle() {
		Request::handle();
		Invoker::invoke(Request::getPage());
	}

	public static function getTPL() {
		return self::$templateObj;
	}

	public static function getSession() {
		return self::$sessionObj;
	}

	public static function getLang() {
		return self::$langObj;
	}

	public static function setLang($language) {
		// set lang
		self::$langObj = Language::load(SYS_DIR.'/Lang/'.$language.'.xml');

		// set cookie
		setcookie('mata_lang', $language, time() + 60 * 60 * 24 * 90, '/');

		// assign lang info
		Mata::getTPL()->assign('language', array(
			'code' => self::$langObj->getCode(),
			'name' => self::$langObj->getName()
		));
	}

	public static function getDB() {
		return self::$dbObj;
	}

	public static function getUser() {
		return self::$sessionObj->user == false ? null : self::$sessionObj->user;
	}

	public static function setUser($user) {
		self::$sessionObj->register('user', $user);
	}
	
	/* ************************************************ */
	
	/**
	 * Calls the show method on the given exception.
	 * 
	 * @param	\Exception	$e
	 */
	public static final function handleException(Exception $e) {
		try {
			if ($e instanceof SystemException) {
				$e->show();
				exit;
			}
			elseif ($e instanceof UserException) {
				$e->show();
				exit;
			}
			else {
				// repack exception
				self::handleException(new SystemException($e->getMessage(), $e->getCode(), '', $e));
				exit();

				// show exception
				$e->show();
			}
		}
		catch (Exception $exception) {
			die("<pre>Mata::handleException() Unhandled exception: ".$exception->getMessage()."\n\n".$exception->getTraceAsString());
		}
	}
	
	/**
	 * Catches php errors and throws instead a system exception.
	 * 
	 * @param	integer		$errorNo
	 * @param	string		$message
	 * @param	string		$filename
	 * @param	integer		$lineNo
	 */
	public static final function handleError($errorNo, $message, $filename, $lineNo) {
		if (error_reporting() != 0) {
			$type = 'error';
			switch ($errorNo) {
				case 2: $type = 'warning';
					break;
				case 8: $type = 'notice';
					break;
			}
			
			throw new SystemException('PHP '.$type.' in file '.$filename.' ('.$lineNo.'): '.$message, 0);
		}
	}
}
