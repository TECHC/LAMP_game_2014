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
		unset($_SESSION['poker']);
		// 足りていないとゲームは出来ないのでゲーム選択画面へ戻す
		header('Location: ../top.php');
		return ;
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
	$statusList[0]->setNowCoin(LATCH);

	// プレイヤーの数（6人）だけループ
	for($i = 0; $i < MAX_PLAYER; $i++)
	{
		// ステータス設定(すでにプレイヤーは設定しているのでやらない)
		if($i != 0)
		{
			$statusList[$i] = new Status("相手".($i));
			$statusList[$i]->latch(LATCH);
			$statusList[$i]->setNowCoin(LATCH);
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
	$smarty->assign("now_coin",LATCH);
	
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

	$smarty->assign("coins",$now_coin);


	// すべてのデータをゲームデータ保存クラスに入れる

	$poker = new GameManager();

	$poker->setFieldCard([]);
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
$fieldCard = $poker->getFieldCard();
$trump = $poker->getTrump();
$handList = $poker->getHand();
$comAI = $poker->getComAI();
$statusList = $poker->getStatus();
$nowCoin = $poker->getNowCoin();
$turn = $poker->getGameTurn();

// 行動を取り出す

$mode = @$_POST['mode'];
if($mode == "コール・チェック")
{
	// コールの場合は現在の掛け金に自分の掛け金を合わせる
	$statusList[0]->call($nowCoin);
	$smarty->assign("player_call",true);
}

else if($mode == "ベット")
{
	// ベットコイン抜き出し
	$addCoin = intval($_POST['coin']);
	$nowCoin = $statusList[0]->bet($addCoin); // 新しい掛け金が帰ってくる
	// 新しい掛け金を適応
	$poker->setNowCoin($nowCoin);
	$smarty->assign("player_bet",true);
}

else if($mode == "オールイン")
{
	$statusList[0]->allIn();
}

else if($mode == "フォールド")
{
	unset($_SESSION['poker']);
	setcookie('coin', $statusList[0]->getCoin(), 0, '/');
	header('Location: ./poker.php');
	return ;
}

else if($mode == "終了")
{
	unset($_SESSION['poker']);
	setcookie('coin', $statusList[0]->getCoin(), 0, '/');
	header('Location: ../top.php');
	return ;
}

// 敵の処理
for($i = 1; $i <= (MAX_PLAYER - 1); $i++)
{
	// AI処理を開始して行動を決める
	$mode = $comAI[($i - 1)]->check();
	// コール
	if($mode == 0)
	{
		$statusList[$i]->call($nowCoin);
	}

	// ベット
	else if($mode == 1)
	{

	}

	// オールイン
	else if($mode == 2)
	{

	}

	// フォールド
	else if($mode == 3)
	{

	}
}

// これがMAX_PLAYERと同じになれば全員同じ
$check = 0;
// 全員の掛け金が同じならばフィールドにカードを追加する
for($i = 0; $i < MAX_PLAYER; $i++)
{
	if($nowCoin == $statusList[$i]->getNowCoin())
	{
		$check += 1;
	}
}

if($check == MAX_PLAYER)
{
	$fieldCard = array_pop($trump);
	$turn += 1;
	var_dump($fieldCard);
}



// 描画（描画関数作れば良いんだけれど）
$playerHand = array 
(
	"1" => array("suji" => $handList[0][0]->getSuji(),
				 "suit" => $handList[0][0]->getSuit(),),

	"2" => array("suji" => $handList[0][1]->getSuji(),
	"suit" => $handList[0][1]->getSuit(),)
);

$smarty->assign("player_card",$playerHand);
$smarty->assign("now_coin",$nowCoin);

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

$smarty->assign("coins",$now_coin);

$poker->setTrump($trump);
$poker->setHand($handList);
$poker->setComAI($comAI);
$poker->setStatus($statusList);
$poker->setGameTurn($turn);
$poker->setNowCoin(LATCH);

// セッションに保存したゲーム情報を入れる
$_SESSION['poker'] = serialize($poker);


// 出力処理
$template_name = 'poker/poker.tpl';
require_once('../../fin.inc');

//unset($_SESSION['poker']);


