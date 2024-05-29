<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/top.css">
    <title>トップ</title>
</head>
<body>
    <?php require 'db-connect.php'; ?>
    <?php require 'header.php'; ?>
    <main>
        <h3>お気に入り</h3>
        <div class="flex_box">
            <?php
                for($s1=0; $s1<6; $s1++){
                    echo '<div class="flex_item"><img src="img/white.png" class="img_game"></div>';
                }
            ?>
        </div>
        <h3>テーマ</h3>
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
                            '<img src="img/',$row['Theme_jpg'],'.jpg" class="img_game" alt="写真">',
                            '<div class="game_title">',$row['theme_name'],"</div>",
                        '</div></a>';
                    $cnt++;
                }
            ?>
        </div>
    </main>
</body>
</html>