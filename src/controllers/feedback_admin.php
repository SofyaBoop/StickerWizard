<?php session_start();
include("../../blocks/path.php");
include("../../root_path.php");
include("../../database/db_func.php");

if (!$_SESSION) {
    header('location: ' . BASE_URL . "/req.php");
} elseif (!$_SESSION['admin']) {
    header('location: ' . BASE_URL);
}

$feedbacks = array_reverse(selectAll('feedback'));

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('feedback', $id);
    header('location: ' . BASE_URL . '/admin/feedback/index.php');
}
