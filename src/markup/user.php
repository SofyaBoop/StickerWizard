<?php
include("blocks/path.php");
include("./controllers/orders.php");

$orders = selectUsersOrdersWithStatuses('orders', 'order_statuses', $_SESSION['id']);

$groupedOrders = array_reverse(groupOrders($orders));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>user_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        @@include('blocks/user.php')
    </main>
    @@include('blocks/footer.php')

    <script src="./js/user.bundle.js"></script>
</body>

</html>