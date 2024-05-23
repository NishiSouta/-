<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/top.css">
    <title>トップ画面</title>
</head>
<body>
<<<<<<< Updated upstream
    <div class="header">
        <img src="img/AGB.png">
    </div>
    
=======
    <header>
        <a herf="top.php"><img src="img/AGB.png" class="logo"></a>
        <form method="get" id="form" action="自分のサイトURL">
            <div class="nes-field">
                <label for="search_field"></label>
                <input type="text" id="search_field" class="nes-input" placeholder="キーワードを入力">
            </div>
        </form>
        <a class="nes-btn"  id="prof" href="#">プロフィール</a>
        <a class="nes-btn" id="logout" href="logout.php">ログアウト</a>
    </header>
    <main>
        <h3>お気に入り</h3>
        <div class="flex_box">
            <?php
                for($i=0; $i<6; $i++){
                    echo '<div class="flex_item"><div class="img_game"></div></div>';
                }
            ?>
        </div>
        <h3>テーマ</h3>
        <div class="flex_box">
            <?php
                for($i=0; $i<6; $i++){
                    echo '<div class="flex_item"><div class="img_game"></div></div>';
                }
            ?>
        </div>
    </main>
>>>>>>> Stashed changes
</body>
</html>