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
	public function __construct() {
		$this->data = array();
	}

	/* ************************************************ */

	public static function create() {
		$user = new User();
		$user->addData();
		return $user;
	}

	public function addData() {
		$this->data = array();
		$this->data['userID'] = 1;
		$this->data['username'] = 'MadnessFreak'; // for test purposes
		$this->data['email'] = 'madnessfreak@happyduckz.co';
		$this->data['birthday'] = 817603200;
		$this->data['gender'] = 1;
	}

	/**
	 * Returns the userID.
	 *
	 * @return	int
	 */
	public function getUserID() {
		return !empty($this->userID) ?  $this->userID : 0;
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
}