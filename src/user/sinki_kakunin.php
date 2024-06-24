<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ユーザープロフィール画像の処理
    $user_icon = $_FILES['user_icon']['name']; // アップロードされたファイル名
    $user_icon_tmp = $_FILES['user_icon']['tmp_name']; // 一時ファイル名
    $upload_directory = "uploads/"; // アップロード先のディレクトリ

    // ファイルを指定のディレクトリに移動する
    move_uploaded_file($user_icon_tmp, $upload_directory.$user_icon);

    // ユーザープロフィール画像のファイルパスをデータベースに保存する
    // ここではファイル名のみを保存していますが、必要に応じてフルパスを保存しても構いません
    $user_icon_path = $upload_directory.$user_icon;

    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);
    $theme_id = htmlspecialchars($_POST['theme']); // 選択されたテーマのIDを取得

    if (!empty($name) && !empty($mail) && !empty($password) && !empty($theme_id)) {
        // テーマの画像ファイル名をデータベースから取得
        $sql_theme = "SELECT theme_jpg FROM Theme WHERE theme_id = :theme_id";
        $stmt_theme = $pdo->prepare($sql_theme);
        $stmt_theme->bindParam(':theme', $theme_id);
        $stmt_theme->execute();
        $theme_row = $stmt_theme->fetch(PDO::FETCH_ASSOC);
        $theme_image = $theme_row['theme_jpg'];

        // データベースに挿入する
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO User (user_name, user_mail, user_pw, user_icon) VALUES (:name, :mail, :password, :user_icon)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':user_icon', $user_icon_path); // ファイルパスを保存
            $stmt->execute();
            if (isset($_POST['theme']) ) {
                $pdo=new PDO($connect, USER, PASS);
                $theme_id = $_POST['theme_id'];
                foreach($theme_id as $theme){
                    $sql=$pdo->prepare('insert into Favorite(`theme_id`, `user_id`) value(?,?)');
                    $sql->execute([(int)$theme,$_SESSION['user']['user_id']]);
                 
                }
            }else{
    
            }
            // データが挿入された後にHTMLを表示
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
                    <p><img src="<?= $user_icon_path ?>" alt="ユーザープロフィール画像" class="rounded-icon"></p> <!-- ユーザープロフィール画像の表示 -->
                    <p><h2>名前: <?= htmlspecialchars($name) ?></h2></p>
                    <p><h2>メールアドレス: <?= htmlspecialchars($mail) ?></h2></p>
                    <p><h2>パスワード: <?= htmlspecialchars($password) ?></h2></p>
                    <p><h2>好きなテーマ：</h2></p>
                    <img src="img/<?= htmlspecialchars($theme_image) ?>" alt="選択されたテーマの画像" class="rounded-icon"> <!-- 選択されたテーマの画像を表示 -->
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
            exit(); // PHPの処理を終了
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
