<?php
include("../../blocks/path.php");
include("../../controllers/services.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>services_index_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        @@include('../../modal_windows/modal_service_img_look_admin.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Управление услугами</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/services/create.php"; ?>" class="admin_act_btn admin_act_btn__create">Создать</a>
                <span class="col-1"></span>
            </div>
            <table class="table admin_panel_table__services">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Изображение</th>
                        <th class="col_manage_th" scope="col">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $key => $service) : ?>
                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><?= $service['service_name'] ?></td>
                            <td>
                                <button type="button" class="btn_link btn_link_open_file" data-image="<?= '../../img/servive_pictures/_services_pictures/' . $service['image'] ?>">
                                    <?= $service['image'] ?>
                                </button>
                            </td>
                            <td class="manage_td_3">
                                <a class="admin_panel_table__btn_edit admin_panel_table__btn" href="edit.php?id=<?= $service['id']; ?>">edit</a>
                                <a class="admin_panel_table__btn_delete admin_panel_table__btn" href="edit.php?delete_id=<?= $service['id']; ?>">delete</a>
                                <?php if ($service['status']) : ?>
                                    <div name="publish" class="admin_panel_table__btn_unpublish"><a class="admin_panel_table__btn" href="edit.php?publish=0&pub_id=<?= $service['id']; ?>">unpublish</a></div>
                                <?php else : ?>
                                    <div name="publish" class="admin_panel_table__btn_publish"><a class="admin_panel_table__btn" href="edit.php?publish=1&pub_id=<?= $service['id']; ?>">publish</a></div>
                                <?php endif; ?>
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