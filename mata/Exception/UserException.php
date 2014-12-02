<?php
/**
 * Provides exceptions that are not critical.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class UserException extends Exception {
	/**
	 * stores the exception data for the template
	 */
	protected $exceptionData = array();

	/**
	 * Initializes a new UserException.
	 * 
	 * @param	string		$message	error message
	 * @param	integer		$code		error code
	 */
	function __construct($message = 'Unknown UserException occurred', $code = 0)
	{
		parent::__construct($message, $code);

		$this->exceptionData['Class'] = get_class($this);
		$this->exceptionData['Message'] = $this->getMessage();
		$this->exceptionData['StackTrace'] = $this->getTraceAsString();
	}

	/**
	 * Shows the exception.
	 */
	public function show() {
		Mata::getTPL()->assign('EXCEPTION', $this->exceptionData);
		Mata::getTPL()->display();
		exit;
	}
}