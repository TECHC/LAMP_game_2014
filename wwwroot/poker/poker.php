<?php

session_start();

require_once("Define.php");
require_once("Trump.php");
require_once("Game_manager.php");
require_once("AI.php");
require_once("AI1.php");
require_once("Status.php");

$coin_check_omit = true;
require_once('../../base.inc');

// --------------------------------------------------------
// セッションに保存されていなかったら初期化処理を走らせる
if(isset($_SESSION['poker']) === false)
{
	// 初期化
	// 初期賭けコインが足りているか
	if($_COOKIE['coin'] < LATCH )
	{
		// 足りていないとゲームは出来ないのでゲーム選択画面へ戻す
		header('Location: ../top.php');
	}
	else
	{
		// 足りれば賭ける
		lose_coin(LATCH);
	}

	// カードの山札を用意
	$trump = [];

	// カードの種類（4種類)だけループ
	for($i = 0; $i < CARD_TYPE; $i++)
	{
		// XXX : カードの数字(1~13)だけループ（※配列は[1]から始まる）
		for($j = 1; $j <= MAX_CARD; $j++)
		{
			$trump[($i*MAX_CARD)+$j] = new Trump($i,$j);
		}
	}

	// ここまでで52枚用意出来たので100回ぐらいシャッフルする（何回でもいいんだけど）
	for($i = 0; $i < 100; $i++)
	{
		shuffle($trump);
	}

	// --------------------------------------------------------
	// 手札を作る

	// 全員の手札を入れる箱を用意
	$handList = [];
	// 全員のステータスを入れる箱を用意
	$statusList = [];

	// プレイヤーのステータス設定
	$statusList[0] = new Status($_COOKIE['name']);
	$statusList[0]->setCoin($_COOKIE['coin']);

	// プレイヤーの数（6人）だけループ
	for($i = 0; $i < MAX_PLAYER; $i++)
	{
		// ステータス設定(すでにプレイヤーは設定しているのでやらない)
		if($i != 0)
		{
			$statusList[$i] = new Status("相手".($i));
			$statusList[$i]->latch(LATCH);
		}

		// 2枚配る
		for($j = 0; $j < MAX_HAND; $j++)
		{
			// pop（配列の後ろから取り出す（配列からは消える））する
			$handList[$i][$j] = array_pop($trump);
		}		
	}
	// --------------------------------------------------------
	// AIを用意

	// AIの情報を入れる箱を用意
	$comAI = [];

	// AIタイプを設定(-1するのはプレイヤー（AIではない）がいるため)
	for($i = 0; $i < (MAX_PLAYER - 1); $i++)
	{
		// AIタイプは0~2タイプあるのでランダムに決めてクラスを作成
		$comAI[$i] = new AI1();
	}

	// --------------------------------------------------------	
	// 画面描画
	$playerHand = array 
	(
		"1" => array("suji" => $handList[0][0]->getSuji(),
					 "suit" => $handList[0][0]->getSuit(),),

		"2" => array("suji" => $handList[0][1]->getSuji(),
		"suit" => $handList[0][1]->getSuit(),)
	);

	$smarty->assign("player_card",$playerHand);
	$smarty->assign("player_init",true);
	$smarty->assign("coin",LATCH);
	
	$now_coin = array
	(
		"1" => array("name"=>$statusList[0]->getName(),
					 "coin"=>$statusList[0]->getCoin()),

		"2" => array("name"=>$statusList[1]->getName(),
					 "coin"=>$statusList[1]->getCoin()),
		
		"3" => array("name"=>$statusList[2]->getName(),
					 "coin"=>$statusList[2]->getCoin()),
		
		"4" => array("name"=>$statusList[3]->getName(),
					 "coin"=>$statusList[3]->getCoin()),
		
		"5" => array("name"=>$statusList[4]->getName(),
					 "coin"=>$statusList[4]->getCoin()),
		
		"6" => array("name"=>$statusList[5]->getName(),
					 "coin"=>$statusList[5]->getCoin()),
			
	);

	$smarty->assign("now_coin",$now_coin);


	// すべてのデータをゲームデータ保存クラスに入れる

	$poker = new GameManager();

	$poker->setTrump($trump);
	$poker->setHand($handList);
	$poker->setComAI($comAI);
	$poker->setStatus($statusList);
	$poker->setNowCoin(LATCH);

	// セッションに保存したゲーム情報を入れる
	$_SESSION['poker'] = serialize($poker);

	// 出力処理
	$template_name = 'poker/poker.tpl';
	require_once('../../fin.inc');
	return ;
}

// 初期処理以外
// セッションから取り出し
$poker = unserialize($_SESSION['poker']);
$trump = $poker->getTrump();
$handList = $poker->getHand();
$comAI = $poker->getComAI();
$status = $poker->getStatus();
$nowCoin = $poker->getNowCoin();

// 行動を取り出す
$mode = @$_POST['mode'];
if($mode == "コール・チェック")
{
	// コールの場合は現在の掛け金に自分の掛け金を合わせる
	$status[0]->call($nowCoin);
}

else if($mode == "ベット")
{
	// ベットコイン抜き出し
	$addCoin = intval($_POST['coin']);
	var_dump($addCoin);

	$nowCoin = $status[0]->bet($addCoin); // 新しい掛け金が帰ってくる

}

else if($mode == "オールイン")
{

}

else if($mode == "フォールド")
{

}

else if($mode == "終了")
{
	header('Location: ../top.php');
}

unset($_SESSION['poker']);


