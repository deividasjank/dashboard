<?php    

define('ROOT', dirname(dirname(__FILE__)));

//enable error reporting
error_reporting(E_ALL);
ini_set('display_errors','On');

//launch autoloader
require_once (ROOT . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');
require_once ('bootstrap.php');
