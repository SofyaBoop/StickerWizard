<?php
include("../../controllers/validate_orders.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>order_edit_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Редактирование заказа</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/orders/index.php"; ?>" class="admin_act_btn admin_act_btn__edit">Назад к списку</a>
                <span class="col-1"></span>
            </div>
            <section class="row create_admin_section">
                <div class="mb-12 col-12 col-md-12 err">
                    <!-- Вывод массива с ошибками -->
                </div>
                <form action="edit.php" method="post">
                    <input name="id_order" value="<?= $id_order; ?>" type="hidden">
                    <div class="edit_order_field">
                        <label for="formGroupExampleInput" class="form-label">Заказ</label>
                        <input value="<?= $post['file']; ?>" type="text" class="form-control" id="formGroupExampleInput" readonly>
                    </div>
                    <div class="edit_order_status">
                        <select name="order_status" class="form-select mb-2" aria-label="Default select example">
                            <?php foreach ($order_statuses as $key => $order_status) : ?>
                                <option value="<?= $order_status['id']; ?>"><?= $order_status['status']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="edit_order_field">
                        <button name="edit-order" class="edit_user_btn edit_btn" type="submit">Сохранить</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin.bundle.js"></script>

</body>

</html>