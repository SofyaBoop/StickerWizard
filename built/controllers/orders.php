<?php session_start();
include("./root_path.php");
include("./database/db_func.php");

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
        $fileType = $_FILES['image']['type'];
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
}
