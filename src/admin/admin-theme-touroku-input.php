<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/admin-theme-touroku-input.css">
    <title>テーマ登録画面</title>
</head>
<body>
    <!-- テーマ登録フォーム -->
    <form action="admin-theme-touroku-output.php" method="post" enctype="multipart/form-data">
        <div id="file-button">
            <!-- ユーザープロフィール画像の選択フォーム -->
            <div class="user-icon">
                <label for="img">
                    <img src="img/default_icon.png" id="img_preview" class="rounded-icon">
                </label>
                <input type="file" id="img" name="img" accept="image/jpeg" onchange="previewUserIcon(event)" required>
            </div>
        </div>
        <br><br>
        <div id="theme-button">
            <div id="theme-container">
                <label for="name">テーマ名:</label>
                <input type="text" id="name" name="name" class="nes-input" required>
            </div>
        </div>
        <br><br>
        <div id="touroku-button">
            <button type="submit" class="nes-btn">登録</button>
        </div>
    </form>
    
    <!-- 戻るボタンフォーム -->
    <form action="admin-top.php" method="POST">
        <div id="modoru-button">
            <button type="submit" class="nes-btn">戻る</button>
        </div>
    </form>
    
    <script>
        function previewUserIcon(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('img_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
