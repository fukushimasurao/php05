<?php
session_start();
require_once('../funcs.php');
loginCheck();

// postされたら、セッションの内容も合わせて更新
$title = $_SESSION['post']['title'] = $_POST['title'];
$content = $_SESSION['post']['content'] = $_POST['content'];

// imgがある場合
if ($_FILES['img']['name']) {
    $fileName = $_SESSION['post']['file_name']= $_FILES['img']['name'];
    $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
    $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);
} else {
    $image_data = $_SESSION['post']['image_data'] = '';
    $image_type = $_SESSION['post']['image_type'] = '';
}

// 簡単なバリデーション処理。
if (trim($title) === '') {
    $err[] = 'タイトルを確認してください。';
}

if (trim($content) === '') {
    $err[] = '内容を確認してください';
}

//写真は拡張子をチェック
if (!empty($fileName)) {
    $check =  substr($fileName, -3);
    if ($check != 'jpg' && $check != 'gif' && $check != 'png') {
        $err[] = '写真の内容を確認してください。';
    }
}

// もしerr配列に何か入っている場合はエラーなので、redirect関数でindexに戻す。その際、GETでerrを渡す。
if (count($err) > 0) {
    redirect('post.php?error=1');
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
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">ブログ画面へ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post.php">投稿する</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">投稿一覧</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="logout.php">ログアウト</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-danger">記入内容を確認してください</p>
    <?php endif;?>
    <form method="POST" action="register.php" enctype="multipart/form-data" class="mb-3">
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="hidden"name="title" value="<?= $title ?>">
            <p><?= $title ?></p>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">記事内容</label>
            <input type="hidden"name="content" value="<?= $content ?>">
            <div><?= nl2br($content) ?></div>
        </div>
        <img src="" alt="">
        <?php if ($image_data): ?>
        <div class="mb-3">
            <img src="image.php">
        </div>
        <?php endif;?>
        <button type="submit" class="btn btn-primary">投稿</button>
    </form>

    <a href="post.php?re-register=true">前の画面に戻る</a>
</body>
</html>
