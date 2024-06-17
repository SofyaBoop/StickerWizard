<?php
include("../../controllers/feedback_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>feedback_index_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Управление сообщениями</h3>
            <table class="table admin_panel_table__services">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Имя</th>
                        <th scope="col">Почта</th>
                        <th scope="col">Сообщение</th>
                        <th scope="col">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedbacks as $key => $feedback) : ?>
                        <tr>
                            <th scope="row"><?= $feedback['id']; ?></th>
                            <td>
                                <?= $feedback['person_name']; ?>
                            </td>
                            <td>
                                <?= $feedback['person_email']; ?>
                            </td>
                            <td>
                                <?= $feedback['text']; ?>
                            </td>
                            <td>
                                <a class="admin_panel_table__btn_delete admin_panel_table__btn" href="index.php?delete_id=<?= $feedback['id']; ?>">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin_service_index.bundle.js"></script>

</body>

</html>