<?php
    const SERVER ='mysql304.phy.lolipop.lan';
    const DBNAME ='LAA1516804-budou';
    const USER ='LAA1516804';
    const PASS ='pass1109';

    $conn = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch themes from the database
$sql = "SELECT * FROM Theme"; // Adjust the table name and fields as necessary
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板テーマ登録画面</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="themes">
            
            <?php

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="theme-item">';
                    echo '<img src="' . $row["theme_jpg"] . '" alt="テーマ画像">';
                    echo '<p>' . $row["theme_name"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
            <div class="next-button">
                <button class="btn">></button>
            </div>
        </div>
        <div class="navigation-buttons">
            <button class="btn" onclick="admin-top.php">戻る</button>
            <button class="btn"><a href="theme-touroku-input.php"class="btn">登録</a></button>
        </div>
    </div>
</body>
</html>
