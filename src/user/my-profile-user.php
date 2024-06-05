<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/my-profile-user.css">
    <title>プロフィール</title>
</head>
<body>
    <main>
    <header>
        <a herf="top.php"><img src="img/AGB.png" class="logo"></a>
        <form method="post" id="form" action="search.php">
            <div class="nes-field">
                <label for="search_field"></label>
                <input type="text" id="search_field" class="nes-input" placeholder="キーワードを入力">
            </div>
        </form>
        <a class="nes-btn"  id="prof" href="#">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <div class="profile-user">
    <?php
        $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from User where user_id = ? ');
            $sql->execute([47]);
            foreach($sql as $row){
                echo '<img alt="image" src="img/', $row['user_icon'], '.jpg" class="img_game1">';
                echo '<br><br><span class="name">',$row['user_name'],'</span>';
            }

        $pdo=new PDO($connect, USER, PASS);
            $sql2=$pdo->prepare('SELECT * from Favorite 
                                LEFT JOIN  Theme ON Favorite.theme_id = Theme.theme_id where user_id=?');
            $sql2->execute([47]);
                echo '<p class="p_mpu">お気に入り</p>';
            foreach($sql2 as $row){
                echo '<div class="flex_item">';
                echo '<a href="detail.php?id=', $row['theme_id'], '"><img src="img/',$row['theme_jpg'],'".jpg" class="img_game" alt="写真">';
                echo '</div>';
            }

    ?>
    <form action="#" method="POST">
        <br>
        <input type="submit" class="nes-btn"  id="insert" value="戻る">
    </form>
    </div>
    </main>
</body>
</html>