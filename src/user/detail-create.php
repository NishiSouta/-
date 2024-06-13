<?php
session_start();
require 'db-connect.php';

// フォームから送信されたデータを取得
$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);
$user_id = $_SESSION['user_id'];
$theme_id = $_GET['theme_id'];

// データベースに掲示板を挿入
try {
    $pdo = new PDO($connect, USER, PASS);
    $sql = 'INSERT INTO Board (board_name, board_content, theme_id, user_id) VALUES (:title, :content, :theme_id, :user_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: boards.php?theme_id=' . $theme_id);
    exit();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>