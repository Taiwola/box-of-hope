<?php
defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . DS . 'boxOfHope');

defined("INC_PATH") ? null : define("INC_PATH", SITE_ROOT . DS . 'connection');
defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT . DS . 'core');

// load the config file
require_once(INC_PATH . DS . "conn.php");

// core classes 
require_once(CORE_PATH . DS . "controller.php");
