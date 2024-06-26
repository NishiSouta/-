<?php
session_start();
 
// データベース接続設定
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1516804-budou';
const USER = 'LAA1516804';
const PASS = 'pass1109';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
 
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // テーマ名の取得
        $theme_name = $_POST['theme_name'] ?? '';
        $default_icon = './img/themedelete.png';
 
        // ファイルのアップロード処理
        if (isset($_FILES['theme_icon']) && $_FILES['theme_icon']['error'] === UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES['theme_icon']['tmp_name'];
            $file_name = basename($_FILES['theme_icon']['name']);
            $upload_dir = './uploads/';
 
            // ユニークなファイル名を生成
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $unique_file_name = uniqid() . '.' . $file_extension;
            $file_dest_path = $upload_dir . $unique_file_name;
 
            // アップロードディレクトリが存在しない場合は作成
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
 
            // ファイルを目的の場所に移動
            if (move_uploaded_file($file_tmp_path, $file_dest_path)) {
                $icon_path = $file_dest_path;
            } else {
                $icon_path = $default_icon;
            }
        } else {
            // ファイルがアップロードされていない場合はデフォルトアイコンを使用
            $icon_path = $default_icon;
        }
 
        // テーマの登録
        $sql = $pdo->prepare("INSERT INTO Theme (name, icon) VALUES (?, ?)");
        $sql->execute([$theme_name, $icon_path]);
 
        // 成功メッセージとリダイレクト
        header('Location: theme_register_success.php');
        exit;
    }
} catch (PDOException $e) {
    // エラー発生時の処理
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/themeregister.css">
    <title>テーマ登録</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('./img/themedelete.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
 
        .container {
            background-color: rgba(255, 255, 255, 0.9); /* 白背景で半透明に */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px; /* コンテナの最大幅を設定 */
            width: 100%; /* コンテナの幅を親要素に合わせる */
        }
 
        .form-group {
            margin-bottom: 15px;
        }
 
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
 
        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
 
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
        }
 
        .btn:hover {
            background-color: #0056b3;
        }
 
        .error-message {
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>テーマ登録</h1>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <form action="theme_register.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="theme_name">テーマ名</label>
                <input type="text" id="theme_name" name="theme_name" required>
            </div>
            <div class="form-group">
                <label for="theme_icon">テーマアイコン</label>
                <input type="file" id="theme_icon" name="theme_icon" accept="image/*">
            </div>
            <button type="submit" class="btn">登録</button>
        </form>
    </div>
</body>
</html>