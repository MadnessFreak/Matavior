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
		$this->start();
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

	public function getSessionID() {
		return $this->SID;
	}

	/**
	 * Starts the session.
	 */
	public function start() {
		session_start();

		if (isset($_COOKIE[COOKIE_SESSION])) {
			$this->register('SID', $_COOKIE[COOKIE_SESSION]);
			Session::exists($this->getSessionID()) ? $this->update() : $this->create();
		} else {
			$this->register('SID', Utility::getRandomID());
			session_id($this->getSessionID());
			setcookie(COOKIE_SESSION, $this->getSessionID(), 0, '/');
			$this->create();
		}

		// security token
		//if (!defined('SECURITY_TOKEN')) define('SECURITY_TOKEN', $this->getSecurityToken());
		//if (!defined('SECURITY_TOKEN_INPUT_TAG')) define('SECURITY_TOKEN_INPUT_TAG', '<input type="hidden" name="t" value="'.$this->getSecurityToken().'" />');
	}

	public function create() {
		$sql = "INSERT IGNORE INTO	mata_session
							(sessionID, userID, ipAddress, userAgent, lastActivityTime, requestURI, requestMethod)
				VALUES		(?, ?, ?, ?, ?, ?, ?)";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$this->getSessionID(),
			$this->user ? $this->user->userID : null,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT'],
			$_SERVER['REQUEST_TIME'],
			strtok($_SERVER['REQUEST_URI'], '?'),
			$_SERVER['REQUEST_METHOD']
		));
	}

	public function update() {
		$sql = "DELETE FROM	mata_session
				WHERE		mata_session.lastActivityTime < ? AND mata_session.sessionID != ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			TIME_NOW - SESSION_TIMEOUT,
			$this->getSessionID()
		));

		$sql = "UPDATE		mata_session session
				SET			session.lastActivityTime = ?,
							session.ipAddress = ?,
							session.requestURI = ?,
							session.requestMethod = ?,
							session.userID = ?
				WHERE		session.sessionID = ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$_SERVER['REQUEST_TIME'],
			$_SERVER['REMOTE_ADDR'],
			strtok($_SERVER['REQUEST_URI'], '?'),
			$_SERVER['REQUEST_METHOD'],
			$this->user ? $this->user->userID : null,
			$this->getSessionID()
		));
	}

	public static function exists($sessionID) {
		$sql = "SELECT		COUNT(sessionID) as count
				FROM		mata_session session
				WHERE		session.sessionID = ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array(
			$sessionID
		));

		return $statement->fetchArray()['count'];
	}

	/**
	 * Destroys the session.
	 */
	public function destroy() {
		unset($_SESSION);
		session_destroy();
	}
}