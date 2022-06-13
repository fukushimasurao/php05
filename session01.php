<?php
// 絶対必要
session_start();
$name = 'fukushima';
$sid = session_id();

$_SESSION['name'] = 'ふくしま';
$_SESSION['age'] = 16;
$_SESSION['love'] = 'ラーメン二郎';

echo $sid;
