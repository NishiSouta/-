<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <title>ユーザープロファイル</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php require 'db-connect.php'; ?>
    <?php require 'header.php'; ?>
    <div class="container">
        <main>
            <div class="profile">
                <div class="avatar">
                    <img src="path/to/avatar.png" alt="ユーザーアバター">
                </div>
                <h2>name</h2>
                <div class="actions">
                    <button onclick="updateAccount()">アカウント更新</button>
                    <button onclick="deleteAccount()">アカウント削除</button>
                    <button onclick="addFavorite()">お気に入り登録</button>
                    <button onclick="removeFavorite()">お気に入り削除</button>
                </div>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
