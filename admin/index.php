<?php
session_start();
require_once('../funcs.php');
require_once('../common/header_bar.php');
require_once('../common/head.php');
loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_an_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $r["id"] . '">';
        $view .= $r["id"] . " " . $r["name"] . "|" . $r["email"];
        $view .= '</a>';
        $view .= " ";

        if ($_SESSION["kanri_flg"]) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r["id"] . '">';
            $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
            $view .= '</a>';
        }
        $view .= '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <?= $head ?>
    <title>管理画面</title>
</head>

<body id="main">
    <?= $nav_bar ?>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

</body>

</html>
