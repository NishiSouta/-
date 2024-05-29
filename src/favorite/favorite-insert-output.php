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
    <div class="thema">
    <div class="flex_box">
<?php 
if(isset($_SESSION['customer'])){
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('insert into favorite(`theme_id`, `user_id`) value(?,?)');
    $sql->execute([$_SESSION['customer']['id'], $_GET['id']]);
    echo '登録完了しました。';
    echo ' <form action="m-home.php" method="post">';
    echo '<input type="submit" value="プロフィールへ戻る" class="button2">';
    echo '</form>';
     require 'favorite.php';
    }else {
        echo 'お気に入りに追加するには、ログインしてください。';

    }

?>
</div>
</div>
</main>
</body>
</html>