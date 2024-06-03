<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テーマ登録画面</title>
</head>
<body>
<form action="admin-theme-touroku-output.php" method="post" enctype="multipart/form-data">
        
        <input type="file" id="img" name="img" accept="img/*" required><br><br>
        <label for="name">テーマ名:</label>
        <textarea id="name" name="name" required></textarea><br><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>