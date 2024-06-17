<?php
include("blocks/path.php");
include("./controllers/orders.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>requirements_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        <div class="empty_div" style="margin-bottom: 4rem;"></div>
        <div class="requirements_section__topic" style="display: flex; justify-content: center;">
            <h2 id="heading-1-26rem">Требования к макетам</h2>
        </div>
        @@include('blocks/requirements.php')
    </main>
    @@include('blocks/footer.php')
    <script src="./js/requirements.bundle.js"></script>
</body>

</html>