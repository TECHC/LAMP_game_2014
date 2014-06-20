<?php

//
$base_path = __DIR__ . '/';
//var_dump($base_path);

// include pathの設定
set_include_path(get_include_path() . PATH_SEPARATOR . $base_path . 'libs');

// Smarty
require_once($base_path . 'Smarty-3.1.18/libs/Smarty.class.php');
require_once('mw_smarty.inc');
$smarty = new mw_smarty();
$smarty->setTemplateDir($base_path . 'smarty_wk/templates/');
$smarty->setCompileDir($base_path . 'smarty_wk/templates_c/');
