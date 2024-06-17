<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post" name="form">
    名前<input type="text" name="n">
    メッセージ<textarea name="m"></textarea>
    <input type="submit" value="送信" name="submit">
    </form>

<?php
            //  const SERVER ='mysql304.phy.lolipop.lan';
            //  const DBNAME ='LAA1516804-budou';
            //  const USER ='LAA1516804';
            //  const PASS ='pass1109';
         
            // $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

        if(isset($_POST['n'])) {

        // $dsn= 'mysql304.phy.lolipop.lan';
        // $dbname= 'LAA1516804-budou';
        // $user='LAA1516804';
        // $pass='pass1109'; 
        // $my_nam=htmlspecialchars($_POST["n"], ENT_QUOTES);
        $my_mes=htmlspecialchars($_POST["m"], ENT_QUOTES);

        try{

        $db = new PDO($connect, USER, PASS);
        $db->query("INSERT INTO `Chat` (chat_id,chat_content,chat_postdate,user_id)VALUES (1,'$my_mes',NOW()),1");
        }catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
        }

        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
        }
        ?>
        <?php

        // const SERVER ='mysql304.phy.lolipop.lan';
        // const DBNAME ='LAA1516804-budou';
        // const USER ='LAA1516804';
        // const PASS ='pass1109';

        // $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
        $db = new PDO($connect, USER, PASS);
        $ps = $db->query("SELECT * FROM `Chat`  ORDER BY chat_id DESC ");


        define("SECMINUITE", 60); //1分（秒）
        define("SECHOUR", 60 * 60); //1時間（秒）
        define("SECDAY", 60 * 60 * 24); //1日（秒）
        define("SECWEEK", 60 * 60 * 24 * 7); //1週（秒）
        define("SECMONTH", 60 * 60 * 24 * 30); //1月（秒）
        define("SECYEAR", 60 * 60 * 24 * 365); //1年（秒）

        function niceTime($dest,$sour) { 
        $sour = (func_num_args() == 1) ? time() : func_get_arg(1);

        $tt = $dest - $sour;


        if ($tt / SECYEAR < -1) return abs(round($tt / SECYEAR)) . '年前';
        if ($tt / SECMONTH < -1) return abs(round($tt / SECMONTH)) . 'ヶ月前';
        if ($tt / SECWEEK < -1) return abs(round($tt / SECWEEK)) . '週間前';
        if ($tt / SECDAY < -1) return abs(round($tt / SECDAY)) . '日前';
        if ($tt / SECHOUR < -1) return abs(round($tt / SECHOUR)) . '時間前';
        if ($tt / SECMINUITE < -1) return abs(round($tt / SECMINUITE)) . '分前';
        if ($tt < 0) return abs(round($tt)) . '秒前';
        if ($tt / SECYEAR > +1) return abs(round($tt / SECYEAR)) . '年後';
        if ($tt / SECMONTH > +1) return abs(round($tt / SECMONTH)) . 'ヶ月後';
        if ($tt / SECWEEK > +1) return abs(round($tt / SECWEEK)) . '週間後';
        if ($tt / SECDAY > +1) return abs(round($tt / SECDAY)) . '日後';
        if ($tt / SECHOUR > +1) return abs(round($tt / SECHOUR)) . '時間後';
        if ($tt / SECMINUITE > +1) return abs(round($tt / SECMINUITE)) . '分後';
        if ($tt > 0) return abs(round($tt)) . '秒後';
        return '現在';
        }

        try{
        while($r = $ps->fetch()){ 
        $beforedest = $r['chat_postdate'];
        $dest = strtotime($beforedest);
        $sour = time(); //現在の時刻を$sourに代入
        $outstr = nicetime($dest,$sour);
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target="_blank">$1</a>';
        $r['chat_content']=preg_replace( $pattern, $replace, $r['chat_content'] );
        ?>


        <div>
        <?php
        print "{$r['chat_id']}";
        ?>
        <br>
        <?php
        // print "{$r['user_name']}";
        ?>

        <?php
        echo $outstr;
        ?>

        <?php 
        print nl2br($r['chat_content']);
        ?>


        <a href="delete.php?chat_id=<?php print "{$r['chat_id']}";?>">削除</a>

        </div>
        <hr>
        <?php }

        }catch(Exception $e){
        echo $e->getMessage() . PHP_EOL;//エラーが出たときの処理
        } 
        ?>
                    
        </body>
        </html>