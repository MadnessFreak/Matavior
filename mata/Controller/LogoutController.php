<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class LogoutController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		Mata::getSession()->destroy();

		header('Refresh: 3; /index');
		
		parent::init();
	}
}