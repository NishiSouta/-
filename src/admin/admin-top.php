<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/reset.css" />
    <title>管理者トップ画面</title> 
</head>
<body>
    <div class="container">
        <p><img class="rogo" src="img/AGB.png" alt="ロゴ" width="500" height="280"></p>
        <div class="header">
            <button class="logout"><a href="admin-login-input.php" class="btn">ログアウト</a></button>
        </div>
        <div class="buttons">
            <button class="btn"><a href="account-itiran.php" class="btn">アカウント</a></button>
            <button class="btn"><a href="comment-itiran.php" class="btn">コメント</a></button>
        </div>
        <div id="theme">
            <h3>テーマ</h3>
        </div>
        <div class="buttons">
            <button class="btn"><a href="theme-touroku.php" class="btn">登録</a></button>
            <button class="btn"><a href="theme-delete.php" class="btn">削除</a></button>
        </div>
    </div>
</body>
</html>