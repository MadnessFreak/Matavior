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
		$this->data['userID'] = 1;
		$this->data['username'] = 'MadnessFreak';
	}

	/* ************************************************ */	

	/**
	 * Returns username.
	 * 
	 * @return	string
	 */
	public function __toString() {
		return $this->username;
	}
}