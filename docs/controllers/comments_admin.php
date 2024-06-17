<?php session_start();
include("../../blocks/path.php");
include("../../root_path.php");
include("../../database/db_func.php");

if (!$_SESSION) {
    header('location: ' . BASE_URL . "/req.php");
} elseif (!$_SESSION['admin']) {
    header('location: ' . BASE_URL);
}

$comments = array_reverse(selectAll('comments'));

// Код для изменения статуса публикации комментария
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('comments', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . '/admin/comments/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('comments', $id);
    header('location: ' . BASE_URL . '/admin/comments/index.php');
}
