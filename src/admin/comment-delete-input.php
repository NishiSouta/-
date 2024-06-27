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
    
        <h1 class="h1">アカウント一覧</h1>
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

        margin: 70px;
        color: #212529;
        padding: 50px;
        padding-left: 450px;

    }
    .nes-btn{
    margin-right:450px;
    }
    </style>
      
            
        <?php
         if (isset($_POST['chat_id']) ) {
            echo '<a><font color="red">こちらのコメントを削除してもよろしいですか</font></a>';
            echo '<div class="delete">';
            echo '<form action="comment-delete-output.php" method="POST">';
            $chat_id = $_POST['chat_id'];
            $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('SELECT * FROM `Chat` 
                                    LEFT JOIN  User ON User.user_id = Chat.user_id WHERE chat_id = ?  ');
                $sql->execute(array($chat_id));
                
                foreach($sql as $row){
                echo '名前：',$row['user_name'],'<br>';
                echo 'コメント：',$row['chat_content'],'<br>';
                echo '投稿日時：',$row['chat_postdate'];
                echo '<input type="hidden" name="chat_id" value="',$chat_id,'" />';
                    
            
                }
                echo '</div>';
                echo '<br>';
                echo '<div style="display:inline-flex">';
                echo '<input type="submit" class="nes-btn"  id="insert" value="削除">';
                echo '</form>';
                echo '<form action="comment-itiran.php" method="POST">';
                echo '<input type="submit" class="nes-btn"  id="insert" value="戻る">';
                echo '<br>';
                echo '</div>';
        }else{
            echo '<p>コメントが見つかりませんでした。</p>';
            echo '</div>';
            echo '<br>';
            echo '<div style="display:inline-flex">';
            echo '<form action="comment-itiran.php" method="POST">';
            echo '<input type="submit" class="nes-btn"  id="insert" value="戻る">';
            echo '<br>';
            echo '</div>';
        }
        ?>
        <!-- </div>
        <br>
        <div style="display:inline-flex">
        <input type="submit" class="nes-btn"  id="insert" value="削除">
        </form>
        <form action="account-itiran.php" method="POST">
        <input type="submit" class="nes-btn"  id="insert" value="戻る">
        <br>
        </div> -->
    </body>
</html>