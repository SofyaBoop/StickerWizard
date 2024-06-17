<?php
include("blocks/path.php");
include("./controllers/orders.php");

$services = selectAll('services', ['status' => 1]);
$comments = array_reverse(selectAll('comments', ['status' => 1]));

$maxItems = count($services);
$limitedServices = array_slice($services, 0, $maxItems);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>services_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        <div class="empty_div" style="margin-bottom: 4rem;"></div>
        <div class="services_section__topic" style="display: flex; justify-content: center;">
            <h2 id="heading-1-26rem">Наши услуги</h2>
        </div>
        @@include('blocks/services_for_services.php')
        <div class="reviews_section__topic" style="display: flex; justify-content: center; margin-bottom: 2rem;">
            <h2 id="heading-1-26rem">Отзывы</h2>
        </div>
        @@include('blocks/comments.php')
    </main>
    @@include('blocks/footer.php')
    <script src="./js/services.bundle.js"></script>
</body>

</html>