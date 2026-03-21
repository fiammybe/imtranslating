<?php

/**
* $Id: common.php 1383 2008-05-21 17:17:43Z marcan $
* Module: Imtranslating
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/
if (!defined("ICMS_ROOT_PATH")) {
 	die("ICMS root path not defined");
}

if( !defined("IMTRANSLATING_DIRNAME") ){
	define("IMTRANSLATING_DIRNAME", 'imtranslating');
}

if( !defined("IMTRANSLATING_URL") ){
	define("IMTRANSLATING_URL", ICMS_URL.'/modules/'.IMTRANSLATING_DIRNAME.'/');
}
if( !defined("IMTRANSLATING_ROOT_PATH") ){
	define("IMTRANSLATING_ROOT_PATH", ICMS_ROOT_PATH.'/modules/'.IMTRANSLATING_DIRNAME.'/');
}

if( !defined("IMTRANSLATING_IMAGES_URL") ){
	define("IMTRANSLATING_IMAGES_URL", IMTRANSLATING_URL.'images/');
}

if( !defined("IMTRANSLATING_ADMIN_URL") ){
	define("IMTRANSLATING_ADMIN_URL", IMTRANSLATING_URL.'admin/');
}


// Creating the SmartModule object
$imtranslatingModule = icms_getModuleInfo(IMTRANSLATING_DIRNAME);

// Find if the user is admin of the module
$imtranslating_isAdmin = icms_userIsAdmin(IMTRANSLATING_DIRNAME);

if(is_object($imtranslatingModule)){
	$imtranslating_moduleName = $imtranslatingModule->getVar('name');
}

// Creating the SmartModule config Object
$imtranslatingConfig = icms_getModuleConfig(IMTRANSLATING_DIRNAME);

include_once(IMTRANSLATING_ROOT_PATH . 'class/job.php');


?>