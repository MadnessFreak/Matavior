<?php
/**
 * Provides the callback for handling requests.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
interface IController {
	/**
	 * Initializes the page.
	 */
	public function init();

	/**
	 * Checks the permissions of this page.
	 */
	public function checkPermissions();

	/**
	 * Shows the requested page.
	 */
	public function show();
}