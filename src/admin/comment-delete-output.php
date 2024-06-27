<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin-delete.css" />
<body>
   
    <?php

    if (isset($_POST['chat_id']) ) {
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('delete from Chat where chat_id=?');
            $sql->execute([(int)$_POST['chat_id']]);

            echo '削除完了しました。';
            echo '<br>';
            echo '<br>';
            echo '<form action="admin-top.php" method="POST">';
            echo '<input type="submit" value="topへ戻る">';
            echo '</form>';
    }else{
        echo '<p>コメント削除に失敗しました。</p>';

    }
        
    ?>
</body>
</html>
        