<?php session_start();?>
<!-- データベース接続 -->
<?php
    const SERVER ='mysql304.phy.lolipop.lan';
    const DBNAME ='LAA1516804-budou';
    const USER ='LAA1516804';
    const PASS ='pass1109';
 
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/reset.css" />
    <title>管理者ログイン画面</title>
</head>
<body>
<p><img class="rogo" src="img/AGB.png" alt="写真" width="129" height="90"></p>
    <div id="center"></div> 
    <?php

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement
    $sql = $pdo->prepare('SELECT * FROM Admin WHERE admin_name = ? AND admin_pw = ?');
    $sql->execute([$_REQUEST['login'], $_REQUEST['password']]);

    // Fetch the user data
    $user = $sql->fetch(PDO::FETCH_ASSOC);

    // If user data is found
    if ($user) {
        $_SESSION['customer'] = [
            'admin_id' => $user['admin_id'],
            'admin_name' => $user['admin_name'],
            'admin_pw' => $user['admin_pw']
        ];
        echo '<div id="center"><h1>';
        echo  $_SESSION['customer']['admin_name'], 'さん', '<br>';
        echo '<a href="admin-top.php">ホームへ</a>';
        echo '</h1></div>';
    } else {
        echo '<div id="center"><h1>';
        echo '管理者名またはパスワードが違います', '<br>';
        echo '<a href="admin-login-input.php">管理者ログイン画面へ戻る</a>';
        echo '</h1></div>';
    }

} catch (PDOException $e) {
    echo '<div id="center"><h1>';
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    echo '</h1></div>';
}
?>

    
</body>
</html>