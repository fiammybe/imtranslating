<?php

/**
* About page of the module
*
* @copyright	The SmartFactory http://www.smartfactory.ca
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @package		Ilog
* @author		marcan <marcan@smartfactory.ca>
* @version		$Id: about.php 1383 2008-05-21 17:17:43Z marcan $
*/

include_once("admin_header.php");

if (file_exists(ICMS_ROOT_PATH . "/kernel/icmsmoduleabout.php")) {
	include_once(ICMS_ROOT_PATH . "/kernel/icmsmoduleabout.php");
}
if (class_exists('IcmsModuleAbout')) {
	$aboutObj = new IcmsModuleAbout();
	$aboutObj->render();
}

?>