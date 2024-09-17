<?php

require_once "App/MyPDO.php";

use App\MyPDO;

$pdo = new MyPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $long_url = $_POST['long_url'];
    $short_code = substr(md5(uniqid()), 0, 6);

    $stmt = $pdo->prepare('INSERT INTO urls (short_code, long_url) VALUES (?, ?)');
    $stmt->execute([$short_code, $long_url]);

    $short_url = $_SERVER['HTTP_HOST'] . '/' . $short_code;
    echo "Короткая ссылка: <a href='http://$short_url'>$short_url</a>";
    exit;
}

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $stmt = $pdo->prepare('SELECT long_url FROM urls WHERE short_code = ?');
    $stmt->execute([$code]);
    $url = $stmt->fetchColumn();

    if ($url) {
        header("Location: $url");
    } else {
        echo 'Ссылка не найдена.';
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Сократитель ссылок</title>
</head>
<body>
<h1>Сократите вашу ссылку</h1>
<form method="post">
    <input type="url" name="long_url" placeholder="Введите длинную ссылку" required>
    <button type="submit">Сократить</button>
</form>
</body>
</html>
