<?php
if ( isset($_POST['cancel']) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; // Құпиясөз: php123

$failure = false;

if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "Имя пользователя и пароль обязательны";
    } else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            // Сәтті кірген соң game.php бетіне бағыттау
            header("Location: game.php?name=".urlencode($_POST['who']));
            return;
        } else {
            $failure = "Неверный пароль";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Олжас Нұран - Страница входа 2bdf63f3</title>
</head>
<body style="font-family: sans-serif;">
    <h1>Пожалуйста, войдите в систему</h1>
    <?php
    if ( $failure !== false ) {
        echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
    }
    ?>
    <form method="POST">
        <label for="nam">Имя пользователя (User Name):</label>
        <input type="text" name="who" id="nam"><br/><br/>
        <label for="id_1723">Пароль (Password):</label>
        <input type="password" name="pass" id="id_1723"><br/><br/>
        <input type="submit" value="Log In">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    <p>
        Подсказка: пароль для проверки — <b>php123</b>
    </p>
</body>
</html>