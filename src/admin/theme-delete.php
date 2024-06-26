<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>掲示板テーマ削除画面</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<style>
    body {
        background-image: url('img/gamen.png');
        font-family: 'misakigothic';
        background-size: 100% 300%;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
        margin: 40px;
        color: #212529;
        padding: 40px;
    }
    .checkbox label {
        position: relative;
        display: block;
    }
    .checkbox label input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }
    .checkbox label input[type="checkbox"] + span {
        display: block;
        color: black;
        border-radius: 0.5rem;
        padding: 0.5rem;
    }
    .checkbox label input[type="checkbox"]:checked + span {
        background-color: blue;
        color: white;
    }
    .nes-btn2 {
        margin-right: 500px;
        padding: 20px;
        margin-left: 100px;
    }
    .flex_box {
        display: flex;
        flex-wrap: wrap;
    }
    .flex_item {
        margin: 10px;
    }
    .img_game {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
</style>
<div class="theme">
    <div class="flex_box">
        <form action="theme-delete-confirm.php" method="POST">
            <?php
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo->query('SELECT * FROM Theme');
                foreach($sql as $row) {
                    echo '<div class="flex_item">';
                    echo '<div class="checkbox">';
                    echo '<label><img src="img/' . htmlspecialchars($row['theme_jpg'], ENT_QUOTES, 'UTF-8') . '" class="img_game" alt="写真">';
                    echo '<input type="checkbox" name="theme_id[]" value="' . htmlspecialchars($row['theme_id'], ENT_QUOTES, 'UTF-8') . '"><span>' . htmlspecialchars($row['theme_name'], ENT_QUOTES, 'UTF-8') . '</span>';
                    echo '</label></div></div>';
                }
            ?>
            <br>
            <br>
            <div style="display:inline-flex">
                <input type="submit" class="nes-btn2" value="削除">
            </div>
        </form>
        <form action="admin-top.php" method="POST">
            <input type="submit" class="nes-btn2" value="戻る">
        </form>
    </div>
</div>
</body>
</html>