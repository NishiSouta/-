<?php session_start(); ?>
<!-- データベース接続 -->
<?php
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1516804-budou';
const USER = 'LAA1516804';
const PASS = 'pass1109';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

$error_message = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="stylesheet" type="text/css" href="./css/login2.css">
    <title>ログイン画面</title>
    <style>
        .error-message {
            color: red;
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- 左上にアイコン画像を追加 -->
    <img id="agb-icon" src="./img/AGB.png" alt="AGB Icon">
    <div class="login">
        <h1>ログイン</h1>
    </div>
    <form action="login-output.php" method="post">
        <div class="form">
            <label class="mail">
                <input type="text" name="mail" placeholder="例）kokusi@kokusi.budou"><br>
                <a id="mailikon">
                    <!-- メールアイコンのSVG -->
                </a>
            </label>
            <label class="password">
                <input type="password" name="password" placeholder="PassWord">
                <a id="key">
                    <!-- キーのSVG -->
                </a>
            </label>
            <input type="submit" name="regist" value="Login">
            
            <div class="sinki">
                <a href="./sinki_nyuuryoku.php">新規登録はこちら</a>
            </div>
        
            <?php if (!empty($error_message)) { ?>
                <div class="error-message"><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php } ?>
        </div>
    </form>
</body>
</html>