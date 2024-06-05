<?php
// セッションを開始する
session_start();

require 'db-connect.php'; // データベース接続をインクルード

// セッションからユーザーIDを取得
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("ユーザーIDが設定されていません。");
}

// データベースからユーザー情報を取得
$sql = "SELECT user_icon, user_name FROM User WHERE user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("SQLステートメントの準備に失敗しました: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $avatar_url = $user['user_icon'];
    $name = $user['user_name'];
} else {
    // ユーザーが見つからない場合のフォールバック値
    $avatar_url = 'img/sumabura.png';
    $name = '不明なユーザー';
}
$stmt->close();
$conn->close();
?>
<?php require 'header.php'; ?>

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
    <div class="container">
        <main>
            <div class="profile">
                <div class="avatar">
                    <img src="<?php echo htmlspecialchars($avatar_url); ?>" alt="ユーザーアバター">
                </div>
                <h2><?php echo htmlspecialchars($name); ?></h2>
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
