<?php
/**
* imTranslating version infomation
*
* This file holds are the configuration information of this module
*
* @copyright	http://smartfactory.ca The SmartFactory
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		http://inboxinternational.com INBOX International inc.
* @version		$Id$
*/

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");

/**
 * General Information
 */
$modversion['name'] = _MI_IMTRANSLATING_MD_NAME;
$modversion['version'] = 1.1;
$modversion['description'] = _MI_IMTRANSLATING_MD_DESC;
$modversion['author'] = "The SmartFactory";
$modversion['credits'] = "INBOX International inc.";
$modversion['help'] = "";
$modversion['license'] = "GNU General Public License (GPL)";
$modversion['official'] = 0;
$modversion['dirname'] = "imtranslating";
$modversion['min_php'] = '8.0';
$modversion['min_icms'] = '2.0.1';

/**
 * Images information
 */
$modversion['image'] = "images/module_logo.gif";
$modversion['iconsmall'] = "images/icon_small.png";
$modversion['iconbig'] = "images/icon_big.png";
// for backward compatibility
$modversion['image'] = $modversion['iconbig'];

/**
 * Development information
 */
$modversion['status_version'] = "Beta 1";
$modversion['status'] = "Beta";
$modversion['date'] = "unreleased";
$modversion['author_word'] = "";

/**
 * Contributors
 */
$modversion['developer_website_url'] = "http://smartfactory.ca";
$modversion['developer_website_name'] = "The SmartFactory";
$modversion['developer_email'] = "info@smartfactory.ca";
$modversion['people']['developers'][] = "[url=http://smartfactory.ca/userinfo.php?uid=1]marcan[/url] (Marc-Andr&eacute; Lanciault)";
$modversion['people']['developers'][] = "[url=http://smartfactory.ca/userinfo.php?uid=112]felix[/url] (F&eacute;lix Tousignant)";
//$modversion['people']['testers'][] = "";
//$modversion['people']['translators'][] = "";
//$modversion['people']['documenters'][] = "";
//$modversion['people']['other'][] = "";
//$modversion['warning'] = _CO_SOBJECT_WARNING_BETA;

/**
 * Administrative information
 */
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

/**
 * Database information
 */
//$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
//$modversion['object_items'][1] = '';
//$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/**
 * Install and update informations
 */
$modversion['onInstall'] = "include/onupdate.inc.php";
$modversion['onUpdate'] = "include/onupdate.inc.php";


/**
 * Search information
 */
$modversion['hasSearch'] = 0;


/**
 * Menu information
 */
$modversion['hasMain'] = 0;
//$modversion['sub'][1]['name'] = ...;
//$modversion['sub'][1]['url'] = ...;

/**
 * Blocks information
 */
$i = 0;

/*
$i++;
$modversion['blocks'][$i]['file'] = "items_new.php";
$modversion['blocks'][$i]['name'] = _MI_SSECTION_ITEMSNEW;
$modversion['blocks'][$i]['description'] = "Shows new items";
$modversion['blocks'][$i]['show_func'] = "smartsection_items_new_show";
$modversion['blocks'][$i]['edit_func'] = "smartsection_items_new_edit";
$modversion['blocks'][$i]['options'] = "0|datesub|5|65";
$modversion['blocks'][$i]['template'] = "smartsection_items_new.html";
*/

/**
 * Templates information
 */
$i = 0;


$i++;
$modversion['templates'][$i]['file'] = 'imtranslating_admin_index.html';
$modversion['templates'][$i]['description'] = 'Admin Index';

/**
 * Preferences information
 */
$i = 0;

/*
$i++;
$modversion['config'][$i]['name'] = 'default_editor';
$modversion['config'][$i]['title'] = '_CO_SOBJECT_EDITOR';
$modversion['config'][$i]['description'] = '_CO_SOBJECT_EDITOR_DSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
*/


/**
 * Comments information
 */
$modversion['hasComments'] = 0;
/*
$modversion['comments']['itemName'] = 'itemid';
$modversion['comments']['pageName'] = 'item.php';

// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'smartsection_com_approve';
$modversion['comments']['callback']['update'] = 'smartsection_com_update';
*/

/**
 * Notification information
 */
$modversion['hasNotification'] = 0;
/*
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'smartsection_notify_iteminfo';

$modversion['notification']['category'][1]['name'] = 'global_item';
$modversion['notification']['category'][1]['title'] = _MI_SSECTION_GLOBAL_ITEM_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_SSECTION_GLOBAL_ITEM_NOTIFY_DSC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'category.php', 'item.php');

$modversion['notification']['event'][1]['name'] = 'category_created';
$modversion['notification']['event'][1]['category'] = 'global_item';
$modversion['notification']['event'][1]['title'] = _MI_SSECTION_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_SSECTION_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_CAP;
$modversion['notification']['event'][1]['description'] = _MI_SSECTION_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_DSC;
$modversion['notification']['event'][1]['mail_template'] = 'global_item_category_created';
$modversion['notification']['event'][1]['mail_subject'] = _MI_SSECTION_GLOBAL_ITEM_CATEGORY_CREATED_NOTIFY_SBJ;
*/
?>