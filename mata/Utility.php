<?php

/**
 * Provides a collection of frequent used functions.
 *
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Utility {
	/**
	 * Unifies windows and unix directory separators.
	 * 
	 * @param	string		$path
	 * @return	string
	 */
	public static function unidir($path) {
		$path = str_replace('\\\\', '/', $path);
		$path = str_replace('\\', '/', $path);
		return $path;
	}

	/**
	 * Converts html special characters.
	 * 
	 * @param	string		$string
	 * @return	string
	 */
	public static function encodeHTML($string) {
		if (is_object($string)) 
			$string = $string->__toString();
		
		return @htmlspecialchars($string, ENT_COMPAT, 'UTF-8');
	}

	/**
	 * Alias to php sha1() function.
	 * 
	 * @param	string		$value
	 * @return	string
	 */
	public static function getHash($value) {
		return sha1($value);
	}
	
	/**
	 * Creates a random hash.
	 * 
	 * @return	string
	 */
	public static function getRandomID() {
		return self::getHash(microtime() . uniqid(mt_rand(), true));
	}
}
