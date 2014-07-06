<?php
// coinチェック処理をオミットする
// XXX 実際にはissetで変数存在を確認しているだけなので値はなんでもいいが、分かりやすくtrueにしておく
$coin_check_omit = true;

// 初期化処理
require_once('../base.inc');

// 情報削除
setcookie('name', '');
setcookie('coin', -1, time() - 60);

// 出力処理
$template_name = 'defeat.tpl';
require_once('../fin.inc');
