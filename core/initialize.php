<?php
// Define a constant for the directory separator, DS.
defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);
// Define a constant for the site root directory path, SITE_ROOT.
defined('SITE_ROOT') ? null : define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . DS . 'boxOfHope');

// Define a constant for the include path, INC_PATH, pointing to the 'connection' directory within the site root.
defined("INC_PATH") ? null : define("INC_PATH", SITE_ROOT . DS . 'connection');
// Define a constant for the controller path
defined("CONTROLLER_PATH") ? null : define("CONTROLLER_PATH", SITE_ROOT . DS . 'controller');
// Define a constant for the core path, CORE_PATH, pointing to the 'core' directory within the site root.
defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT . DS . 'core');

//  Load the config file 'conn.php' from the 'connection' directory.
require_once(INC_PATH . DS . "conn.php");

// Include controller classes from the 'controller' directory.
require_once(CONTROLLER_PATH . DS . "agency.controller.php");
require_once(CONTROLLER_PATH . DS . "user.controller.php");
require_once(CONTROLLER_PATH . DS . "referred.controller.php");
