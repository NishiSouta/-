<?php
session_start(); // セッションの開始
 
// データベース接続設定
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1516804-budou';
const USER = 'LAA1516804';
const PASS = 'pass1109';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
 
try {
<<<<<<< Updated upstream
 // PDOインスタンスの作成
$pdo = new PDO($connect, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // フォームが送信されたか確認
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     // POSTデータの取得
    $mail = $_POST['mail'];
    $password = $_POST['password'];
   
 
       
=======
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームが送信されたか確認
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // POSTデータの取得
        $mail = $_POST['mail'];
        $password = $_POST['password'];

>>>>>>> Stashed changes
        // SQL文の準備と実行
        $sql = $pdo->prepare("SELECT * FROM User WHERE user_mail = ?");
        $sql->execute([$mail]);
<<<<<<< Updated upstream
       
         // passwordハッシュ化判定
        foreach ($sql as $row) {
            //取れたデータを変換
            // var_dump(password_verify($_POST['password'],$row['user_pw']));
            // var_dump($row['user_pw']);
            // var_dump($_POST['password']);
            // $user = $sql->fetch(PDO::FETCH_ASSOC); // Fetch the first row
 
            if(password_verify($_POST['password'],$row['user_pw'])){
             
                $_SESSION['user']=[
 
                    'user_id'=>$row['user_id'], 'name'=>$row['user_name'],
           
                    'mail'=>$row['user_mail'], 'icon'=>$row['user_icon'],
           
                    'password'=>$row['user_pw']];
                header('Location: top.php');
                exit;
            } else {
                $error_message = 'メールアドレスまたはパスワードが正しくありません。';
                echo $error_message;
            }
=======

        // passwordハッシュ化判定
        $user = $sql->fetch(PDO::FETCH_ASSOC); // Fetch the first row
        if ($user && password_verify($password, $user['user_pw'])) {
            $_SESSION['user'] = [
                'user_id' => $user['user_id'],
                'name' => $user['user_name'],
                'mail' => $user['user_mail'],
                'icon' => $user['user_icon'],
                'password' => $user['user_pw']
            ];
            header('Location: top.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'メールアドレスまたはパスワードが正しくありません。';
            header('Location: login-input.php');
            exit;
>>>>>>> Stashed changes
        }
    }
<<<<<<< Updated upstream
 
 
=======
} catch (PDOException $e) {
    $_SESSION['error_message'] = 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    header('Location: login-input.php');
    exit;
}
>>>>>>> Stashed changes
?>