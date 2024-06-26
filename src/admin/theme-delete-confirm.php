<?php
session_start();
require 'db-connect.php';
 
// データベース接続設定
$dsn = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
 
try {
    // PDOインスタンスの作成
    $pdo = new PDO($dsn, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // POSTデータの取得
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme_id'])) {
        $theme_ids = $_POST['theme_id'];
        $theme_ids_placeholder = implode(',', array_fill(0, count($theme_ids), '?'));
       
        // テーマ情報の取得
        $sql = $pdo->prepare("SELECT * FROM Theme WHERE theme_id IN ($theme_ids_placeholder)");
        $sql->execute($theme_ids);
        $themes = $sql->fetchAll(PDO::FETCH_ASSOC);
 
        if (!$themes) {
            echo 'テーマが見つかりません。';
            exit;
        }
    } else {
        header('Location: theme-delete.php');
        exit;
    }
 
    // 削除確認処理
    if (isset($_POST['confirm_delete'])) {
        $pdo->beginTransaction();
        try {
            // テーマ削除のSQL文を準備して実行
            $delete_sql = $pdo->prepare("DELETE FROM Theme WHERE theme_id IN ($theme_ids_placeholder)");
            $delete_sql->execute($theme_ids);
 
            $pdo->commit();
            echo 'テーマが削除されました。';
            header('Location: theme-delete.php');
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
            exit;
        }
    }
} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
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
    <title>テーマ削除確認</title>
    <style>
        body {
            background-image: url('img/gamen.png');
            font-family: 'misakigothic';
            background-size: 100% 300%;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #464646;
            margin: 40px;
            color: #212529;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .theme-icon {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .theme-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-confirm {
            background-color: #dc3545;
            color: #fff;
            margin-right: 10px;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>テーマ削除確認</h1>
        <?php if ($themes): ?>
            <?php foreach ($themes as $theme): ?>
                <img src="img/<?php echo htmlspecialchars($theme['theme_jpg'], ENT_QUOTES, 'UTF-8'); ?>" alt="テーマアイコン" class="theme-icon">
                <div class="theme-name"><?php echo htmlspecialchars($theme['theme_name'], ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endforeach; ?>
            <p>これらのテーマを削除しますか？</p>
            <form method="post">
                <?php foreach ($theme_ids as $theme_id): ?>
                    <input type="hidden" name="theme_id[]" value="<?php echo htmlspecialchars($theme_id, ENT_QUOTES, 'UTF-8'); ?>">
                <?php endforeach; ?>
                <button type="submit" name="confirm_delete" class="btn btn-confirm">削除</button>
                <a href="theme-delete.php" class="btn btn-cancel">キャンセル</a>
            </form>
        <?php else: ?>
            <p>テーマ情報が見つかりません。</p>
        <?php endif; ?>
    </div>
</body>
</html>