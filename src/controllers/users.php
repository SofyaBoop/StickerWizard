<?php
include("./database/db_func.php");
error_reporting(0);

$errMsg_sign = '';
$errMsg_login = '';

$users = selectAll('users');

function userAuth($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['admin'] = $user['admin'];
    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . "/admin/users/index.php");
    } else {
        header('location: ' . BASE_URL);
    }
}


//Код для регистрации пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup_btn'])) {
    $sign_name = trim($_POST['input_sign__name']);
    $sign_email = trim($_POST['input_sign__email']);
    $sign_password = trim($_POST['input_sign__password']);
    $admin = 0;

    if ($sign_name === '' || $sign_email === '' || $sign_password === '') {
        $errMsg_sign = "Не все поля заполнены!";
    } elseif (mb_strlen($sign_name, 'UTF8') < 2) {
        $errMsg_sign = "Логин должен быть более 1-ого символа!";
    } elseif (mb_strlen($sign_password, 'UTF8') < 6) {
        $errMsg_sign = "Пароль должен быть более 5-ти символов!";
    } else {
        $existence = selectOne('users', ['email' => $sign_email]);
        if ($existence['email'] === $sign_email) {
            $errMsg_sign = "Пользователь с такой почтой уже зарегистрирован!";
        } else {
            $errMsg_sign = '';
            $pass = password_hash($sign_password, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $sign_name,
                'email' => $sign_email,
                'password' => $pass
            ];

            $id_user = insert('users', $post);
            $user = selectOne('users', ['id' => $id_user]);
            userAuth($user);
        }
    }
} else {
    $sign_name = '';
    $sign_email = '';
}

//Код для авторизации пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
    $login_email = trim($_POST['input_login__email']);
    $login_password = trim($_POST['input_login__password']);

    if ($login_email === '' || $login_password === '') {
        $errMsg_login = "Не все поля заполнены!";
    } else {
        $existence = selectOne('users', ['email' => $login_email]);
        if ($existence && password_verify($login_password, $existence['password'])) {
            $errMsg_login = '';
            userAuth($existence);
        } else {
            $errMsg_login = "Почта либо пароль введены неверно!";
        }
    }
} else {
    $login_email = '';
}
