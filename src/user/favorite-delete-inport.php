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
.p_theme{
    padding-left: 130px;


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
        <a class="nes-btn"  id="prof" href="#">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <main>
    
  
    <h3 class="h3_theme">テーマを選択してください</h3>
    <p class="p_theme">お気に入り一覧</p>
    <div class="theme">
    <div class="flex_box">
   
       
<?php
    echo '<form action="favorite-delete-output.php" method="POST">';

    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare("SELECT * from Favorite 
                        LEFT JOIN  Theme ON Favorite.theme_id = Theme.theme_id where user_id=?");
    $sql->execute([1]);

    foreach($sql as $row){
                echo '<div class="flex_item">';
                echo '<div class="checkbox">';
                echo '<label><img src="img/',$row['theme_jpg'],'".jpg" class="img_game" alt="写真">';
                echo '<input type="checkbox" name="theme_id[]" value="',$row['theme_id'],'"><span>', $row['theme_name'],'</span>';
                echo '</label></div></div>';
            

    }
            



    

?>
</div>
<p></p>
<input type="submit" class="nes-btn"  id="insert" value="削除">

</div>
</form>
</main>
</body>
</html>