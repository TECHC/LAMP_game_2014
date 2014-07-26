<?php

session_start();

require_once("Define.php");
require_once("Trump.php");
require_once("Hand.php");
require_once("game_manager.php");
require_once("ai.php");
require_once("ai1.php");
require_once("Status.php");

$coin_check_omit = true;
require_once('../../base.inc');

// --------------------------------------------------------

// セッションに保存されていなかったら初期化処理を走らせる
if(isset($_SESSION['poker']) === false)
{
	// 初期化
	// 初期賭けコインは5枚なので5枚以上か調べる
	if($_COOKIE['coin'] < 5 )
	{
		// 5枚以下ならばゲームは出来ないのでゲーム選択画面へ戻す
		header('Location: ../top.php');
	}
	else
	{
		// 5枚以上ならば賭ける
		$_COOKIE['coin'] -= 5;
		setcookie('coin',$_COOKIE['coin'],0);
	}

	// 出力処理
	$template_name = 'poker/poker.tpl';
	require_once('../../fin.inc');
}
