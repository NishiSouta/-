<?php
include 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);

    if (!empty($name) && !empty($mail) && !empty($password)) {
        // データベースに挿入する
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO User (user_name, user_mail, user_pw) VALUES (:name, :mail, :password)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();

            // データが挿入された後にHTMLを表示
            ?>
            <!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="sinki_nyuuryoku.css">
                <title>新規登録確認画面</title>
            </head>
            <body>
                <div id="center">
                    <h2>確認画面</h2>
                </div>
                <div id="center">
                    <p><h2>名前: <?= htmlspecialchars($name) ?></h2></p>
                    <p><h2>メールアドレス: <?= htmlspecialchars($mail) ?></h2></p>
                    <p><h2>パスワード: <?= htmlspecialchars($password) ?></h2></p>
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
