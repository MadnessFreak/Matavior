<?php
class UserGroup {
	/**
	 * group type everyone user group
	 * @var	integer
	 */
	const EVERYONE = 1;
	
	/**
	 * group type guests user group
	 * @var	integer
	 */
	const GUESTS = 2;
	
	/**
	 * group type registered users user group
	 * @var	integer
	 */
	const USERS = 3;
	
	/**
	 * group type of other user groups
	 * @var	integer
	 */
	const OTHER = 4;

	public static function getGroups($all = false) {
		// prepare
		$sql = "SELECT		groups.*
				FROM		mata_groups groups
				WHERE		groups.groupType > 3";
		$statement = Mata::getDB()->prepareStatement($sql);
		$statement->execute();
		$groups = array();
		
		// fetch
		while ($row = $statement->fetchArray()) {
			array_push($groups, $row);
		}

		return $groups;
	}
}