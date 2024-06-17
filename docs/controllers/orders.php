<?php session_start();
include("./root_path.php");
include("./database/db_func.php");

function groupOrders($orders)
{
    $groupedOrders = [];
    foreach ($orders as $order) {
        $key = $order['user_id'] . '_' . $order['created'];
        if (!isset($groupedOrders[$key])) {
            $groupedOrders[$key] = [
                'orders' => [],
                'total_price' => 0,
                'order_count' => 0
            ];
        }
        $groupedOrders[$key]['orders'][] = $order;
        $groupedOrders[$key]['total_price'] += $order['price'];
        $groupedOrders[$key]['order_count']++;
    }
    return $groupedOrders;
}

$errMsg = [];
$id_order_card = '';
$id_user = '';
$image = '';
$order_type = '';
$order_material = '';
$order_size = '';
$order_quantity = '';
$price = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_add_card'])) {

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];

        $destination = ROOT_PATH . "\maket_files\\" . $imageName;

        $result = move_uploaded_file($fileTmpName, $destination);

        if ($result) {
            $_POST['image'] = $imageName;
        } else {
            array_push($errMsg, "Ошибка загрузки изображения на сервер");
        }
    } else {
        array_push($errMsg, "Ошибка получения картинки");
    }

    $id_user = $_SESSION['id'];
    $order_type = trim($_POST['type']);
    $order_material = trim($_POST['material']);
    $order_size = trim($_POST['size']);
    $order_quantity = trim($_POST['quantity']);
    $price = trim($_POST['price']);


    if (empty($_FILES['image']['name'])) {
        array_push($errMsg, "Файл не загружен");
    } else {
        $order_card = [
            'id_user' => $id_user,
            'file' => $_POST['image'],
            'order_service_name' => $order_type,
            'order_material' => $order_material,
            'order_size' => $order_size,
            'order_quantity' => $order_quantity,
            'price' => $price
        ];

        $success = true;

        $order_card = insert('card_ordrers', $order_card);

        $order_card = [];
    }
} else {
    $id_order_card = '';
    $id_user = '';
    $image = '';
    $order_type = '';
    $order_material = '';
    $order_size = '';
    $order_quantity = '';
    $price = '';
    $success = false;
}

// Удаление заказов из корзины
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('card_ordrers', $id);
    header('location: ' . BASE_URL . '/cart.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_set_order'])) {

    $id_user = $_SESSION['id'];
    $card_id_orders = selectAll('card_ordrers', ['id_user' => $id_user]);

    foreach ($card_id_orders as $order) {
        $order_data = [
            'id_user' => $order['id_user'],
            'file' => $order['file'],
            'service_name' => $order['order_service_name'],
            'order_material' => $order['order_material'],
            'order_size' => $order['order_size'],
            'order_quantity' => $order['order_quantity'],
            'price' => $order['price'],
            'id_status' => 1
        ];

        insert('orders', $order_data);
        delete('card_ordrers', $order['id']);

        $order_data = [];

        $success_card = true;
    }
} else {
    $success_card = false;
}
