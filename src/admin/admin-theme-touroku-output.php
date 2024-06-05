<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テーマ登録結果画面</title>
</head>
<body>
<?php
require 'db-connect.php';

$conn = new PDO($connect, USER, PASS);

$name = $_POST['name'];
$description = $_FILES['img']['name'];  // $_POST['img']ではなく$_FILES['img']['name']を使用

// 画像アップロード処理
//$target_dir = "img/";
$target_file = /*$target_dir .*/ basename($_FILES["img"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// 画像ファイルのバリデーション
$check = getimagesize($_FILES["img"]["tmp_name"]);
if ($check === false) {
    die("ファイルは画像ではありません。");
}

// ファイルサイズの制限 (例: 5MB以下)
if ($_FILES["img"]["size"] > 5000000) {
    die("画像ファイルが大きすぎます。");
}

// 画像ファイル形式の制限
$allowed_types = ["jpg", "jpeg", "png", "gif"];
if (!in_array($imageFileType, $allowed_types)) {
    die("許可されていないファイル形式です。");
}

// アップロードディレクトリの存在確認と作成
/*if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}*/

// 画像ファイルのアップロード
if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
    die("画像のアップロード中にエラーが発生しました。");
}

try {
    // テーマを追加するためのSQLクエリ
    $sql = "INSERT INTO Theme (theme_name, theme_jpg) VALUES (:name, :img)";
    $stmt = $conn->prepare($sql);

    // パラメータのバインド
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':img', $target_file);

    // クエリの実行
    if ($stmt->execute()) {
        echo "テーマが登録されました。";
    } else {
        echo "エラー: テーマの登録に失敗しました。";
    }
} catch (PDOException $e) {
    die("エラー: " . $e->getMessage());
}

// ステートメントと接続を閉じる
unset($stmt);
unset($conn);
?>
</body>
</html>
