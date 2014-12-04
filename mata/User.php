<?php
/*
 * Represents a user.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class User {
	/**
	 * object data
	 * @var	array
	 */
	protected $data = null;

	/**
	 * @see	\wcf\data\IStorableObject::__get()
	 */
	public function __get($name) {
		if (isset($this->data[$name])) {
			return $this->data[$name];
		}
		else {
			return null;
		}
	}

	/* ************************************************ */

	/**
	 * Creates a new instance of the class.
	 */
	public function __construct($id, $row = null) {
		if ($id !== null) {
			$sql = "SELECT		user_table.*
					FROM		".DB_PREFIX."_users user_table
					WHERE		user_table.userID = ?";
			$statement = WCF::getDB()->prepareStatement($sql);
			$statement->execute(array($id));
			$row = $statement->fetchArray();
			
			// enforce data type 'array'
			if ($row === false) $row = array();
		}
		else if ($row !== null) {
			$this->data = $row;
		}
	}

	/* ************************************************ */

	/**
	 * Returns the userID.
	 *
	 * @return	int
	 */
	public function getUserID() {
		return isset($this->userID) ?  $this->userID : false;
	}

	/**
	 * Returns the username.
	 *
	 * @return	string
	 */
	public function getUsername() {
		return !empty($this->username) ?  $this->username : null;
	}

	/**
	 * Returns the user data.
	 *
	 * @return	array
	 */
	public function getUserData() {
		return $this->data;
	}

	/**
	 * Returns username.
	 * 
	 * @return	string
	 */
	/*public function __toString() {
		return $this->getUsername();
	}*/

	/* ************************************************ */

	/**
	 * Returns the user with the given username.
	 * 
	 * @param	string		$username
	 * @return	\wcf\data\user\User
	 */
	public static function getUserByUsername($username) {
		$sql = "SELECT		user_table.*
				FROM		".DB_PREFIX."_users user_table
				WHERE		user_table.username = ?";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute(array($username));
		$row = $statement->fetchArray();
		if (!$row) $row = array();
		
		return new User(null, $row);
	}
}