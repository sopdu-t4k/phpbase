<?php
session_start();
/*
$login = 'admin';
$password = password_hash('123456', PASSWORD_DEFAULT);
$sql = "INSERT INTO users (`login`, `pass`) VALUES ('{$login}', '{$password}');";
executeQuery($sql);
*/

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("hash");
    header("Location: /admin/");
}

if (isset($_POST['enter'])) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (!auth($login, $pass)) {
        Die('Не верный логин или пароль');
    } else {
        if (isset($_POST['remember'])) {
            $hash = uniqid(rand(), true);
            $db = getDb();
            $id = mysqli_real_escape_string($db, strip_tags(stripslashes($_SESSION['id'])));
            $sql = "UPDATE users SET `hash` = '{$hash}' WHERE `id` = {$id}";
            $result = mysqli_query($db, $sql);
            setcookie("hash", $hash, time() + 3600);
        }
    }
}

function auth($login, $pass) {
    $db = getDb();
    $login = mysqli_real_escape_string($db, strip_tags(stripslashes($login)));
    $result = mysqli_query($db, "SELECT * FROM users WHERE login = '{$login}'");
    $row = mysqli_fetch_assoc($result);

    if (password_verify($pass, $row['pass'])) {
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $row['id'];
        return true;
    }
    return false;
}

function isAuth() {
    if (isset($_COOKIE["hash"])) {
        $hash = $_COOKIE["hash"];
        $db = getDb();
        $sql = "SELECT * FROM users WHERE `hash` = '{$hash}'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $user = $row['login'];
        if (!empty($user)) {
            $_SESSION['login'] = $user;
        }
    }
    return isset($_SESSION['login']) ? true : false;
}

function getUser() {
    return isAuth() ? $_SESSION['login'] : false;
}
