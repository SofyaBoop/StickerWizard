<?php
include("../../blocks/path.php");
include("../../controllers/users_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>user_edit_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Редактирование пользователя</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>" class="admin_act_btn admin_act_btn__edit">Назад к списку</a>
                <span class="col-1"></span>
            </div>
            <section class="row create_admin_section">
                <div class="mb-12 col-12 col-md-12 err">
                    <!-- Вывод массива с ошибками -->
                </div>
                <form action="edit.php" method="post">
                    <input name="id" value="<?= $id; ?>" type="hidden">
                    <div class="edit_user_field">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input name="input_edit_user__name" value="<?= $username; ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Логин...">
                    </div>
                    <div class="edit_user_field">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input name="input_edit_user__email" value="<?= $email; ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email..." readonly>
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword1" class="form-label">Сбросить пароль</label>
                        <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль...">
                    </div>
                    <div class="col">
                        <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                        <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторите пароль...">
                    </div>
                    <div class="edit_user_field_check_admin">
                        <?php if (empty($admin) && $admin == 0) : ?>
                            <input name="input_edit_user__admin" class="form_check_input" type="checkbox" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Админ
                            </label>
                        <?php else : ?>
                            <input name="input_edit_user__admin" class="form_check_input" value="1" type="checkbox" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Админ
                            </label>
                        <?php endif; ?>
                    </div>
                    <div class="edit_user_field">
                        <button name="edit-user" class="edit_user_btn edit_btn" type="submit">Сохранить</button>
                    </div>

                </form>
            </section>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin.bundle.js"></script>

</body>

</html>