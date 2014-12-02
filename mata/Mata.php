<?php

// define current unix timestamp
define('TIME_NOW', time());

// define version
define('MATA_VERSION', '0.1120.14');

/**
* Provides the application central class.
* 
* @author     MadnessFreak <madnessfreak@happyduckz.co>
* @copyright  2014 MadnessFreak
* @package    Matavior
*/
class Mata {
	protected static $templateObj = null;
	protected static $sessionObj = null;
	protected static $langObj = null;

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
		require_once 'Config/Config.inc.php';
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
	}

	/**
	 * Initializes the session.
	 */
	protected static function initSession() {
		// create
		self::$sessionObj = new Session();

		// assign
		Mata::getTPL()->assign('SESSION', $_SESSION);
	}

	/**
	 * Initializes the language.
	 */
	protected static function initLang() {
		// create
		self::$langObj = Language::load(SYS_DIR.'/Lang/de.xml');
		self::getTPL()->addFilter(new Twig_SimpleFilter('lang', function($key) {
			return Mata::getLang()->get($key);
		}));
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

	public static function getUser() {
		return self::$sessionObj->user;
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
