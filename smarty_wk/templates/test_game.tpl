<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
<style type="text/css"><!--

div.popup {
  /*margin  : 30px ;*/
  padding : 15px ;
  border: 2px solid ;
  /*background: #ccf;*/
  background: #fff;
  position: absolute;
}

div.class-translucent {
  position: absolute;
  background: #000;
  filter:alpha(opacity=2);
  opacity:0.2;
  top: 0;
  left: 0;
}

--></style>
</head>
<body>
<h1>TGS LAMP game 2014</h1>
{$name}さんようこそ！<br>
現在コイン枚数：{$coin}枚<br>
<hr>
<h2>テスト ゲーム</h2>
勝った時用の画面遷移は<a href="./test_game.php?mode=win">こちら</a><br>
負けた時用の画面遷移は<a href="./test_game.php?mode=lose">こちら</a><br>
<hr>
{if true === $win}
勝ったよ！ 勝ったよ！<br>
{/if}
{if true === $lose}
負けた…負けたよ orz<br>
{/if}

{if true === $win or true === $lose}
<a href="./test_game.php" class="introduction">もう一度このゲームをやる</a><br>
<a href="./top.php" class="introduction">ゲームTopに戻る</a><br>
{/if}

<!-- モーダルウィンドウ用 -->
<div class="class-translucent" id="pop_window_2">
</div>
<div class="popup" id="pop_window_2_2">
  <div id="pop_window_2_close">[X]</div>
  ここにゲームの説明とか絵とかが本当は入る！<br>
</div>

<!-- JS -->
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript">

var next_location;

function introduction() {
  var o = $("#pop_window_2");
  //
  o.height($(document).height());
  o.width($(document).width());
  //
  o.show();
  //
  var o = $("#pop_window_2_2");
  o.show();
  //
  o.offset( { top: $(document).height() / 2 - o.height() / 2, left: $(document).width() / 2 - o.width() / 2} );
//alert( $(this).attr("href") );

  // 移動先の把握
  next_location = $(this).attr("href");

  // 一端、遷移させたくないので
  return false;
}

function pop2_pop_close()
{
  // 遷移させる
  window.location = next_location;
}

// onload
$(document).ready(function(){
  // window2の初期設定
  $("#pop_window_2").hide();
  $("#pop_window_2_2").hide();

  // clickイベントの設定
  $(document).on("click", ".introduction", introduction);
  $(document).on("click", "#pop_window_2_close", pop2_pop_close);
});
</script>

</body>
</html>
