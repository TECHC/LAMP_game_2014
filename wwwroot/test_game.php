<?php

// 初期化処理
require_once('../base.inc');

// modeに合わせて処理
// XXX より綺麗には「ファクトリパターンつかってクラス分け」とか色々ありますが、一端、ベタっと
$mode = (string)@$_GET['mode'];

if ('win' === $mode) {
  $smarty->assign('win', true);
  $_COOKIE['coin'] += 5; // XXX 表示の都合があるので、$_COOKIEを直接変更
  setcookie('coin', $_COOKIE['coin']);
}
if ('lose' === $mode) {
  $smarty->assign('lose', true);
  $_COOKIE['coin'] -= 5; // XXX 表示の都合があるので、$_COOKIEを直接変更
  setcookie('coin', $_COOKIE['coin']);
}

// 出力処理
$template_name = 'test_game.tpl';
require_once('../fin.inc');

