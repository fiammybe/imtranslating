<?php

/**
* $Id: index.php 1394 2008-05-22 16:21:43Z marcan $
* Module: Imtranslating
* Author: The SmartFactory <www.smartfactory.ca>
* Licence: GNU
*/

include_once("admin_header.php");
xoops_cp_header();

if(empty($_POST)){
	icms::$module->displayAdminMenu(0, _AM_IMTRANSL_TRANSLATE);

	$job = new ImtranslatingJob();
	$form = $job->getInitialForm();
	$form->assign($icmsAdminTpl);
	$icmsAdminTpl->display('db:imtranslating_admin_index.html');
}else{
	icms::$module->displayAdminMenu(0, _AM_IMTRANSL_TRANSLATE);
	$job = new ImtranslatingJob($_POST['from_lang'], $_POST['to_lang'], $_POST['module'], $_POST['step'], $_POST['fileset']);

	if($_POST['step'] == 'zip'){
		$job->makeZip();
		exit;
	}else{
		if(isset($_POST['write']) && $_POST['write'] == 1){
			$job->write();
		}
		$form = $job->getForm();
		$form->assign($icmsAdminTpl);
		$icmsAdminTpl->display('db:imtranslating_admin_index.html');
	}
}

xoops_cp_footer();

exit;
?>