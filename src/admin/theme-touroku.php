<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/reset.css" />
    <title>掲示板テーマ登録画面</title> 
</head>
<body>
        <p><img class="rogo" src="img/AGB.png" alt="写真" width="200" height="180"></p><!-- ロゴ  -->
    

   <!-- テーマの一覧表示  -->

<main>
        <div class="flex_box">
            <?php
                $pdo=new PDO($connect,USER,PASS);
                $sql=$pdo->query('select * from Theme');
                $cnt = 0;
                foreach($sql as $row){
                    if( $cnt>6 ){
                        
                        break;
                    }
                    echo '<a href="detail.php?id=',$row['theme_id'],'"><div class="flex_item">',
                            '<img src="img/',$row['theme_jpg'],'.jpg" class="img_game" alt="写真">',
                            '<div class="game_title">',$row['theme_name'],"</div>",
                        '</div></a>';
                    $cnt++;
                    
                }
                
        ?>
    </div>
    <!--<div id="center"><p><h2>テーマ</h2></p></div>-->
    <div id="modoru-button"><a href="admin-top.php"class="btn">戻る</a></div> <!-- 戻る  -->
    <div id="toroku-botton"><a href="admin-theme-touroku-input.php"class="btn">登録</a></div> <!-- 登録  -->
            </main>
</body>
</html>