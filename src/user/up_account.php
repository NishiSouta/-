<?php
require 'db-connect.php'; // データベース接続の設定ファイルを読み込む
session_start(); // セッションを開始する
$pdo = new PDO($connect, USER, PASS); // PDOインスタンスを作成する

$error_message = "";
$user_id = $_SESSION['user']['user_id']; // セッションからユーザーIDを取得する

// ユーザーアイコンの更新処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES['user_icon']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["user_icon"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_image_name = uniqid() . '.' . $imageFileType;
        $target_path = $target_dir . $new_image_name;

        // アップロードされたファイルを指定のパスに移動する
        if (move_uploaded_file($_FILES["user_icon"]["tmp_name"], $target_path)) {
            try {
                // データベースにユーザーアイコンのファイル名を更新するクエリを実行する
                $sql = 'UPDATE User SET user_icon = :user_icon WHERE user_id = :user_id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_icon', $target_path); // ファイルのパスを保存
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                $error_message .= 'Error: ' . $e->getMessage();
            }
        } else {
            $error_message .= "ユーザーアイコンのアップロードに失敗しました。";
        }
    }

    // 名前とメールアドレスの更新処理
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);

    if (!empty($name) && !empty($mail)) {
        try {
            // データベースにユーザー情報を更新するクエリを実行する
            $sql = 'UPDATE User SET user_name = :name, user_mail = :mail WHERE user_id = :user_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: up_kanryou.php"); // 更新完了後にリダイレクトする
            exit();
        } catch (PDOException $e) {
            $error_message .= 'Error: ' . $e->getMessage();
        }
    } else {
        $error_message .= "全てのフィールドを入力してください。";
    }
}

// 現在のユーザー情報を取得するクエリを実行する
try {
    $sql = 'SELECT user_name, user_mail, user_icon FROM User WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ユーザーが見つからない場合の処理
    if (!$user) {
        $user = ['user_name' => '', 'user_mail' => '', 'user_icon' => 'default_icon.png'];
        $error_message .= "ユーザー情報が見つかりません。";
    }
} catch (PDOException $e) {
    $error_message .= 'Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/account.css">
    <title>アカウント情報更新</title>
</head>
<body>
    <div id="center">
        <h2>アカウント情報更新</h2>
        <?php if ($error_message): ?>
            <p style="color:red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="user-icon">
                <label for="user_icon_input">
                    <img src="<?= htmlspecialchars($user['user_icon']) ?>" id="user_icon_preview" class="rounded-icon">
                </label>
                <input type="file" id="user_icon_input" name="user_icon" accept="img/*" style="display: none;" onchange="previewUserIcon(event)">
            </div>
            <div>
                <label for="name"><h2>名前</h2></label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['user_name']) ?>">
            </div>
            <div>
                <label for="mail"><h2>メールアドレス</h2></label>
                <input type="email" id="mail" name="mail" value="<?= htmlspecialchars($user['user_mail']) ?>">
            </div>
            <div>
                <label for="password"><h2>パスワード</h2></label>
                <input type="password" id="password" name="password" value="<?= htmlspecialchars($user['user_mail']) ?>">
            </div>
            <div id="left">
                <button type="button" onclick="history.back()">戻る</button>
            </div>
            <div id="right">
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
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