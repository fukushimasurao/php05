<?php
require_once('common/head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?= $head ?>
    <title>ログイン</title>
</head>

<body>
    <?php if ($_GET['form_empty']): ?>
        <p class="text-danger">ID,PWを確認してください。</p>
    <?php elseif ($_GET['form_validation']): ?>
        <p class="text-danger">IDかPWに間違いがあります。</p>
    <?php endif;?>
    <form name="form1" action="login_act.php" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID</label>
            <input type="text" class="form-control" name="lid">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="lpw">
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
    </form>
</body>
</html>
