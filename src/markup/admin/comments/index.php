<?php
include("../../controllers/comments_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>comments_index_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Управление комментариями</h3>
            <table class="table admin_panel_table__services">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Имя</th>
                        <th scope="col">Почта</th>
                        <th scope="col">Комментарий</th>
                        <th scope="col">Дата</th>
                        <th class="col_manage_th" scope="col">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $key => $comment) : ?>
                        <tr>
                            <th scope="row"><?= $comment['id']; ?></th>
                            <td>
                                <?= $comment['username']; ?>
                            </td>
                            <td>
                                <?= $comment['email']; ?>
                            </td>
                            <td>
                                <?= $comment['text']; ?>
                            </td>
                            <td>
                                <?= DateTime::createFromFormat('Y-m-d H:i:s', $comment['created'])->format('d.m.Y'); ?>
                            </td>
                            <td style="display:flex; flex-direction:row; justify-content: center; gap: 1rem">
                                <a class="admin_panel_table__btn_delete admin_panel_table__btn" href="index.php?delete_id=<?= $comment['id']; ?>">delete</a>
                                <?php if ($comment['status']) : ?>
                                    <div name="publish" class="admin_panel_table__btn_unpublish"><a class="admin_panel_table__btn" href="index.php?publish=0&pub_id=<?= $comment['id']; ?>">unpublish</a></div>
                                <?php else : ?>
                                    <div name="publish" class="admin_panel_table__btn_publish"><a class="admin_panel_table__btn" href="index.php?publish=1&pub_id=<?= $comment['id']; ?>">publish</a></div>
                                <?php endif; ?>
                                <br>
                                <br>
                                <br>
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