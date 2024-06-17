<?php
include("../../blocks/path.php");
include("../../controllers/users_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>user_create_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Создание пользователя</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>" class="admin_act_btn admin_act_btn__edit">Назад к списку</a>
                <span class="col-1"></span>
            </div>
            <section class="row create_admin_section">
                <div class="mb-12 col-12 col-md-12 err">
                    <!-- Вывод массива с ошибками -->
                </div>
                <form action="create.php" method="post">
                    <div class="create_user_field">
                        <label for="formGroupExampleInput" class="form-label">Логин</label>
                        <input name="input_create_user__name" value="" type="text" class="form-control" id="formGroupExampleInput" placeholder="Логин...">
                    </div>
                    <div class="create_user_field">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input name="input_create_user__email" value="" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email...">
                    </div>
                    <div class="create_user_field">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input name="input_create_user__pswrd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль...">
                    </div>
                    <div class=" create_user_field_check_admin">
                        <input name="input_create_user__admin" class="form_check_input" value="1" type="checkbox" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Админ?
                        </label>
                    </div>
                    <div class="create_user_field">
                        <button name="create-user" class="create_user_btn create_btn" type="submit">Создать</button>
                    </div>

                </form>
            </section>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin.bundle.js"></script>

</body>

</html>