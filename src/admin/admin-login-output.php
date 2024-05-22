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
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="css/reset.css" />
    <title>管理者ログイン画面</title>
</head>
<body>
<p><img class="rogo" src="img/AGB.png" alt="写真" width="129" height="110"></p>
    <div id="center"></div> 
    <?php
    unset($_SESSION['customer']);
  $pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from Adimn where admin_name=? and admin_pw=?');
$sql->execute([$_REQUEST['login'],$_REQUEST['password']]);

   // if(password_verify($_POST['password'],$row['user_pw'])==true){ }//ハッシュ化
foreach($sql as $row){
       $_SESSION['customer']=[
            'admin_id'=>$row['admin_id'],'admin_name'=>$row['admin_name'],
           'admin_pw'=>$row['admin_pw']
            //,'login'=>$row['login'],'password'=>$row['password']
        ];
    
}
 /*

// 変数の初期化
$email = '';
$password = '';
$err_msg = array();

// POST送信があるかないか判定
if (!empty($_POST)) {
    // 各データを変数に格納
    $email = $_POST['login'];
    $password = $_POST['password'];
}
    // eメールアドレスバリデーションチェック
    // 空白チェック
    if ($email === '') {
      $err_msg['user_mail'] = '入力必須です';
    }

if (!empty($_POST)) { // パスワードバリデーションチェック
    // 空白チェック
    if ($password === '') {
      $err_msg['user_pw'] = '入力してください';
    }
  }*/
  
        if(isset($_SESSION['customer'])){
          //ログイン成功表示
          echo '<div id="center"><h1>';
          echo 'いらっしゃいませ',$_SESSION['customer']['admin_name'],'さん','<br>';
          echo '<a href="admin-top.php">ホームへ</a>'; //ホームのリンクが違うなら変える
          echo '</h1></div>';
          exit;
        }else{
          echo '<div id="center"><h1>';
          echo $err_msg['admin_name'] = '管理者名またはパスワードが違います','<br>';
          echo '<a href="admin-login-input.php">管理者ログイン画面へ戻る</a>';
          echo '</h1></div>';
        }
    

?>
    
</body>
</html>