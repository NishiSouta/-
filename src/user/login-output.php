<?php
session_start();
 
// データベース接続設定
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1516804-budou';
const USER = 'LAA1516804';
const PASS = 'pass1109';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
 
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // SQL文の準備と実行
    $sql = $pdo->prepare("SELECT * FROM User WHERE user_mail = ? AND user_pw = ?");
    $sql->execute([$_POST['mail'], $_POST['password']]);
 
    // ユーザーデータの取得
    $user = $sql->fetch(PDO::FETCH_ASSOC);
 
    // ユーザーデータが見つかった場合、セッションに保存し、ユーザートップページにリダイレクト
    if ($user) {
        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'user_name' => $user['user_name'],
            'user_pw' => $user['user_pw'] // パスワードをセッションに保存することは推奨されません。
        ];
        header('Location: top.php');
        exit;
    } else {
        // ログイン失敗時の処理
        header('Location: login-input.php?error=1');
        exit;
    }
} catch (PDOException $e) {
    // エラー発生時の処理
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
?>