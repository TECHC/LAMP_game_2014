<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ポーカー</title>
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

<script>

// どっかに書き出してもいいけどとりあえず
// 「終了」を押した場合のクッション
function endCheck()
{
	if(!window.confirm('終了してもいいですか？（賭けコインは戻ってきません！）'))
	{
		return false;
	}
}

</script>

<!-- 仮 -->
<style type="text/css">
	.card {
	width: 110px;
	height: 170px;
	/*float: left;*/
	margin: 5px;

	/* カードの枠が無いのでとりあえず */
	border: solid 1px;
	
	background: url(../imgs/back.png);
	background-size: contain;
	background-repeat: no-repeat;
}
</style>

</head>
<body>

<p>フィールドのカード</p>
<!-- 共有して使えるカード（最大5枚） -->
<div class="">
	{$field_card}
</div>

<!-- プレイヤーの必要情報 -->
<p>{$name}さんの手札</p>

<!-- [コールしました]などの情報を乗せようかなと -->
<div class="">
	<p>{$player_info}</p>
</div>

<div class="">
{foreach from=$player_card item=i}
    <div class="card" style="background:url(.img/{$i.suit}_{$i.card}.png)"></div>
{/foreach}
</div>

<p>どうしますか？</p>

<form action="poker_now.php" method="POST" />
	<input type='submit' value='コール・チェック' name='mode' />
	<input type='submit' value='ベット' name='mode' /><input type='text' value='10' name='coin' size="3" maxlength="3"/>
	<input type='submit' value='オールイン' name='mode' />
	<input type='submit' value='フォールド' name='mode' />
<input type='submit' value='終了' name='mode' onclick='return endCheck();' />
</form>

<!-- プレイヤーここまで -->
<HR >

<p>相手のカード</p>

<!-- 相手の選んだ行動を表示 -->
<div class="">
	{$com_1_info}
</div>

<!-- 相手の様子を表示(色で表情をあれあれするっていうやつ) -->
<div class="">
	{$com_1_status}
</div>

<!-- 相手のカードを表示 -->
<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<HR >

<div class="">
	{$com_2_info}
</div>

<div class="">
	{$com_1_status}
</div>

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<HR >

<div class="">
	{$com_3_info}
</div>

<div class="">
	{$com_1_status}
</div>

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<HR >

<div class="">
	{$com_4_info}
</div>

<div class="">
	{$com_1_status}
</div>

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<HR >

<div class="">
	{$com_5_info}
</div>

<div class="">
	{$com_1_status}
</div>

<div class="">
	<div class="card"></div>
	<div class="card"></div>
</div>

<!-- ここまで -->
<HR >

</body>
</html>