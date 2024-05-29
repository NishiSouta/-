<?php session_start();?>
<?php require 'db-connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/favorite.css">
    <title>お気に入り</title>
</head>
<body>
<div class="header">

    </div>
    
    <header>
        <a herf="top.php"><img src="img/AGB.png" class="logo"></a>
        <form method="get" id="form" action="自分のサイトURL">
            <div class="nes-field">
                <label for="search_field"></label>
                <input type="text" id="search_field" class="nes-input" placeholder="キーワードを入力">
            </div>
        </form>
        <a class="nes-btn"  id="prof" href="#">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <main>
    
  
    <h3 class="h3_thema">テーマを選択してください</h3>
    <div class="thema">
    <div class="flex_box">
<?php

    $pdo=new PDO($connect, USER, PASS);

    $sql=$pdo->query('select * from Theme ');
    foreach($sql as $row){
        $id=$row['theme_id'];

        echo '<div class="flex_item"><img alt="image" src="img/', $row['Theme_jpg'], '.jpg" class="img_game"  height="150" width="150">';

        echo '<span><h4>', $row['theme_name'],'</span></div>';

    }
        

    

?>
</div>
<a class="nes-btn"  id="insert" href="#">登録</a>
</div>
</main>
</body>
</html>