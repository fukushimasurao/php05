<?php
session_start();
require_once('../funcs.php');
require_once('../common/header_bar.php');
require_once('../common/head.php');
loginCheck();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $head ?>
    <title>記事管理</title>
</head>

<body>
    <?= $nav_bar ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger">記入内容を確認してください</p>
    <?php endif;?>
    <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="title">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">記事内容</label>
            <textArea type="text" class="form-control" name="content" id="content" aria-describedby="content" rows="4" cols="40"><?= $row["content"] ?></textArea>
            <div id="emailHelp" class="form-text">※入力必須</div>

        </div>
        <div class="mb-3">
            <label for="img" class="form-label">画像投稿</label>
            <input type="file" name="img">
        </div>
        <button type="submit" class="btn btn-primary">投稿</button>
    </form>
</body>
</html>
