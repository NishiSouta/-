<?php
include 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
session_start();
$error_message = "";

// 現在のユーザー情報を取得
try {
    $sql = 'SELECT user_name, user_mail FROM User WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $stmt->execute();

            header("Location: up_kanryou.php");
            exit();
        } catch (PDOException $e) {
            $error_message = 'Error: ' . $e->getMessage();
        }
    } else {
        $error_message = "全てのフィールドを入力してください。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="account.css">
    <title>アカウント情報更新</title>
</head>
<body>
    <div id="center">
        <h2>アカウント情報更新</h2>
        <?php if ($error_message): ?>
            <p style="color:red;"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>
        <form method="post" action="up_kanryou.php">
            <div>
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['user_name']) ?>">
            </div>
            <div>
                <label for="mail">メールアドレス</label>
                <input type="email" id="mail" name="mail" value="<?= htmlspecialchars($user['user_mail']) ?>">
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="submit">更新</button>
            </div>
        </form>
    </div>
</body>
</html>
