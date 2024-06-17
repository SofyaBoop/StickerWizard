<?php
include("blocks/path.php");
include("./controllers/orders.php");

$service = selectOne('services', ['id' => $_GET['service']]);

$materials = selectAll('materials');
$quantities = selectAll('quantities');

switch ($service['id_service_category_size']) {
    case 1:
        $sizeTable = 'small_size';
        break;
    case 2:
        $sizeTable = 'large_size';
        break;
    case 3:
        $sizeTable = 'standard_size';
        break;
    default:
        $sizeTable = 'small_size';
        break;
}

$sizies = selectAll($sizeTable);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>plotter_cutting_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_successful_order.php')
        @@include('modal_windows/modal_general_req.html')
        <section class="section_constructor">
            <div class="section_constructor__left_side">
                <h2 class="h1_topic"><?= $service['service_name']  ?></h2>
                <p><?= $service['service_descryption']  ?></p>
            </div>
            <div class="section_constructor__right_side">
                @@include('blocks/constructor.php')
            </div>
        </section>
    </main>
    @@include('blocks/footer.php')

    <script src="./js/constructor.bundle.js"></script>
    <?php if ($success) : ?>
        <script>
            window.onload = function() {
                var modal = document.getElementById('successful_order_post');
                modal.showModal();
            }
        </script>
    <?php endif; ?>
</body>

</html>