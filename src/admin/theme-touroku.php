<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>掲示板テーマ登録画面</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<style>
    body{
    background-image: url('img/gamen.png');
    font-family:'misakigothic';
    background-size: 100% 300%;
    background-repeat: no-repeat;
      
    /* コンテンツの高さが画像の高さより大きい時、動かないように固定 */
    background-attachment: fixed;
      
    /* 表示するコンテナの大きさに基づいて、背景画像を調整 */
    background-size: cover;
      
    /* 背景画像が読み込まれる前に表示される背景のカラー */
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

.nes-btn2{
    margin-right: 500px;
    padding: 20px;
    margin-left: 100px;
}
   
</style>   
    <div class="theme">
    <div class="flex_box">
    <?php
        $pdo=new PDO($connect, USER, PASS);

        $sql=$pdo->query('select * from Theme ');
        foreach($sql as $row){
               
            echo '<div class="flex_item">';
            echo '<div class="checkbox">';
            echo '<label><img src="../img/',$row['theme_jpg'],'".jpg" class="img_game" alt="写真">';
            echo '<input type="checkbox" name="theme_id[]" value="',$row['theme_id'],'"><span>',$row['theme_name'],'</span>';
            echo '</label></div></div>';
               
        }
    ?>
    <br>
    <br>
    <div style="display:inline-flex">
        <form action="admin-theme-touroku-input.php" method="POST">
        <input type="submit" class="nes-btn2"  id="insert" value="登録">
        </form>
        <form action="admin-top.php" method="POST">        
        <input type="submit" class="nes-btn2"  id="insert" value="戻る">
        <br>
    </div>
    </div>
    </div>
</body>
</html>
