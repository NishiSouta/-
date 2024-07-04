<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// データベース接続設定
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1516804-budou';
const USER = 'LAA1516804';
const PASS = 'pass1109';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

// ユーザーIDをセッションから取得
$user_id = $_SESSION['user']['user_id'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>アカウント削除確認</title>
    
    <link rel="stylesheet" href="css/delete-confilm.css">
</head>
<body>
    <div class="confirmation-dialog">
        <div class="message">アカウントを削除してもよろしいですか？</div>
        <div class="buttons">
            <form action="delete-account.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                <button type="submit" class="confirm-button">はい</button>
            </form>
            <button class="cancel-button" onclick="window.history.back();">いいえ</button>
        </div>
    </div>
</body>
</html>