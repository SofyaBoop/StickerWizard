<?php
include("blocks/path.php");
include("./controllers/orders.php");

$services = selectAll('services', ['status' => 1]);
$maxItems = 4;
$limitedServices = array_slice($services, 0, $maxItems);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>main_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        @@include('blocks/intro.html')
        @@include('blocks/services_for_index.php')
        @@include('blocks/examples.html')
        @@include('blocks/advantages.html')
        @@include('blocks/faq.html')
    </main>
    @@include('blocks/footer.php')
    <script src="./js/index.bundle.js"></script>
</body>

</html>