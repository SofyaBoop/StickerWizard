<?php
include("blocks/path.php");
include("./controllers/orders.php");
include("./controllers/feedback.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>contacts_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        @@include('blocks/form.php')
    </main>
    @@include('blocks/footer.php')

    <script src="./js/contacts.bundle.js"></script>
</body>

</html>