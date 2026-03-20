<?php

/**
* $Id: admin_header.php 1383 2008-05-21 17:17:43Z marcan $
* Module: Imtranslating
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

if (!defined("IMTRANSLATING_NOCPFUNC")) {
	include_once ICMS_ROOT_PATH . '/include/cp_header.php';
}

include_once ICMS_ROOT_PATH.'/modules/imtranslating/include/common.php';

if( !defined("IMTRANSLATING_ADMIN_URL") ){
	define('IMTRANSLATING_ADMIN_URL', IMTRANSLATING_URL . "admin/");
}

icms_loadLanguageFile('imtranslating', 'admin');

?>