<?php
/**
 * Provides a wrapper for the template engine.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class TemplateEngine {
	/**
	 * template engine object
	 */
	protected $engine = null;

	/**
	 * provides a value indicating whether the template has already been rendered
	 */
	protected $rendered = false;
	
	/* ************************************************ */
	
	public function __construct() {
		// variables
		$templatePath = Utility::unidir(APP_DIR . 'templates');
		$cachePath =  Utility::unidir(SYS_DIR . 'Cache');
		
		// include autoloader
		require_once Utility::unidir(SYS_DIR . 'Template/Twig/Autoloader.php');
		
		// register autoloader
		Twig_Autoloader::register(true);
		
		// init engine
		$loader = new Twig_Loader_Filesystem($templatePath);
		$twig = new Twig_Environment($loader);
		
		// activate cache if release
		if (!Mata::debugModeIsEnabled()) {
			$twig->setCache($cachePath);
		}
		
		// set engine
		$this->engine = $twig;
	}
	
	/* ************************************************ */
	
	/**
	 * Assigns a value to the template.
	 *
	 * @param	string	name
	 * @param	mixed	value
	 */
	public function assign($name, $value) {
		$this->engine->addGlobal($name, $value);
	}

	/**
	 * Registers a Filter.
	 * 
	 * @param	string	name
	 */
	public function addFilter($name) {
		$this->engine->addFilter($name);
	}
	
	/**
	 * Displays the template.
	 */
	public function display()
	{
		if ($this->rendered) return;
		
		echo $this->engine->render('index.tpl');

		$this->rendered = true;
	}
}
