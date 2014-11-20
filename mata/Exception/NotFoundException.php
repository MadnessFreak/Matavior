<?php
/**
 * Default exception for http not found.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class NotFoundException extends UserException {
	/**
	 * Prints a permission denied exception.
	 */
	public function show() {
		@header('HTTP/1.0 404 Not Found');

		parent::show();
	}
}