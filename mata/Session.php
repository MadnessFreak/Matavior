<?php
/**
 * Provides a session object.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Session {
	/**
	 * enable cookie support
	 * @var	boolean
	 */
	protected $useCookies = false;

	/**
	 * indicates if session variables changed and must be saved upon shutdown
	 * @var	boolean
	 */
	protected $variablesChanged = false;

	/**
	 * Provides access to session data.
	 * 
	 * @param	string		$key
	 * @return	mixed
	 */
	public function __get($key) {
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		
		return null;
	}

	/**
	 * Initializes a new session object.
	 */
	public function __construct() {
		// start
		session_start();
	}

	/**
	 * Registers a session variable.
	 * 
	 * @param	string		$key
	 * @param	string		$value
	 */
	public function register($key, $value) {
		$_SESSION[$key] = $value;
		$this->variablesChanged = true;
	}
	
	/**
	 * Unsets a session variable.
	 * 
	 * @param	string		$key
	 */
	public function unregister($key) {
		unset($_SESSION[$key]);
		$this->variablesChanged = true;
	}

	/**
	 * Destroys the session.
	 */
	public function destroy() {
		unset($_SESSION);
		session_destroy();
	}
}