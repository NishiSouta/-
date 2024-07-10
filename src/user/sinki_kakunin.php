<?php
session_start();
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ユーザープロフィール画像の処理
    $user_icon = $_FILES['user_icon']['name'];
    $user_icon_tmp = $_FILES['user_icon']['tmp_name'];
    $upload_directory = "../img/";

    // ファイルを指定のディレクトリに移動する
    move_uploaded_file($user_icon_tmp, $upload_directory . $user_icon);

    $user_icon_path = $upload_directory . $user_icon;

    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $theme_id = isset($_POST['theme']) ? $_POST['theme'] : null; // 選択されたテーマのIDを取得

    if (!empty($name) && !empty($mail) && !empty($password)) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO User (user_name, user_mail, user_pw, user_icon) VALUES (:name, :mail, :password, :user_icon)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':user_icon', $user_icon_path);
            $stmt->execute();
            
            $user_id = $pdo->lastInsertId(); // 挿入されたユーザーのIDを取得

            if (!empty($theme_id)) {
                $sql_theme = "SELECT theme_jpg FROM Theme WHERE theme_id = :theme_id";
                $stmt_theme = $pdo->prepare($sql_theme);
                $stmt_theme->bindParam(':theme_id', $theme_id);
                $stmt_theme->execute();
                $theme_row = $stmt_theme->fetch(PDO::FETCH_ASSOC);
                $theme_image = $theme_row['theme_jpg'];

                $sql_fav = 'INSERT INTO Favorite (theme_id, user_id) VALUES (:theme_id, :user_id)';
                $stmt_fav = $pdo->prepare($sql_fav);
                $stmt_fav->bindParam(':theme_id', $theme_id);
                $stmt_fav->bindParam(':user_id', $user_id);
                $stmt_fav->execute();
            }

            // 登録完了画面を表示
            ?>
            <!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
                <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
                <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
                <link rel="stylesheet" href="css/sinki_nyuuryoku.css">
                <title>新規登録確認画面</title>
            </head>
            <body>
                <div id="center">
                    <h2>確認画面</h2>
                </div>
                
                <div id="center">
                    <p><img src="<?= $user_icon_path ?>" alt="ユーザープロフィール画像" class="rounded-icon"></p>
                    <p><h2>名前: <?= htmlspecialchars($name) ?></h2></p>
                    <p><h2>メールアドレス: <?= htmlspecialchars($mail) ?></h2></p>
                    <p><h2>パスワード: <?= htmlspecialchars($password) ?></h2></p>
                    <?php if (!empty($theme_image)): ?>
                        <p><h2>好きなテーマ：</h2></p>
                        <img src="img/<?= htmlspecialchars($theme_image) ?>" alt="選択されたテーマの画像" class="rounded-icon">
                    <?php endif; ?>
                    <p><h2>この情報で大丈夫ですか？</h2></p>
                </div>
                <div id="left">
                    <button onclick="history.back()">戻る</button>
                </div>
                <div id="right">
                    <button onclick="location.href='./sinki_kanryou.php'">登録</button>
                </div>
            </body>
            </html>
            <?php
            exit();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo "<div id='center'><p>全てのフィールドを入力してください。</p></div>";
    }
} else {
    echo "<div id='center'><p>データが送信されていません。</p></div>";
}
?>
