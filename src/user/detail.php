<?php
session_start();
if (!isset($_SESSION['user']['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db-connect.php';

$theme_id = isset($_GET['theme_id']) ? intval($_GET['theme_id']) : 1; // デフォルトのテーマIDを設定

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT board_name, board_content FROM Board WHERE theme_id = :theme_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
    $stmt->execute();
    $boards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
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
    <link rel="stylesheet" href="css/detail.css">
    <title>掲示板一覧</title>
</head>
<body>
<?php require 'header.php'; ?>
<div class="container">
    <main>
        <div class="board-list">
            <?php foreach ($boards as $board): ?>
                <div class="board-item nes-container is-rounded">
                    <h2 class="board-title"><?= htmlspecialchars($board['board_name'] ?? '') ?></h2>
                    <p class="board-content"><?= nl2br(htmlspecialchars($board['board_content'] ?? '')) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php require 'detail-create.php'; ?>
</div>
<script src="script.js"></script>
</body>
</html>
