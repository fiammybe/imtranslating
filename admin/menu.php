<?php
/**
* Configuring the amdin side menu for the module
*
* @copyright	The SmartFactory http://www.smartfactory.ca
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @package		Imtranslating
* @author		marcan <marcan@smartfactory.ca>
* @version		$Id: menu.php 1394 2008-05-22 16:21:43Z marcan $
*/

$i = -1;

$i++;
$adminmenu[$i]['title'] = _MI_IMTRANSLATING_TRANSLATE;
$adminmenu[$i]['link'] = "admin/index.php";

if (isset(icms::$module)) {

	$i = -1;

/*	$i++;
	$headermenu[$i]['title'] = _PREFERENCES;
	$headermenu[$i]['link'] = '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . icms::$module->getVar('mid');

	$i++;
	$headermenu[$i]['title'] = _CO_ICMS_GOTOMODULE;
	$headermenu[$i]['link'] = IMTRANSLATING_URL;
*/
	$i++;
	$headermenu[$i]['title'] = _CO_ICMS_UPDATE_MODULE;
	$headermenu[$i]['link'] = ICMS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=" . icms::$module->getVar('dirname');

	$i++;
	$headermenu[$i]['title'] = _MODABOUT_ABOUT;
	$headermenu[$i]['link'] = IMTRANSLATING_URL . "admin/about.php";
}
?>