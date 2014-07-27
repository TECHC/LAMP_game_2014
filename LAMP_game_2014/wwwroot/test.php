<?php

require_once('../base.inc');

//
$data = '<a href="./">test</a>';
$smarty->assign('hoge', $data);

//
$s = $smarty->fetch('test.tpl');
echo $s;
