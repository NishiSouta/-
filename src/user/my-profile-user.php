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
        <a href="top.php"><img src="img/AGB.png" class="logo"></a>
        <form method="post" id="form" action="search.php">
            <div class="nes-field">
                <label for="search_field"></label>
                <input type="text" id="search_field" class="nes-input" placeholder="キーワードを入力">
            </div>
        </form>
        <a class="nes-btn"  id="prof" href="my-profile.php">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <div class="profile-user">
    <?php
        $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from User where user_id = ? ');
            $sql->execute([$_GET['user_id']]);
            foreach($sql as $row){
                echo '<img alt="image" src="', $row['user_icon'],  '" class="img_game1">';
                echo '<br><br><span class="name">',$row['user_name'],'</span>';
            }

                $pdo=new PDO($connect, USER, PASS);
                    $sql2=$pdo->prepare('select distinct theme_jpg,  theme_name, Theme.theme_id from Favorite 
                                         LEFT JOIN  Theme ON Favorite.theme_id = Theme.theme_id where user_id=? ');
                    $sql2->execute(array($_SESSION['user']['user_id']));
                            echo '<p class="p_mpu">お気に入り</p>';
                            echo '<div class="flex_box">';   
                        foreach($sql2 as $row2){
                                         
                            echo '<div class="flex_item">';
                            echo '<a href="detail.php?theme_id=' . $row2['theme_id'] . '"><img src="img/',$row2['theme_jpg'],'".jpg" class="img_game" alt="写真">';
                            echo '</div>';
                        }
            echo '<a href="chat.php?board_id=',$_GET['board_id'],'"><button type="button">戻る</button></a>';


    ?>
    </div>
    </main>
</body>
</html>