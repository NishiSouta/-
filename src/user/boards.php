<?php
session_start();
require 'db-connect.php';

// ユーザーIDをセッションから取得
$user_id = $_SESSION['user_id'];
$theme_id = $_POST['theme_id'];

// データベースから掲示板の情報を取得
try {
    $pdo = new PDO($connect, USER, PASS);
    $sql = 'SELECT board_name, board_content FROM Board WHERE theme_id = :theme_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
    $stmt->execute();
    $boards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
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
    <title>掲示板一覧</title>
    <link rel="stylesheet" href="css/boards.css">
</head>
<body>
<?php require 'header.php'; ?>
<div class="container">
    <main>
        <div class="board-list">
            <?php foreach ($boards as $board): ?>
                <div class="board-item nes-container is-rounded">
                    <h2 class="board-title"><?= htmlspecialchars($board['board_name']) ?></h2>
                    <p class="board-content"><?= nl2br(htmlspecialchars($board['board_content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <aside>
        <div class="board-form nes-container is-rounded">
            <h2>掲示板作成</h2>
            <form method="post" action="create_board.php?theme_id=<?= $theme_id ?>">
                <div class="nes-field">
                    <label for="title">募集タイトル</label>
                    <input type="text" id="title" name="title" class="nes-input" required>
                </div>
                <div class="nes-field">
                    <label for="content">募集内容</label>
                    <textarea id="content" name="content" class="nes-textarea" required></textarea>
                </div>
                <button type="submit" class="nes-btn is-primary">作成</button>
            </form>
        </div>
    </aside>
</div>
<script src="script.js"></script>
</body>
</html>