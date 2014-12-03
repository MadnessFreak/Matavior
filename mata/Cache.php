<?php
/**
 * Provides class for caching data.
 *
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Cache {
	/**
	 * Checks whether a file is cached. Always returns false when in debug mode.
	 *
	 * @param	string	$file
	 * @return	bool
	 */
	public static function available($file) {
		return Mata::debugModeIsEnabled() ? false : file_exists(Utility::unidir(SYS_DIR . '/Cache/' . $file));
	}

	/**
	 * Serializes data to a file and returns the data.
	 *
	 * @param	string	$file
	 * @param	mixed	$data
	 * @return	mixed
	 */
	public static function serialize($file, $data = null) {
		$path = Utility::unidir(SYS_DIR . '/Cache/' . $file);

		if (file_exists($path)) unlink($path);
		
		file_put_contents($path, serialize($data));

		return $data;
	}

	/**
	 * Serializes data from a file and returns the data.
	 *
	 * @param	string	$file
	 * @return	mixed
	 */
	public static function unserialize($file) {
		$path = Utility::unidir(SYS_DIR . '/Cache/' . $file);

		return unserialize(file_get_contents($path));
	}
}
