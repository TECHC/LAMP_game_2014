<?php

// 表示用のデータ設定
// あちこちで出てきそうなので、ここで
$smarty->assign('name', @$_COOKIE['name']);
$smarty->assign('coin', @$_COOKIE['coin']);

// キャッシュの解除
ob_end_flush();

// 置換処理＆出力
error_reporting(E_ALL & ~E_NOTICE); // XXX Smarty的にやむを得ず
$s = $smarty->fetch($template_name);
echo $s;
