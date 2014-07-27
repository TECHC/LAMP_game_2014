<?php
// coinチェック処理をオミットする
// XXX 実際にはissetで変数存在を確認しているだけなので値はなんでもいいが、分かりやすくtrueにしておく
$coin_check_omit = true;

// 初期化処理
require_once('../base.inc');


// 出力処理
$template_name = 'index.tpl';
require_once('../fin.inc');
