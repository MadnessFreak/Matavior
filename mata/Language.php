<?php
/**
 * TODO
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Language {
	/**
	 * language code
	 * @var	string
	 */
	protected $languageCode = '';

	/**
	 * language name
	 * @var	string
	 */
	protected $languageName = '';

	/**
	 * list of language items
	 * @var	array<string>
	 */
	protected $items = array();

	/**
	 * Initializes a new instance.
	 */
	public function __construct($languageCode = 'en') {
		$this->languageCode = $languageCode;
	}

	/**
	 * Adds a single language variable.
	 *
	 * @param	string	$key
	 * @param	string	$value
	 */
	public function add($key, $value) {
		$this->items[$key] = $value;
	}

	/**
	 * Returns a single language variable.
	 * 
	 * @param	string		$key
	 * @return	string
	 */
	public function get($key) {
		return array_key_exists($key, $this->items) ? $this->items[$key] : $key;
	}

	/**
	 * Returns the language code.
	 * 
	 * @return	string
	 */
	public function getCode() {
		return $this->languageCode;
	}

	/**
	 * Returns the language name.
	 * 
	 * @return	string
	 */
	public function getName() {
		return $this->languageName;
	}

	/**
	 * Returns the name of this language.
	 * 
	 * @return	string
	 */
	public function __toString() {
		return $this->languageName;
	}

	public static function load($path) {
		$path = Utility::unidir($path);
		$xml = simplexml_load_string(file_get_contents($path));

		$language = new Language();
		$language->languageCode = $xml['languagecode']->__toString();
		$language->languageName = $xml['languagename']->__toString();

		foreach ($xml->category as $category) {
			// $category['name']

			foreach ($category->item as $item) {
				$language->add($item['name']->__toString(), $item->__toString());
			}
		}

		return $language;
	}

	/**
	 * Returns a list of all languaes.
	 * 
	 * @return	array
	 */
	public static function getLanguageList() {
		$file = 'LanguageList.cache';
		$files = Cache::available($file) ? Cache::unserialize($file) : Cache::serialize($file, scandir(Utility::unidir(SYS_DIR . '/Lang')));
		$languages = array();

		for ($i = 0; $i < count($files); $i++) {
			if (Utility::endsWith($files[$i], '.xml')) array_push($languages, $files[$i]);
		}
		
		return $languages;
	}
}