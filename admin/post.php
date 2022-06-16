<?php
session_start();
require_once('../funcs.php');
require_once('../common/header_bar.php');
loginCheck();

// 前に戻るボタン用に、sessionを用意しておく。
$title = '';
$content = '';
$img_path = '';
if ($_SESSION['post']['title']) {
    $title = $_SESSION['post']['title'];
}
if ($_SESSION['post']['content']) {
    $content = $_SESSION['post']['content'];
}

if ($_SESSION['post']['image_data']) {
    $image_data = $_SESSION['post']['image_data'];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>記事管理</title>
</head>

<body>
    <?= $nav_bar ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger">記入内容を確認してください</p>
    <?php endif;?>
    <form method="POST" action="confirm.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="<?= $title ?>">
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">記事内容</label>
            <textArea type="text" class="form-control" name="content" id="content" aria-describedby="content" rows="4" cols="40"><?= $content ?></textArea>
            <div id="emailHelp" class="form-text">※入力必須</div>
        </div>
        <?php if ($image_data): ?>
        <img src="image.php">
        <?php endif;?>
        <div class="mb-3">
            <label for="img" class="form-label">画像投稿</label>
            <input type="file" name="img">
        </div>
        <button type="submit" class="btn btn-primary">確認する</button>
    </form>
</body>
</html>
