<?php
include("../../blocks/path.php");
include("../../controllers/users_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>users_index_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <?php if ($_SESSION['admin'] == 2) : ?>
                <h3>Управление пользователями</h3>
                <div class="admin_act_btn_block">
                    <a href="<?php echo BASE_URL . "/admin/users/create.php"; ?>" class="admin_act_btn admin_act_btn__create">Создать</a>
                    <span class="col-1"></span>
                </div>
            <?php elseif ($_SESSION['admin'] == 1) : ?>
                <h3>Просмотр пользователей</h3>
            <?php endif; ?>
            <table class="table admin_panel_table__users">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Роль</th>
                        <th scope="col">Почта</th>
                        <?php if ($_SESSION['admin'] == 2) : ?>
                            <th class="col_manage_th" scope="col">Управление</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user) : ?>
                        <tr>
                            <th scope="row"><?= $user['id']; ?></th>
                            <td><?= $user['username']; ?></td>
                            <?php if ($_SESSION['admin'] == 2) : ?>
                                <?php if ($user['admin'] == 2) : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin">SuperAdmin</a></td>
                                <?php elseif ($user['admin'] == 1) : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin" href="edit.php?admin=0&edit_id=<?= $user['id']; ?>">Admin</a></td>
                                <?php else : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin" href="edit.php?admin=1&edit_id=<?= $user['id']; ?>">User</a></td>
                                <? endif; ?>
                                <td><?= $user['email']; ?></td>
                                <td class="manage_td_1">
                                    <!-- <a class="admin_panel_table__btn_edit admin_panel_table__btn" href="edit.php?edit_id=<?= $user['id']; ?>">edit</a> -->
                                    <a class="admin_panel_table__btn_delete admin_panel_table__btn" href="edit.php?delete_id=<?= $user['id']; ?>">delete</a>
                                </td>
                            <?php elseif ($_SESSION['admin'] == 1) : ?>
                                <?php if ($user['admin'] == 1) : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin">Admin</a></td>
                                <?php elseif ($user['admin'] == 2) : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin">SuperAdmin</a></td>
                                <?php else : ?>
                                    <td><a class="admin_panel_table__btn_edit admin_panel_table__btn" name="admin">User</a></td>
                                <? endif; ?>
                                <td><?= $user['email']; ?></td>
                                <!-- <td class="manage_td_1">
                                    <a class="admin_panel_table__btn_delete admin_panel_table__btn" href="edit.php?delete_id=<?= $user['id']; ?>">delete</a>
                                </td> -->
                            <? endif; ?>
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