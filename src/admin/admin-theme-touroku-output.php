<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>テーマ登録結果画面</title>
</head>
<body>
<?php
require 'db-connect.php';

$pdo = new PDO($connect, USER, PASS);
$name = htmlspecialchars($_POST['name']);

$user_icon = $_FILES['img']['name'];
    $user_icon_tmp = $_FILES['img']['tmp_name'];
    $upload_directory = "";
$user_icon = pathinfo($user_icon, PATHINFO_FILENAME);



    // ファイルを指定のディレクトリに移動する
    move_uploaded_file("..//..img");

    $user_icon_path = $upload_directory . $user_icon;
    try {

    $sql = 'INSERT INTO Theme (theme_name, theme_jpg) VALUES (:name,:img)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':img', $user_icon_path);
    $stmt->execute();

    // クエリの実行
    if ($stmt->execute()) {
        echo "テーマが登録完了";
        echo '<a href="admin-top.php">TOPへ戻る</a>';
    } else {
        echo "エラー: テーマの登録に失敗しました。";
    }
} catch (PDOException $e) {
    die("エラー: " . $e->getMessage());
}

// ステートメントと接続を閉じる
unset($stmt);
unset($pdo);
?>
</body>
</html>
