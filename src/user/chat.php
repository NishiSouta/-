<?php session_start(); ?>
<?php require 'db-connect.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://unpkg.com/nes.css/css/nes.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/chat.css">
    <title>チャット</title>
</head>
<body>
    <?php require 'header.php'?>
    <main>
        <div class="chat_getarea">
            <div id="chatbox">
                <!-- ここにチャットメッセージが表示される -->
                    <?php
                        $pdo=new PDO($connect,USER,PASS);
                        $sql = $pdo->prepare("SELECT * FROM User INNER JOIN Chat ON User.user_id = Chat.user_id WHERE board_id = ? ORDER BY chat_postdate ASC");
                        $sql->execute([$_GET['board_id']]);
                        foreach($sql as $row){
                            if( $_SESSION['user']['user_id'] == $row['user_id'] ){
                                echo 
                                    '<div class="chat_right">',
                                    '<div class="nes-balloon from-right is-dark">',
                                    '<p>',$row['chat_content'],'</p>',
                                    '</div>',
                                    '<div class="user_icon">',
                                    '<a href="my-profile.php"><img src="img/',$row['user_icon'],'" class="img_icon" alt="アイコン"></a>',
                                    $row['user_name'],
                                    '</div></div>';
                            }else{
                                echo
                                    '<div class="chat_left">',
                                    '<div class="user_icon">',
                                    '<a href="my-profile-user.php?user_id=',$row['user_id'],'&board_id=',$_GET['board_id'],'"><img src="img/',$row['user_icon'],'" class="img_icon" alt="アイコン"></a>',
                                    $row['user_name'],
                                    '</div>',
                                    '<div class="nes-balloon from-left is-dark">',
                                    '<p>',$row['chat_content'],'</p>',
                                    '</div></div>';
                            }
                        }
                    ?>
            </div>
        </div>
        <div class="chat_sendarea">
            <?php
            echo '<form id="messageForm" action="send_message.php?board_id=', $_GET['board_id'],'" method="post">';
            ?>
            <h3>メッセージ送信</h3>
            <div class="radio">
                <p><input type="radio" id="s" name="drone" value="#初心者　"/>初心者</p>
                <p><input type="radio" id="t" name="drone" value="#中級者　"/>中級者</p>
                <p><input type="radio" id="j" name="drone" value="#上級者　"/>上級者</p>
            </div>
            <h3>メッセージ</h3>
                <div style="background-color:#212529; padding: 1rem;" class="nes-field is-inline">
                    <input type="text" name="message" id="dark_field" class="nes-input is-dark" placeholder="メッセージを入力" required>
                </div>
                <button type="submit" class="chat_btt">送信</button>
            </form>
        </div>
    </main>
    
    <script>
        let target = document.getElementById('chatbox');
        target.scrollIntoView(false);
        // チャットメッセージを自動更新する関数
        /*function updateChat() {
            fetch('get_messages.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('chatbox').innerHTML = data;
                });
        }

        // 5秒ごとにチャットを更新
        setInterval(updateChat, 5000);
          setTimeout(function () {
    location.reload();
}, 2000);
        */
    </script>
</body>
</html>