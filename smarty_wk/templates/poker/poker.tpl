<!DOCTYPE HTML>
<html lang="ja-JP">
<head>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.10.3/build/cssreset/cssreset-min.css"]] >
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<meta charset="UTF-8">
	<title>ポーカー</title>
	
<script>

// 「終了」を押した場合のクッション
function endCheck()
{
	if(!window.confirm('終了してもいいですか？（賭けコインは戻ってきません！）'))
	{
		return false;
	}
}

</script>

<style type="text/css">
/*** COMMON ***/
.clear {
	clear: both;
}

/*** GAME.CSS ***/
.wrap {
	margin: 0 auto;
	width: 1000px;
	height: 800px;
	
	position: relative;
	
	background: #00ff1f;
	background: url(../wwwroot/images/table_bg.png);
	background-repeat: no-repeat;
	background-size: contain:
}
.hand {
	display: table;
	margin: 0 auto;
	box-sizing: border-box;
	
	position: absolute;
	left: 50%;
	-webkit-transform: translateX(-50%);
	
	
	border-radius: 10px;
}
.enemy_hand {
	top: 10%;
	
	background: #ffb0b0;
}
.my_hand {
	bottom: 10%;
	
	background: #bbf5ff;
}

.card {
	width: 140px;
	height: 200px;
	float: right;
	margin: 5px;
	
	background: url(../wwwroot/images/back.png);
	background-size: contain;
	background-repeat: no-repeat;
}

</style>
</head>

<body>

<!-- フィールド（共通して使えるカード）の表示 -->
<div class="">
	{foreach from=$field_card item=i}
		<div class="card" style="background:url(../images/{$i.suzi}{$i.suit}.png)"></div>
	{/foreach}
</div>
<!-- ここまで -->

<!-- プレイヤーのカードを表示 -->
<div calss="">
	{foreach from=$player_card item=i}
		<div class="card" style="background:url(../images/{$i.suzi}{$i.suit}.png)"></div>
	{/foreach}
</div>
<!-- ここまで -->

<!-- プレイヤーの行動表示 -->
<div class="">
	<p>{$player_info}</p>
</div>
<!-- ここまで -->

<!-- プレイヤーの選択肢（コール、ベット…）を表示 -->
<div class="">
	<form action="poker.php" method="POST" />
		<input type="submit" value="コール・チェック" name="mode" />
		<input type="submit" value="ベット" name="mode" />
		<input type="text" value="10" name="coin" size="3" maxlength="3"/>
		<input type="submit" value="オールイン" name="mode" />
		<input type="submit" value="フォールド"name="mode" />
		<input type="submit" value="終了" name="mode" onclick="return endCheck();" />
	</form>
</div>
<!-- ここまで -->

<!-- 相手の手札を表示 -->
<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>
<!-- ここまで -->

<!-- 相手の行動表示 -->
<div class="">
	<p>{$com1_info}</p>
</div>
<!-- ここまで -->

<!-- 上記処理をあと4回やる -->

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<div class="">
	<p>{$com2_info}</p>
</div>

<!-- ============== -->

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<div class="">
	<p>{$com3_info}</p>
</div>

<!-- ============== -->

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<div class="">
	<p>{$com4_info}</p>
</div>

<!-- ============== -->

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<div class="">
	<p>{$com5_info}</p>
</div>

<!-- ============== -->

</body>
</html>