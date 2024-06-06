<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>テーマ登録画面</title>
</head>
<body>
    <form action="admin-theme-touroku-output.php" method="post" enctype="multipart/form-data">
    <div id="file-button"><input type="file" id="img" name="img" accept="image/*" required></div><br><br>
    <div id="theme-button"> <label for="name">テーマ名:</label>
        <textarea id="name" name="name" required></textarea></div><br><br>
        <div id="touroku-button"><input type="submit" value="登録"></div>
        <div id="modoru-button"> <a href="admin-top.php">戻る</a></div>
    </form>
</body>
</html>
