<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>掲示板テーマ削除完了画面</title>
    <style>
        body {
            background-image: url('img/gamen.png');
            font-family: 'Press Start 2P', cursive;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
            text-align: center;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* 画面の高さいっぱいに設定 */
            margin: 0;
        }
        .container {
            margin-top: 20px; /* ボタンとの間のスペース */
        }
        p {
            font-size: 24px; /* 段落のフォントサイズを大きく設定 */
        }
        .nes-btn {
            font-size: 20px; /* ボタンのフォントサイズを大きく設定 */
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $pdo = new PDO($connect, USER, PASS);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme_id'])) {
            $theme_ids = $_POST['theme_id'];
            $deleted_count = 0;

            foreach ($theme_ids as $theme_id) {
                // Favoriteテーブルの関連レコードを削除
                $sql = $pdo->prepare('DELETE FROM Favorite WHERE theme_id = ?');
                $sql->execute([$theme_id]);

                // Themeテーブルのレコードを削除
                $sql = $pdo->prepare('DELETE FROM Theme WHERE theme_id = ?');
                $sql->execute([$theme_id]);

                if ($sql->rowCount() > 0) {
                    $deleted_count++;
                }
            }

            if ($deleted_count > 0) {
                echo '<p>選択されたテーマが削除されました。</p>';
            } else {
                echo '<p>削除するテーマが選択されていません。</p>';
            }
        } else {
            echo '<p>削除するテーマが選択されていません。</p>';
        }
        ?>
        
        <!-- 次の行にボタンを表示 -->
        <form action="admin-top.php" method="POST">
            <input type="submit" class="nes-btn" value="TOPへ戻る">
        </form>
    </div>
</body>
</html>
