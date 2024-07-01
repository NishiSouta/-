<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin.css" />
    <title>アカウント一覧画面</title> 
</head>
<main>
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

        margin: 70px;
        color: #212529;
        padding: 90px;
        padding-left: 450px;

    }
    .nes-btn{
    margin-right:450px;
    }
</style>
<h1>コメント一覧</h1>
    <body>
    
        <?php
        echo '<form action="comment-delete-input.php" method="POST">';

        $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->query('SELECT * FROM `Chat` LEFT JOIN  User ON User.user_id = Chat.user_id ');

                echo '<table cellpadding="10">';
                echo '<tr><th></th><th>名前</th><th></th><th>投稿内容</th><th></th><th>投稿日時</th><th></th><tr>';
                foreach($sql as $row){
                
                    echo '<tr>';
                        echo '<td class="td_name"><input type="radio" name="chat_id" value="',$row['chat_id'],'"></td>';
                        echo '<td class="td_name">',$row['user_name'],'</td><td></td>';
                        echo '<td class="td">',$row['chat_content'],'</td><td></td>';
                        echo '<td class="td">',$row['chat_postdate'],'</td><td></td>';
                        // echo '<td class="td">',$row['user_pw'],'</td>';
                       
                    }
                echo '</table>';
                    

    ?>
    <br>
    <div style="display:inline-flex">
    <input type="submit" class="nes-btn"  id="insert" value="削除">
    </form>
    <br>
    <br>
    <form action="admin-top.php" method="POST">
    <input type="submit" class="nes-btn"  id="insert" value="戻る">
    <br>
    </div>
    </body>
<main>
</html>