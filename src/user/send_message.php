<?php session_start(); ?>
<?php require 'db-connect.php'?>
<?php
    if(empty($_POST['drone'])){
        $pdo = new PDO($connect,USER,PASS);

        $message = $_POST['message'];
    
        $message = $message;
    
        $sql = $pdo->prepare("INSERT INTO Chat(chat_postdate, chat_content, user_id, board_id) VALUES (NOW(),?,?,?)");
        $sql->execute([$message, $_SESSION['user']['user_id'], $_GET['board_id']]);
    
        // チャットページにリダイレクト
        header("Location: chat.php?board_id=".$_GET['board_id']);
        exit;
    }else{
        $pdo = new PDO($connect,USER,PASS);

        $message = $_POST['message'];
        $drone = $_POST['drone'];
    
        $message = $drone . $message;
    
        $sql = $pdo->prepare("INSERT INTO Chat(chat_postdate, chat_content, user_id, board_id) VALUES (NOW(),?,?,?)");
        $sql->execute([$message, $_SESSION['user']['user_id'], $_GET['board_id']]);
    
        // チャットページにリダイレクト
        header("Location: chat.php?board_id=".$_GET['board_id']);
        exit;
    }
?>