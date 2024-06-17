<?php session_start();
include("../../blocks/path.php");
include("../../root_path.php");
include("../../database/db_func.php");

error_reporting(0);

if (!$_SESSION) {
    header('location: ' . BASE_URL . "/req.php");
} elseif (!$_SESSION['admin']) {
    header('location: ' . BASE_URL);
}

$errMsg = [];

$users = selectAll('users');

// Код добавления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {

    $admin = 0;
    $username = trim($_POST['input_create_user__name']);
    $email = trim($_POST['input_create_user__email']);
    $pass = trim($_POST['input_create_user__pswrd']);

    if ($username === '' || $email === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($username, 'UTF8') < 2) {
        array_push($errMsg, "Логин должен быть более 1-ого символа");
    } elseif (mb_strlen($pass, 'UTF8') < 6) {
        array_push($errMsg, "Пароль должен быть более 5-ти символов");
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email) {
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        } else {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['input_create_user__admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $username,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            header('location: ' . BASE_URL . '/admin/users/index.php');
        }
    }
} else {
    $username = '';
    $email = '';
}

// Код удаления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . '/admin/users/index.php');
}

// Редактирование пользователя через админку
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id =  $user['id'];
    $admin =  $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user'])) {

//     $id = $_POST['id'];
//     $email = trim($_POST['input_edit_user__email']);
//     $username = trim($_POST['input_edit_user__name']);
//     $passF = trim($_POST['pass-first']);
//     $passS = trim($_POST['pass-second']);
//     $admin = isset($_POST['input_edit_user__admin']) ? 1 : 0;

//     if ($username === '' || $passF === '' || $passS === '') {
//         array_push($errMsg, "Не все поля заполнены!");
//     } elseif (mb_strlen($username, 'UTF8') < 2) {
//         array_push($errMsg, "Логин должен быть более 1-ого символа");
//     } elseif ($passF !== $passS) {
//         array_push($errMsg, "Пароли в обеих полях должны соответствовать!");
//     } elseif (mb_strlen($passS, 'UTF8') < 6 || mb_strlen($passF, 'UTF8') < 6) {
//         array_push($errMsg, "Пароль должен быть более 5-ти символов");
//     } else {
//         $pass = password_hash($passF, PASSWORD_DEFAULT);
//         if (isset($_POST['input_edit_user__admin'])) $admin = 1;
//         $user = [
//             'admin' => $admin,
//             'username' => $username,
//             //'email' => $email,
//             'password' => $pass
//         ];

//         $user = update('users', $id, $user);
//         header('location: ' . BASE_URL . '/admin/users/index.php');
//     }
// } else {
//     $id =  $user['id'];
//     $admin =  $user['admin'];
//     $username = $user['username'];
//     $email = $user['email'];
// }


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $admin = $_GET['admin'];

    $postId = update('users', $id, ['admin' => $admin]);

    header('location: ' . BASE_URL . '/admin/users/index.php');
    exit();
}
