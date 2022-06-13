<?php

$pw = password_hash('test3', PASSWORD_DEFAULT);
echo $pw;

// 表示された内容が 'test1' を hash化したもの
