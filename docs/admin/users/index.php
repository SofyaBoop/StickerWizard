<?php
include("../../blocks/path.php");
include("../../controllers/users_admin.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../../css/main.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></link>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>users_index_sticker_wizard</title>
</head>

<body>
    <header class="header_navbar">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="<?php echo BASE_URL; ?>"><img class="logo_img" src="../../img/sw_ilogo_v2.png" /></a>
        </div>
        <!-- <nav class="navbar__navigation">
            <ul class="navbar__links">
                <li><a href="../services.php">ПОЛЬЗОВАТЕЛИ</a></li>
                <li><a href="../delivery.php">ЗАКАЗЫ</a></li>
                <li><a href="../requirements.php">КОММЕНТАРИИ</a></li>
            </ul>
        </nav> -->
        <?php if (isset($_SESSION['id'])) : ?>
            <div class="navbar_io">
                <a name="user_icon" class="user_icon" href="#">
                    <p><?php echo $_SESSION['username']; ?></p>
                    <i class="fa-solid fa-user"></i>
                </a>
                <button class="admin_logout_btn" onclick="window.user_modal_exit.showModal()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>

                <!-- <div class="navbar__toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div> -->
            </div>
        <?php endif; ?>
    </div>
</header>
<div class="overlay" id="overlay"></div>
<!-- <header class="dropdown_navbar">
    <div class="dropdown_navbar__toggle_btn">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="dropdown__logo">
        <a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>"><img class="dropdown__logo_img" src="../../img/sw_ilogo_v3.png" /></a>
    </div>
    <nav class="dropdown_navbar__navigation">
        <ul class="dropdown_navbar__links">
            <li><a href="../services.php">ПОЛЬЗОВАТЕЛИ</a></li>
            <li><a href="../delivery.php">ЗАКАЗЫ</a></li>
            <li><a href="../requirements.php">КОММЕНТАРИИ</a></li>
            <li>
                <button class="admin_logout_btn" onclick="window.user_modal_exit.showModal()">
                    <a>ВЫЙТИ</a>
                </button>
            </li>
        </ul>
    </nav>
</header> -->
    <main>
        <dialog id="user_modal_exit" class="modal_notice_exit modal_window" aria-label="Окно выхода">
    <div class="modal_notice_exit__content modal_content">
        <h4>Выход</h4>
        <span class="window_text">
            <p>Вы действительно хотите выйти?</p>
            <a class="link_for_exit" href="<?php echo BASE_URL . "/logout.php"; ?>">Подтвердить и выйти</a>
        </span>
        <button onclick="window.user_modal_exit.close();" aria-label="close" class="x_exit"><i class="fa-solid fa-xmark"></i></button>
    </div>
</dialog>
        <div class="admin_panel_block">
            <div class="sidebar_block">
    <div class="sidebar">
        <ul>
            <li>
                <a class="sidebar_link" href="<?php echo BASE_URL . "/admin/users/index.php"; ?>">Пользователи</a>
            </li>
            <li>
                <a class="sidebar_link" href="<?php echo BASE_URL . "/admin/services/index.php"; ?>">Услуги</a>
            </li>
            <li>
                <a class="sidebar_link" href="<?php echo BASE_URL . "/admin/orders/index.php"; ?>">Заказы</a>
            </li>
            <li>
                <a class="sidebar_link" href="<?php echo BASE_URL . "/admin/comments/index.php"; ?>">Комментарии</a>
            </li>
            <li>
                <a class="sidebar_link" href="<?php echo BASE_URL . "/admin/feedback/index.php"; ?>">Обратная связь</a>
            </li>
        </ul>
    </div>
</div>
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
    <footer class="footer">
    <div class="footer_box">
        <div class="upper_footer">
            <!-- <nav class="footer__navigation">
                <ul class="footer__links">
                    <li><a href="../services.php">наши услуги</a></li>
                    <li><a href="../delivery.php">оплата и доставка</a></li>
                    <li><a href="../requirements.php">макеты</a></li>
                    <li><a href="../contacts.php">контакты</a></li>
                </ul>
            </nav> -->
            <div class="footer__meta meta">
                <div class="meta__contacts contacts">
                    <div class="div_email contacts__div"><a href="#">sticker_wizard@gmail.com</a></div>
                    <div class="div_phone contacts__div"><a href="tel:+79999999999">+7(999)999-99-99</a></div>
                    <div class="div_w_day contacts__div">
                        <p>Пн-Пт: 12:00 - 20:00</p>
                    </div>
                </div>
                <div class="meta__nets nets">
                    <a href="#"><i class="fa-brands fa-telegram"></i></a>
                    <a href="#"><i class="fa-brands fa-vk"></i></a>
                </div>
            </div>
        </div>
        <div class="lower_footer">
            <div class="footer__pay_methods">
                <img class="image_pay" src="../../img/pay_methods/pay.png" alt="Способ оплаты" />
            </div>
            <div class="footer__copyrite">
                <h6 class="copyrite">2024 © StickerWizard.ru - интернет-магазин стикеров</h5>
                    <a href="agreement" class="agree_link">Согласие на обработку персональных данных</a>
            </div>
        </div>
    </div>
</footer>
    <script src="../../js/admin.bundle.js"></script>

</body>

</html>