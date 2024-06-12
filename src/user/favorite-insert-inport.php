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
<style>
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
   
</style>   
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
    
    <br>
    <br>
    <h3 class="h3_theme">テーマを選択してください</h3>
    <div class="theme">
    <div class="flex_box">
<?php
    echo '<form action="favorite-insert-output.php" method="POST">';
    $pdo=new PDO($connect, USER, PASS);

    $sql=$pdo->query('select * from Theme ');
    foreach($sql as $row){
       
        echo '<div class="flex_item">';
        echo '<div class="checkbox">';
        echo '<label><img src="img/',$row['theme_jpg'],'".jpg" class="img_game" alt="写真">';
        echo '<input type="checkbox" name="theme_id[]" value="',$row['theme_id'],'"><span>',$row['theme_name'],'</span>';
        echo '</label></div></div>';
       
    }

    

?>
</div>

<br>
<br>
<input type="submit" class="nes-btn"  id="insert" value="登録">

</div>
</form>
</main>
</body>
</html>