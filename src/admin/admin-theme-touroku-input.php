<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-theme-touroku-input.css">
    <title>テーマ登録画面</title>
</head>
<body>
   <form action="admin-theme-touroku-output.php" method="post" enctype="multipart/form-data">
        <div id="file-button">
            <input type="file" id="img" name="img" accept="image/jpeg" onchange="previewUserIcon(event)" required>
        </div>
        <br><br>









        <div id="theme-button">
            <label for="name">テーマ名:</label>
            <textarea id="name" name="name" required></textarea>
        </div>
        <br><br>
        <div style="display:inline-flex">
            <input type="submit" class="nes-btn2" id="insert" value="登録">
        </div>
    </form>
    <form action="admin-top.php" method="POST">
        <input type="submit" class="nes-btn2" id="insert" value="戻る">
        <br>
    </form>
</body>
</html>
