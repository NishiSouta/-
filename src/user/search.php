<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'db-connect.php'?>
    <?php require 'header.php'?>
    <main>
        <h3>検索キーワード：<?= $_POST['keyword'] ?></h3>
        <div class="img_flex-box">
            <?php
                if ( empty($_POST['keyword']) ) {
                        echo '<h3 class="nothing">検索キーワードを入力してください</h3>';
                    }else{
                        $pdo=new PDO($connect,USER,PASS);
                        $sql=$pdo->prepare('select * from Product where product_name like ? and product_id not in (select product_id from Puchase)');
                        $sql->execute(['%'.$_POST['keyword'].'%']);
                        if( empty($sql->fetchAll()) ){
                            echo '<h3 class="nothing">検索キーワードに該当する商品がありません</h3>';
                        }else{
                            $sql=$pdo->prepare('select * from Product where product_name like ? and product_id not in (select product_id from Puchase)');
                            $sql->execute(['%'.$_POST['keyword'].'%']);
                            foreach ($sql as $row){
                                echo '<a href="detail.php?id=',$row['product_id'],'"><div class="img_flex-item">',
                                        '<img src="../img/',$row['product_img'],'.jpg" alt="写真" width="180vw" height="240">',
                                        $row['product_name'],
                                    '</div></a>';
                            }
                        }
                    }
                ?>
            </div>
        </main>
</body>
</html>
<?php require 'footer.php'?>