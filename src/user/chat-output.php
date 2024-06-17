<section>
<?php require 'db-connect.php'; ?>
        <?php // DBからデータ(投稿内容)を取得 $stmt = select(); foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
                // 投稿内容を表示
               
                
            
 
            // 投稿内容を登録
            if(isset($_POST["send"])) {
                insert();
                // 投稿した内容を表示
                $stmt = select_new();
                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $message) {
                    echo $message['time'],":",$message['message'];
                    echo nl2br("\n");
                }
            }
 
            $stmt = new PDO($connect, USER, PASS);
            // DBから投稿内容を取得\\
            function select() {
                $dbh = connectDB();
                $sql = "SELECT * FROM Chat ORDER BY chat_postdate";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                return $stmt;
            }
 
            // DBから投稿内容を取得(最新の1件)
            function select_new() {
                $dbh = connectDB();
                $sql = "SELECT * FROM Chat ORDER BY chat_postdate desc limit 1";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                return $stmt;
            }
 
            // DBから投稿内容を登録
            function insert() {



                $sql = "INSERT INTO Chat (chat_content,chat_postdate) VALUES (:message, now())";
                $stmt = $dbh->prepare($sql);
                $params = array(':message'=>$_POST['message']);
                $stmt->execute($params);
            }
        ?>
    </section>