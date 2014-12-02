<?php
/**
 * Shows the search page.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class SearchController extends AbstractController {
	/**
	 * @see	\Controller\IController::init()
	 */
	public function init() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			header('Location: /searchresult');
		}

		// show
		parent::init();
	}
}