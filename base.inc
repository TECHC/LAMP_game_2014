<?php
ob_start();
error_reporting( E_ALL );
ini_set('display_errors', 'on');

// コイン所持チェック
if ( false === isset($coin_check_omit) ) {
  // コインの存在チェック
  if (false === isset($_COOKIE['coin'])) {
    header('Location: ./index.php');
    return ;
  }

  // コインの枚数チェック
  if (0 >= $_COOKIE['coin']) {
    header('Location: ./defeat.php');
    return ;
  }

}

// 基準ディレクトリの把握
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

