<?php session_start();
include("../../blocks/path.php");
include("../../root_path.php");
include("../../database/db_func.php");

if (!$_SESSION) {
    header('location: ' . BASE_URL . "/req.php");
} elseif (!$_SESSION['admin']) {
    header('location: ' . BASE_URL);
}

$v_orders = array_reverse(selectAllOrdersWithStatuses('orders', 'order_statuses', 'users'));
$order_statuses = selectAll('order_statuses');

// Смена статуса заказа
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('orders', ['id' => $_GET['id']]);

    $id_order =  $post['id'];
    $file =  $post['file'];
    $status = $post['id_status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-order'])) {

    $id_order =  $_POST['id_order'];
    $status = trim($_POST['order_status']);

    $post = [
        'id_status' => $status,
    ];

    $post = update('orders', $id_order, $post);
    header('location: ' . BASE_URL . '/admin/orders/index.php');
} else {
    $status = trim($_POST['order_status']);
}
