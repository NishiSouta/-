<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/top.css">
    <title>検索結果</title>
</head>
<body>
    <?php require 'db-connect.php'?>
    <?php require 'header.php'?>
    <main>
        <h3>検索キーワード：<?= $_POST['keyword'] ?></h3>
        <div class="flex_box">
            <?php
                if ( empty($_POST['keyword']) ) {
                        echo '<h3 class="nothing">検索キーワードを入力してください</h3>';
                }else{
                    $pdo=new PDO($connect,USER,PASS);
                    $sql=$pdo->prepare('select * from Theme where theme_name like ?');
                    $sql->execute(['%'.$_POST['keyword'].'%']);
                    if( empty($sql->fetchAll()) ){
                        echo '<h3 class="nothing">検索キーワードに該当するゲームがありません</h3>';
                    }else{
                        $sql=$pdo->prepare('select * from Theme where theme_name like ?');
                        $sql->execute(['%'.$_POST['keyword'].'%']);
                        foreach ($sql as $row){
                            echo '<a href="detail.php?id=',$row['theme_id'],'"><div class="flex_item">',
                                    '<img src="img/',$row['theme_jpg'],'.jpg" class="img_game" alt="写真">',
                                    '<div class="game_title">',$row['theme_name'],"</div>",
                                '</div></a>';
                        }
                    }
                }
            ?>
        </div>
    </main>
</body>
</html>
<?php require 'footer.php'?>