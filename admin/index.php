<?php
session_start();
require_once('../funcs.php');
loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_content_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <title>管理画面</title>
</head>

<body id="main">
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
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($contents as $content): ?>
                    <div class="col">
                        <div class="card shadow-sm">
                        <?php if ($content['img']): ?>
                            <img src="../images/<?=$content['img']?>" alt="" class="bd-placeholder-img card-img-top" >
                        <?php else: ?>
                            <img src="../images/default_image/no_image_logo.png" alt="" class="bd-placeholder-img card-img-top" >
                        <?php endif ?>
                        <div class="card-body">
                            <h3><?= $content['title'] ?></h3>
                            <p class="card-text"><?= nl2br($content['content']) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">登録日:<?= $content['date'] ?></small>
                            </div>
                            <?php if (!is_null($content['update_time'])): ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">更新日:<?= $content['update_time'] ?></small>
                            </div>
                            <?php endif ?>
                            <a href="detail.php?id=<?=$content['id']?>" class="btn btn-outline-info stretched-link">編集する</a>
                        </div>
                        </div>
                    </div>
                <!-- </a> -->
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>
