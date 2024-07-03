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

// アップロードされたファイルを指定のディレクトリに移動する
if (move_uploaded_file($user_icon_tmp, $upload_directory . $user_icon)) {
    echo "";
} else {
    echo "ファイルのアップロードに失敗しました。";
}

$user_icon_path = $upload_directory . $user_icon;

try {
    // データベースに登録する処理
    $sql = 'INSERT INTO Theme (theme_name, theme_jpg) VALUES (:name, :img)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':img', $user_icon_name_without_extension); // 拡張子を取り除いたファイル名をバインド

    if ($stmt->execute()) {
        echo "テーマが登録完了しました。";
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