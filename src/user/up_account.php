<?php
include 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
session_start();
$error_message = "";

$user_id = $_SESSION['user_id'];

// ユーザーアイコンの更新処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES['user_icon']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["user_icon"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $new_image_name = uniqid() . '.' . $imageFileType;
        $target_path = $target_dir . $new_image_name;

        if (move_uploaded_file($_FILES["user_icon"]["tmp_name"], $target_path)) {
            // 新しいアイコンのファイル名をデータベースに保存する処理を追加する
            try {
                $sql = 'UPDATE User SET user_icon = :user_icon WHERE user_id = :user_id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_icon', $new_image_name);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
            } catch (PDOException $e) {
                $error_message .= 'Error: ' . $e->getMessage();
            }
        } else {
            $error_message .= "ユーザーアイコンのアップロードに失敗しました。";
        }
    }

    // 他のユーザー情報の更新処理
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars($_POST['password']);

    if (!empty($name) && !empty($mail) && !empty($password)) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = 'UPDATE User SET user_name = :name, user_mail = :mail, user_pw = :password WHERE user_id = :user_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute(array($_SESSION['user']['user_id']));

            header("Location: up_kanryou.php");
            exit();
        } catch (PDOException $e) {
            $error_message .= 'Error: ' . $e->getMessage();
        }
    } else {
        $error_message .= "全てのフィールドを入力してください。";
    }
}

// 現在のユーザー情報を取得
try {
    $sql = 'SELECT user_name, user_mail, user_icon FROM User WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <form method="post" action="up_kanryou.php" enctype="multipart/form-data">
            <div class="user-icon">
                <label for="user_icon_input">
                    <img src="<?php echo isset($user['user_icon']) ? 'uploads/'.$user['user_icon'] : 'img/default_icon.png'; ?>" id="user_icon_preview" class="rounded-icon">
                </label>
                <input type="file" id="user_icon_input" name="user_icon" accept="image/*" style="display: none;" onchange="previewUserIcon(event)">
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
                <input type="password" id="password" name="password">
            </div>
            <div id="left">
                <button onclick="history.back()">戻る</button>
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
</html>
