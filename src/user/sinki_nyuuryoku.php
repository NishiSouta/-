<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sinki_nyuuryoku.css">
    <title>新規登録入力画面</title>
</head>
<body>
    <div id="center">
        <h2>新規登録</h2>
    </div>
    <form action="sinki_kakunin.php" method="post">
        <div id="center">
            <h2>名前<input type="text" name="name" required></h2>
        </div>
        <div id="center">
            <h2>メールアドレス<input type="email" name="mail" required></h2>
        </div>
        <div id="center">
            <h2>パスワード<input type="password" name="password" required></h2>
        </div>
        <p>好きなテーマを1つえらんでください</p>
        <div id="center">
        <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>