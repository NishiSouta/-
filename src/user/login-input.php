<?php session_start();?>
<!-- データベース接続 -->
<?php
    const SERVER ='mysql304.phy.lolipop.lan';
    const DBNAME ='LAA1516804-budou';
    const USER ='LAA1516804';
    const PASS ='pass1109';
 
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <title>ログイン画面</title>
    <style>
        /* CSSで背景画像を設定 */
        body {
            background-image: url('./img/bg.png'); /* 画像のパスを正確に指定してください */
            background-size: cover; /* 背景画像を画面にフィットさせる */
            background-position: center; /* 画像を中央に配置 */
            background-repeat: no-repeat; /* 画像の繰り返しを無しに設定 */
            height: 100vh; /* ビューポートの高さにフィット */
            margin: 0; /* 余白をゼロに */
            position: relative; /* 子要素の絶対位置を制御するため */
        }
 
        /* 左上のアイコン画像のスタイル */
        #agb-icon {
            position: absolute;
            top: 10px; /* 上からの距離 */
            left: 10px; /* 左からの距離 */
            width: 90px; /* アイコン画像の幅 */
            height: auto; /* アスペクト比を保つために高さを自動調整 */
            /* 中央揃えにするためのCSS */
            #centerikon {
    text-align: center; /* テキストを中央揃えに設定 */
    width: 100%; /* 幅を100%に設定して、親要素の全幅を使用 */
    position: absolute; /* 絶対位置指定 */
    top: 20%; /* 上から20%の位置 */
    left: 0; /* 左から0の位置（左端から） */
    color: white; /* テキストの色を白に設定 */
}
 
.form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%; /* 上端からビューポートの50%の位置に */
    left: 50%; /* 左端からビューポートの50%の位置に */
    transform: translate(-50%, -50%); /* 位置調整で正確に中央に */
    width: 300px; /* フォームの幅を指定 */
    padding: 20px; /* パディングで内側の余白を設定 */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* 影をつけて立体感を出す */
    background-color: white; /* 背景色を白に */
}
 
/* フォーム内のテキスト入力フィールド、パスワードフィールド、送信ボタンを調整 */
input[type="text"], input[type="password"], input[type="submit"] {
    width: 100%; /* 幅を親要素に合わせる */
    padding: 10px; /* テキスト入力のパディング */
    margin-bottom: 10px; /* 要素間の余白 */
    border: 1px solid #ccc; /* ボーダー */
    border-radius: 4px; /* 入力フィールドの角を丸める */
}
 
/* 送信ボタンのスタイルを調整 */
input[type="submit"] {
    background-color: #007bff; /* ボタンの背景色 */
    color: white; /* テキストの色 */
    font-weight: bold; /* フォントの太さ */
    cursor: pointer; /* カーソルをポインターに */
    transition: background-color 0.3s; /* カラー変更のトランジション */
}
 
input[type="submit"]:hover {
    background-color: #0056b3; /* ホバー時の背景色 */
}
 
        }
       
    </style>
</head>
<body>
    <!-- 左上にアイコン画像を追加 -->
    <img id="agb-icon" src="./img/AGB.png" alt="AGB Icon">
    <div class="login">
        <h1>ログイン</h1>
        </div>
    <form action="login-output.php" method="post">
        <div class="form">
            <label class="mail">
                <input type="text" name="mail" placeholder="例）kokusi@kokusi.budou"><br>
                <a id="mailikon">
                    <!-- メールアイコンのSVG -->
                </a>
            </label>
            <label class="password">
                <input type="password" name="password" placeholder="PassWord">
                <a id="key">
                    <!-- キーのSVG -->
                </a>
            </label>
            <input type="submit" name="regist" value="Login">
        </div>
    </form>
</body>
</html>