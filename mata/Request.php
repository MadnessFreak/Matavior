<?php
/*
 * Provides a class for handling http requests.
 * 
 * @author    MadnessFreak <madnessfreak@happyduckz.co>
 * @copyright 2014 MadnessFreak
 * @package   Matavior
 */
class Request
{
	/**
	 * Current host and protocol
	 * @var	string
	 */
	protected static $host = '';
	
	/**
	 * HTTP protocol, either 'http://' or 'https://'
	 * @var	string
	 */
	protected static $protocol = '';
	
	/**
	 * HTTP encryption
	 * @var	boolean
	 */
	protected static $secure = null;

	/**
	 * Request uri
	 * @var	array
	 */
	protected static $uri = array();

	/**
	 * Request params
	 * @var	array
	 */
	protected static $params = array();

	/* ************************************************ */

	/**
	 * Handles a http request.
	 * 
	 */
	public static function handle() {
		// build request
		self::buildRequest();
	}

	/**
	 * Builds a new request.
	 * 
	 * @param	string		$application
	 */
	protected static function buildRequest() {
		if (isset($_SERVER['HTTP_MOD_REWRITE']) && $_SERVER['HTTP_MOD_REWRITE'] == 'On') {
			// nothing to do here
		} else {
			throw new SystemException("Cannot load module mod_rewrite. The specified module could not be found.");
		}

		$parts = explode('/', $_SERVER['REQUEST_URI']);
		$count = count($parts);
		for ($i = 1; $i < $count; $i++) { 
			if ($i == ($count - 1)) {
				$queries = explode('?', $parts[$i]);
				if (count($queries) > 1) {
					self::$uri[$i] = $queries[0];
					$queries = explode('&', $queries[1]);

					for ($j = 0; $j < count($queries); $j++) { 
						$pair = explode('=', $queries[$j]);
						self::$params[$pair[0]] = $pair[1];
					}
				} else {
					self::$uri[$i] = $parts[$i];
				}
			} else {
				self::$uri[$i] = $parts[$i];
			}
		}

		// validate
		foreach (self::$uri as $part) {
			self::validate($part);
		}
		foreach (self::$params as $param) {
			self::validate($param);
		}

		// print (debug purposes)
		print_r(self::$uri);
		print_r(self::$params);
	}

	/**
	 * Validates the given string for illegal content.
	 *
	 * @param	string	query
	 */
	public static function validate($query) {
		if (empty($query))
			return;

		// validate query
		if (!preg_match('~^[a-z0-9_]+$~i', $query)) {
			throw new SystemException("Illegal Query Detected ($query)");
		}
	}

	/**
	 * Returns true if this is a secure connection.
	 * 
	 * @return	true
	 */
	public static function secureConnection() {
		if (self::$secure === null) {
			self::$secure = false;
			
			if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
				self::$secure = true;
			}
		}
		
		return self::$secure;
	}

	/**
	 * Returns HTTP protocol, either 'http://' or 'https://'.
	 *
	 * @return	string
	 */
	public static function getProtocol() {
		if (empty(self::$protocol)) {
			self::$protocol = 'http' . (self::secureConnection() ? 's' : '') . '://';
		}
		
		return self::$protocol;
	}

	/**
	 * Returns protocol and domain name.
	 * 
	 * @return	string
	 */
	public static function getHost() {
		if (empty(self::$host)) {
			self::$host = self::getProtocol() . $_SERVER['HTTP_HOST'];
		}
		
		return self::$host;
	}

	/**
	 * Returns the request page.
	 *
	 * @return	string
	 */
	public static function getPage() {
		return isset(self::$uri[0]) ? self::$uri[0] : '';
	}

	/**
	 * Returns the request action.
	 *
	 * @return	string
	 */
	public static function getAction() {
		return isset(self::$uri[1]) ? self::$uri[1] : '';
	}

	/**
	 * Returns the request value.
	 *
	 * @return	string
	 */
	public static function getValue() {
		return isset(self::$uri[2]) ? self::$uri[2] : '';
	}

	/**
	 * Returns the request uri parts.
	 *
	 * @return	array
	 */
	public static function getUriParts() {
		return isset(self::$uri) ? self::$uri : array();
	}

	/**
	 * Returns the request params.
	 *
	 * @return	array
	 */
	public static function getParams() {
		return isset(self::$params) ? self::$params : array();
	}
}