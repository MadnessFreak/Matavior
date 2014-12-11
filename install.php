<?php
/**
 * This script extracts the matavior framework.
 * 
 * @author		MadnessFreak
 * @copyright	2014 MadnessFreak
 * @license		MIT License <http://opensource.org/licenses/MIT>
 */
define('MATAVIOR_INSTALL_ZIP', 'MataviorSetup.zip');

if (!file_exists(MATAVIOR_INSTALL_ZIP)) {
	die('Installation Archive ' . MATAVIOR_INSTALL_ZIP . ' was not found');
}

$zip = new ZipArchive;
if ($zip->open(MATAVIOR_INSTALL_ZIP) === TRUE) {
    $zip->extractTo(__DIR__ . '/');
    $zip->close();
    echo 'Installation succeed';
} else {
    echo 'Installation failed';
}