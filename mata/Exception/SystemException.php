<?php

/**
* TODO
*/
class SystemException extends Exception
{
	/**
	 * error description
	 * @var	string
	 */
	protected $description = null;

	/**
	 * Creates a new SystemException.
	 * 
	 * @param	string		$message	error message
	 * @param	integer		$code		error code
	 * @param	string		$description	description of the error
	 * @param	\Exception	$previous	repacked Exception
	 */
	function __construct($message, $code = 0, $description = '')
	{
		parent::__construct($message, $code);
		$this->description = $description;
	}

	/**
	 * Returns the description of this exception.
	 * 
	 * @return	string
	 */
	public function getHash() {
		return Utility::getRandomID();
	}

	/**
	 * Returns the description of this exception.
	 * 
	 * @return	string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Shows the exception.
	 */
	public function show() {
		// send status code
		@header('HTTP/1.1 503 Service Unavailable');
		
		// show user-defined system-exception
		if (defined('SYSTEMEXCEPTION_FILE') && file_exists(SYSTEMEXCEPTION_FILE)) {
			require(SYSTEMEXCEPTION_FILE);
			return;
		}
		
		$innerMessage = 'Please send the ID above to the site administrator.';

		// print report
		$e = ($this->getPrevious() ?: $this);

		// include layout
		require 'Layout.php';

		// exit
		exit();
	}
}

?>