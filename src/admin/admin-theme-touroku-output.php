<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テーマ登録完了画面</title>
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin-theme-touroku-output.css"><!-- ここに自分のCSSファイルのリンクを追加 -->
</head>
<body>
    <div class="container">
        <?php
        $pdo = new PDO($connect, USER, PASS);

        $name = htmlspecialchars($_POST['name']);

        // ファイルのアップロード処理
        $upload_directory = '../img/';
        $user_icon = $_FILES['img']['name'];
        $user_icon_tmp = $_FILES['img']['tmp_name'];

        // 拡張子を取り除いたファイル名を取得
        $user_icon_name_without_extension = pathinfo($user_icon, PATHINFO_FILENAME);

        // 新しいファイル名を生成
        $new_file_name = $user_icon_name_without_extension . ".jpg";
        $new_file_path = $upload_directory . $new_file_name;

        // アップロードされたファイルを指定のディレクトリに移動する
        if (move_uploaded_file($user_icon_tmp, $new_file_path)) {
            echo "";
        } else {
            echo "ファイルのアップロードに失敗しました。";
        }

        try {
            // データベースに登録する処理
            $sql = 'INSERT INTO Theme (theme_name, theme_jpg) VALUES (:name, :img)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':img', $user_icon_name_without_extension);

            if ($stmt->execute()) {
                echo '<p>テーマ登録が完了しました。</p>';
            } else {
                echo "エラー: テーマの登録に失敗しました。";
            }
        } catch (PDOException $e) {
            die("エラー: " . $e->getMessage());
        }

        // ステートメントと接続を閉じる
        unset($stmt);
        unset($pdo);
        ?>
        <form action="admin-top.php" method="POST">
            <input type="submit" class="nes-btn" value="TOPへ戻る">
        </form>
    </div>
</body>
</html>
