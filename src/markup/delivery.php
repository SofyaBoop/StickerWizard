<?php
include("blocks/path.php");
include("./controllers/orders.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>delivery_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        <div class="empty_div" style="margin-bottom: 4rem;"></div>
        <div class="delivery_section__topic" style="display: flex; justify-content: center;">
            <h2 id="heading-1-26rem">Оплата и доставка</h2>
        </div>
        @@include('blocks/delivery_inf.html')
    </main>
    @@include('blocks/footer.php')
    <script src="./js/delivery.bundle.js"></script>
</body>

</html>