<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/reset.css" />
    <title>管理者ログイン画面</title> 
</head>
<body>
        <p><img class="rogo" src="img/AGB.png" alt="写真" width="129" height="90"></p>
    <div id="center"><p><h2>管理者ログイン</h2></p></div>

<form action ="admin-login-output.php" method="post">
        <div id="center"><p><h2>ユーザ名<input type="text" name="login"></h2></p></div>

 
        <div id="center"><p><h2>パスワード<input type="password" name="password"></h2></p></div>
   
    <div id="center"><button type="submit" class="rogu" name="name" value="value">ログイン</button></div><!-- 中央よせ・枠組み（グレー）  -->

</form>
<br>
</body>
</html>