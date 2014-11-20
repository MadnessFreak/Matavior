<?php
/**
 * Default exception for http not found.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class PermissionDeniedException extends UserException {
	/**
	 * Prints a permission denied exception.
	 */
	public function show() {
		@header('HTTP/1.0 403 Forbidden');

		$this->exceptionData['Message'] = LANG_PERMISSION_DENIED;

		parent::show();
	}
}