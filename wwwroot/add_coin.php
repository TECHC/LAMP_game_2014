<?php
// coinチェック処理をオミットする
// XXX 実際にはissetで変数存在を確認しているだけなので値はなんでもいいが、分かりやすくtrueにしておく
$coin_check_omit = true;

// 初期化処理
require_once('../base.inc');

// 名前を取得
$name = trim((string)@$_POST['name']);
if ('' === $name) {
  $name = 'no name';
}

// Cookieに値を設定
// XXX 二重に呼ばれた可能性、などのチェックは一端オミット
setcookie('name', $name);
setcookie('coin', 10);

//
header('Location: ./top.php');

