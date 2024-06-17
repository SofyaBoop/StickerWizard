<?php
include("../../controllers/validate_orders.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>orders_index_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Управление заказами</h3>
            <table class="table admin_panel_table__orders">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Файл</th>
                        <th scope="col">Характеристики</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Оформлен</th>
                        <th scope="col">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($v_orders as $key => $order) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td>
                                <p>Имя: <?= $order['username']; ?></p>
                                <p>Почта: <?= $order['email']; ?></p>
                            </td>
                            <td>
                                <a class="btn_link btn_link_open_file" href="<?php echo BASE_URL . "/maket_files/" . $order['file']; ?>">
                                    <?= $order['file']; ?>
                                </a>
                            </td>
                            <td>
                                <p>Тип: <?= $order['service_name']; ?></p>
                                <p>Материал: <?= $order['order_material']; ?></p>
                                <p>Размер: <?= $order['order_size']; ?> см.</p>
                                <p>Тираж: <?= $order['order_quantity']; ?> шт.</p>
                            </td>
                            <td><?= $order['status']; ?></td>
                            <td><?= DateTime::createFromFormat('Y-m-d H:i:s', $order['created'])->format('d.m.Y'); ?></td>
                            <td>
                                <a class="admin_panel_table__btn_edit admin_panel_table__btn" href="edit.php?id=<?= $order['id']; ?>">edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin.bundle.js"></script>
</body>

</html>