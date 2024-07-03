<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>掲示板テーマ削除確認画面</title>
    <style>
        body {
            background-image: url('img/gamen.png');
            font-family: 'Press Start 2P', cursive;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #464646;
            color: #fff;
            padding: 20px;
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        .theme-box {
            display: inline-block;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .theme-box img {
            width: 150px;
            height: 150px;
            margin-bottom: 10px;
        }
        .button-box {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .button-box input {
            margin: 0 10px;
            width: 80px;
        }
        .title {
            color: red;
            font-size: 18px;
            margin-bottom: 20px;
        }
        .theme-name {
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="theme-box nes-container with-title">
            <h3 class="title">こちらのテーマを削除してもよろしいですか?</h3>
            <?php
                $pdo = new PDO($connect, USER, PASS);

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme_id'])) {
                    $theme_ids = $_POST['theme_id'];
                    foreach ($theme_ids as $theme_id) {
                        $sql = $pdo->prepare('SELECT * FROM Theme WHERE theme_id = ?');
                        $sql->execute([$theme_id]);
                        if ($row = $sql->fetch()) {
                            echo '<img src="../img/'.$row['theme_jpg'].'.jpg" alt="テーマ画像"><br>';
                            echo '<p class="theme-name">'.$row['theme_name'].'</p>';
                            echo '<form action="theme-delete-kanryou.php" method="POST" style="display:inline;">';
                            foreach ($theme_ids as $id) {
                                echo '<input type="hidden" name="theme_id[]" value="'.$id.'">';
                            }
                            echo '<input type="submit" class="nes-btn is-primary" value="はい">';
                            echo '</form>';
                            echo '<form action="admin-top.php" method="POST" style="display:inline;">';
                            echo '<input type="submit" class="nes-btn is-error" value="いいえ">';
                            echo '</form>';
                            break;
                        } else {
                            echo '<p>テーマが見つかりません。</p>';
                        }
                    }
                } else {
                    echo '<p>テーマが選択されていません。</p>';
                }
            ?>
        </div>
    </div>
</body>
</html>
