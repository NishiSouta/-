<?php
session_start();
require 'db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $user_id = isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : '';
    $theme_id = isset($_GET['theme_id']) ? intval($_GET['theme_id']) : '';

    if ($title && $content && $user_id && $theme_id) {
        try {
            $pdo = new PDO($connect, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO Board (board_name, board_content, user_id, theme_id) VALUES (:title, :content, :user_id, :theme_id)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
            $stmt->execute();
            header('Location: detail.php?theme_id=' . $theme_id);
            exit;
        } catch (PDOException $e) {
            echo 'エラー: ' . $e->getMessage();
        }
    } else {
        echo '必要なデータが不足しています。';
    }
}
?>
