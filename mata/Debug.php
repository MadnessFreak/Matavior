<?php

class Debug {
	protected static $variables = array();

	public static function add($key, $value) {
		self::$variables[$key] = $value;
	}

	public static function display() {
		Mata::getTPL()->assign('DEBUG_INFO', self::$variables);
	}
}