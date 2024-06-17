<?php
include("blocks/path.php");
include("./controllers/users.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>req_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        @@include('blocks/login_signin.php')
    </main>
    @@include('blocks/footer.php')

    <script src="./js/req.bundle.js"></script>
</body>

</html>