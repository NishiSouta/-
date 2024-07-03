<?php session_start(); ?>
<?php require 'db-connect.php'?>
<?php
    $pdo = new PDO($connect,USER,PASS);

    $message = $_POST['message'];

    $sql = $pdo->prepare("INSERT INTO Chat(chat_postdate, chat_content, user_id, board_id) VALUES (NOW(),?,?,?)");
    $sql->execute([$message, $_SESSION['user']['user_id'], $_GET['board_id']]);

    // チャットページにリダイレクト
    header("Location: chat.php?board_id=".$_GET['board_id']);
    exit;
?>