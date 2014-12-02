<?php
/**
 * Provides a class for invoking a controller.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Invoker {
	/**
	 * Invokes the specified controller.
	 *
	 * @param	string	name
	 */
	public static function invoke($name) {
		// create controller name
		$className = ucfirst($name) . 'Controller';
		$path = Utility::unidir(SYS_DIR . 'Controller/' . $className . '.php');

		// try invoke
		if (file_exists($path)) {
			$controller = new $className();
			$controller->init();
		} else {
			$className = 'EmptyController';
			$path = Utility::unidir(SYS_DIR . 'Controller/EmptyController.php');

			if (file_exists($path)) {
				$controller = new $className();
				$controller->init();
			} else {
				throw new SystemException("Invoking $name failed. Could not find controller $path.");
			}

			//throw new NotFoundException("Invoking $name failed. Could not find controller $path.");
		}
	}
}