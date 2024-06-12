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
            <!-- <div class="nes-field">
                <label for="search_field"></label>
                <input type="text" id="search_field" class="nes-input" placeholder="キーワードを入力">
            </div> -->
        </form>
        <a class="nes-btn"  id="prof" href="my-profile.php">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <main>
    

    <div class="theme_output">
<?php
if(isset($_SESSION['user'])){
    if (isset($_POST['theme_id']) ) {
        $pdo=new PDO($connect, USER, PASS);
        $theme_id = $_POST['theme_id'];
        foreach($theme_id as $theme){
        $sql=$pdo->prepare('delete from Favorite where theme_id=?');
        $sql->execute([(int)$theme]);
        }
        echo '削除完了しました。';
        echo '<br>';
        echo '<br>';
         echo '<form action="my-profile.php" method="POST">';
                echo '<input type="submit" value="プロフィールへ戻る" class="profile">';
                echo '</form>';
    
    }else{

    }
}else {
    echo 'お気に入りから削除するには、ログインしてください。';
}
?>

