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
 
    // セッション変数の確認
    if (!isset($_SESSION['user']['user_id'])) {
        echo 'ログインされていないか、セッションが切れています。';
        exit;
    }
 
    // POST変数の確認
    if (!isset($_POST['password'])) {
        echo 'パスワードが入力されていません。';
        exit;
    }
 
    // SQL文の準備と実行
    $sql = $pdo->prepare("SELECT * FROM User WHERE user_id = ? AND user_pw = ?");
    $sql->execute([$_SESSION['user']['user_id'], $_POST['password']]);
 
    // ユーザーデータの取得
    $user = $sql->fetch(PDO::FETCH_ASSOC);
 
    // ユーザーデータが見つかった場合、アカウントを削除
    if ($user) {
        // アカウント削除のSQL文を準備して実行
        $delete_sql = $pdo->prepare("DELETE FROM User WHERE user_id = ?");
        $delete_sql->execute([$_SESSION['user']['user_id']]);
       
        // セッションを破棄してログアウト状態にする
        session_destroy();
       
        // 削除が成功した場合はトップページにリダイレクト
        header('Location: top.php');
        exit;
    } else {
        // パスワードが間違っている場合は削除しない
        header('Location: account-delete.php?error=1');
        exit;
    }
} catch (PDOException $e) {
    // エラー発生時の処理
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
?>