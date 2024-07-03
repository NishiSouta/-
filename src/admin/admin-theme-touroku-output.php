<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin-theme-touroku-output.css">
    <title>テーマ登録画面</title>
</head>
<body>
<?php
require 'db-connect.php';

$pdo = new PDO($connect, USER, PASS);

$name = htmlspecialchars($_POST['name']);

// ファイルのアップロード処理
$upload_directory = '../img/';  // 画像を保存するディレクトリのパス
$user_icon = $_FILES['img']['name'];
$user_icon_tmp = $_FILES['img']['tmp_name'];

// 拡張子を取り除いたファイル名を取得
$user_icon_name_without_extension = pathinfo($user_icon, PATHINFO_FILENAME);

// 新しいファイル名を生成（元のファイル名を使うが、必要に応じて重複を避ける処理を追加可能）
$new_file_name = $user_icon_name_without_extension . ".jpg";  // 必要に応じて拡張子を追加
$new_file_path = $upload_directory . $new_file_name;

// アップロードされたファイルを指定のディレクトリに移動する
if (move_uploaded_file($user_icon_tmp, $new_file_path)) {
    echo "";
} else {
    echo "ファイルのアップロードに失敗しました。";
}

try {
    // データベースに登録する処理
    $sql = 'INSERT INTO Theme (theme_name, theme_jpg) VALUES (:name, :img)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':img', $user_icon_name_without_extension); // 拡張子を取り除いたファイル名をバインド

    if ($stmt->execute()) {
        echo '<br><a href="admin-top.php">TOPへ戻る</a>';
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