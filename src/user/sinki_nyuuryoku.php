<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/sinki_nyuuryoku.css">
    <title>新規登録入力画面</title>
</head>
<body>
    <div id="center">
        <h2>新規登録</h2>
    </div>
    <form action="sinki_kakunin.php" method="post" enctype="multipart/form-data">
        <div id="center">
            <!-- ユーザープロフィール画像の選択フォーム -->
            <div class="user-icon">
                <label for="user_icon_input">
                    <img src="img/default_icon.png" id="user_icon_preview" class="rounded-icon">
                </label>
                <input type="file" id="user_icon_input" name="user_icon" accept="image/*" style="display: none;" onchange="previewUserIcon(event)">
            </div>
        </div>
        <div id="center">
            <h2>名前<input type="text" name="name" required></h2>
        </div>
        <div id="center">
            <h2>メールアドレス<input type="email" name="mail" required></h2>
        </div>
        <div id="center">
            <h2>パスワード<input type="password" name="password" required></h2>
        </div>
        <div id="center">
            <h2>好きなテーマを1つ選んでください</h2>
        </div> 
        <div class="flex_box">
            <?php
                require 'db-connect.php';
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo->query('select * from Theme');
                $count = 0;
                foreach ($sql as $row) {
                    if ($count == 6) {
                        echo '</div><div class="flex_box">';
                        $count = 0;
                    }
                    echo '<div class="flex_item">';
                    echo '<input type="radio" name="theme" id="theme' . $row['theme_id'] . '" value="' . $row['theme_id'] . '" required>';
                    echo '<label for="theme' . $row['theme_id'] . '">';
                    echo '<img src="img/' . $row['theme_jpg'] . '" class="img_game">';
                    echo '</label>';
                    echo '</div>';
                    $count++;
                }
            ?>
        </div>
        <div id="center">
            <button type="submit">登録</button>
        </div>
    </form>
    <script>
        function previewUserIcon(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('user_icon_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
