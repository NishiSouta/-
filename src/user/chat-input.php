<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>チャット</title>
</head>
 
<body>
     
 
 
<h1>チャット</h1>
 
 
 
 
     
 
 
<form method="post" action="chat-output.php">
       
        メッセージ　<input type="text" name="message">
 
        <button name="send" type="submit">送信</button>
 
        チャット履歴
    </form>
 
 
 
</body>
</html>