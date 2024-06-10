<?php session_start();?>
<?php require 'db-connect.php'; ?>
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
<?php require 'header.php'; ?>
    <div class="container">
        <main>
            <div class="profile">
                <?php
        $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from User where user_id = ? ');
            $sql->execute([47]);
            foreach($sql as $row){
                echo '<img alt="image" src="img/', $row['user_icon'], '.jpg" class="avatar">';
                echo '<br><br><span class="name">',$row['user_name'],'</span>';
            }
            ?>
                <div class="actions">
                    <button onclick="updateAccount()">アカウント更新</button>
                    <button onclick="deleteAccount()">アカウント削除</button>
                    <button onclick="insertFavorite()">お気に入り登録</button>
                    <button onclick="deleteFavorite()">お気に入り削除</button>
                </div>
                <script>
    function updateAccount() {
        // アカウント更新ページへの遷移
        window.location.href = 'up_account.php';
    }
 
    function deleteAccount() {
        // アカウント削除ページへの遷移
        window.location.href = 'accountdelete.php';
    }
 
    function insertFavorite() {
        // お気に入り登録ページへの遷移
        window.location.href = 'favorite-insert-inport.php';
    }
 
    function deleteFavorite() {
        // お気に入り削除ページへの遷移
        window.location.href = 'favorite-delete-inport.php';
    }
</script>
            </div>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>