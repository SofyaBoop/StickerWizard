<?php session_start();
include("../../blocks/path.php");
include("../../root_path.php");
include("../../database/db_func.php");

if (!$_SESSION) {
    header('location: ' . BASE_URL . "/req.php");
} elseif (!$_SESSION['admin']) {
    header('location: ' . BASE_URL);
}

$errMsg = [];
$id_service = '';
$service_name = '';
$descryption = '';
$service_size = '';
$image = '';

$services = selectAll('services');
$services_size = selectAll('service_category_size');
// Код для формы создания услуги
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-service'])) {

    if (!empty($_FILES['image']['name'])) {
        $imageName = "_" . $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $destination = ROOT_PATH . "\img\servive_pictures\_services_pictures\\" . $imageName;
        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Подгружаемый файл не является изображением!");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['image'] = $imageName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер");
            }
        }
    } else {
        array_push($errMsg, "Ошибка получения картинки");
    }

    $service_name = trim($_POST['input_create_service__name']);
    $descryption = trim($_POST['descryption']);
    $service_size = trim($_POST['service_size']);
    $publish = isset($_POST['input_create_service__status']) ? 1 : 0;


    if ($service_name === '' || $descryption === '' || $service_size === '' || empty($_FILES['image']['name'])) {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($service_name, 'UTF8') < 7) {
        array_push($errMsg, "Название статьи должно быть более 6-ти символов");
    } else {
        $post = [
            'service_name' => $service_name,
            'service_descryption' => $descryption,
            'image' => $_POST['image'],
            'id_service_category_size' => $service_size,
            'status' => $publish
        ];

        $post = insert('services', $post);
        $post = selectOne('services', ['id' => $id_service]);
        header('location: ' . BASE_URL . '/admin/services/index.php');
    }
} else {
    $id_service = '';
    $service_name = '';
    $descryption = '';
    $service_size = '';
    $publish = '';
}


// Редактирование услуги
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('services', ['id' => $_GET['id']]);

    $id_service =  $post['id'];
    $service_name =  $post['service_name'];
    $descryption = $post['service_descryption'];
    $service_size = $post['id_service_category_size'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-service'])) {

    $id_service =  $_POST['id_service'];
    $service_name = trim($_POST['input_edit_service__name']);
    $descryption_edit = trim($_POST['descryption']);
    $service_size_edit = trim($_POST['service_size']);
    $publish_edit = isset($_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['image']['name'])) {
        $imageName = "_" . $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $destination = ROOT_PATH . "\img\servive_pictures\_services_pictures\\" . $imageName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Подгружаемый файл не является изображением!");
        } else {
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result) {
                $_POST['image'] = $imageName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер");
            }
        }
    } else {
        array_push($errMsg, "Ошибка получения картинки");
    }

    if ($service_name === '' || empty($_FILES['image']['name'])) {
        array_push($errMsg, "Не все поля заполнены!");
    } elseif (mb_strlen($service_name, 'UTF8') < 7) {
        array_push($errMsg, "Название статьи должно быть более 6-ти символов");
    } else {
        $post = [
            'service_name' => $service_name,
            'service_descryption' => $descryption_edit,
            'image' => $_POST['image'],
            'id_service_category_size' => $service_size_edit,
            'status' => $publish_edit
        ];
        $post = update('services', $id_service, $post);
        header('location: ' . BASE_URL . '/admin/services/index.php');
    }
} else {
    $service_name = trim($_POST['input_edit_service__name']);
    $descryption_edit = trim($_POST['descryption']);
    $service_size_edit = trim($_POST['service_size']);
    $publish_edit = isset($_POST['publish']) ? 1 : 0;
}

// Код для изменения статуса публикации услуги
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('services', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . '/admin/services/index.php');
    exit();
}

//Удаление услуги
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('services', $id);
    header('location: ' . BASE_URL . '/admin/services/index.php');
}
