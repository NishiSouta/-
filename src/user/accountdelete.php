
<?php

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

    // フォームが送信されたか確認
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // POSTデータの取得
        $mail = $_POST['mail'] ?? '';
        $password = $_POST['password'] ?? '';

        // SQL文の準備と実行
        $sql = $pdo->prepare("SELECT * FROM User WHERE user_mail = ? AND user_pw = ?");
        $sql->execute([$mail, $password]);

        // ユーザーデータの取得
        $user = $sql->fetch(PDO::FETCH_ASSOC);


        
        // ユーザーデータが見つかった場合、セッションに保存し、ユーザートップページにリダイレクト
        if ($user) {
            $_SESSION['user'] = [
                'user_id' => $user['user_id'],
                'user_name' => $user['user_name']
                // パスワードをセッションに保存することは推奨されません。
            ];
            header('Location: top.php');
            exit;
        } else {
            // ログイン失敗時の処理
            $error_message = 'メールアドレスまたはパスワードが正しくありません。';
        }
    }
} catch (PDOException $e) {
    // エラー発生時の処理
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント削除画面</title>
    <style>
        body {
            background-image: url('img/accountdelete.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center; /* 水平方向の中央揃え */
            align-items: center; /* 垂直方向の中央揃え */
            position: relative;
        }
 
        #teamrogo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 70px;
            height: auto;
        }
 
        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
 
        #centerikon {
            color: black;
        }
 
        .form p {
            margin-bottom: 20px;
        }
 
        .form input[type="text"],
        .form input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
 
        .form input[type="submit"] {
            width: 50%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #ff0000;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
 
        .form input[type="submit"]:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <img id="teamrogo" src="img/AGB.png" alt="Team Logo">
    <div class="form-container">
        <p id="centerikon">削除画面</p>
        <form action="account-delete-process.php" method="post">
            <div class="form">
                <p>アカウントを削除してもよろしいですか？この操作は取り消せません。</p>
                <label class="mail">
                    <input type="text" name="mail" placeholder="メールアドレスを入力">
                </label>
                <label class="password">
                    <input type="password" name="password" placeholder="パスワード">
                </label>
                <input type="submit" name="delete" value="アカウント削除">
            </div>
        </form>
    </div>
</body>
</html>