<?php
/**
 * IllegalLinkException shows the unknown link error page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class IllegalLinkException extends UserException {
	/**
	 * Prints a permission denied exception.
	 */
	public function show() {
		@header('HTTP/1.0 404 Not Found');
		
		$this->exceptionData['Message'] = LANG_ILLEGAL_LINK;

		parent::show();
	}
}