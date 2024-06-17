<?php
include("blocks/path.php");
include("./controllers/orders.php");

$orders = selectUsersOrdersWithStatuses('orders', 'order_statuses', $_SESSION['id']);

$groupedOrders = array_reverse(groupOrders($orders));
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/main.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>user_sticker_wizard</title>
</head>

<body>
    <header class="header_navbar">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="<?php echo BASE_URL; ?>"><img class="logo_img" src="../img/sw_ilogo_v2.png" /></a>
        </div>
        <nav class="navbar__navigation">
            <ul class="navbar__links">
                <li><a href="../services.php">НАШИ УСЛУГИ</a></li>
                <li><a href="../delivery.php">ОПЛАТА И ДОСТАВКА</a></li>
                <li><a href="../requirements.php">МАКЕТЫ</a></li>
                <li><a href="../contacts.php">КОНТАКТЫ</a></li>
                <?php if ($_SESSION['admin']) : ?>
                    <li><a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>">АДМИН</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="navbar_io">
            <?php if (isset($_SESSION['id'])) : ?>
                <?php if ($_SESSION['admin']) : ?>
                    <div class="navbar_io">
                        <a name="user_icon" class="user_icon" href="#">
                            <p><?php echo $_SESSION['username']; ?></p>
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <button class="admin_logout_btn" onclick="window.user_modal_exit.showModal()">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </div>
                <?php else : ?>
                    <button class="cart_btn" id="cart_btn" onclick="document.location='../cart.php'">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <?php
                        $a_orders = selectAll('card_ordrers', ['id_user' => $_SESSION['id']]);
                        $total_orders = count($a_orders);
                        ?>
                        <div class="cart__num" id="cart_num"><?= $total_orders; ?></div>
                    </button>
                    <a name="user_icon" href="../user.php">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php endif; ?>
            <?php else : ?>
                <button class="cart_btn" id="cart_btn" onclick="document.location='../req.php'">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="cart__num" id="cart_num">0</div>
                </button>
                <a name="user_icon" type="submit" href="../req.php">
                    <i class="fa-solid fa-user"></i>
                </a>
            <?php endif; ?>

            <div class="navbar__toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </div>
</header>
<div class="overlay" id="overlay"></div>
<header class="dropdown_navbar">
    <div class="dropdown_navbar__toggle_btn">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="dropdown__logo">
        <a href="<?php echo BASE_URL; ?>"><img class="dropdown__logo_img" src="../img/sw_ilogo_v3.png" /></a>
    </div>
    <nav class="dropdown_navbar__navigation">
        <ul class="dropdown_navbar__links">
            <li><a href="../services.php">НАШИ УСЛУГИ</a></li>
            <li><a href="../delivery.php">ОПЛАТА И ДОСТАВКА</a></li>
            <li><a href="../requirements.php">МАКЕТЫ</a></li>
            <li><a href="../contacts.php">КОНТАКТЫ</a></li>
            <?php if ($_SESSION['admin']) : ?>
                <li><a href="<?php echo BASE_URL . "/admin/users/index.php"; ?>">АДМИН</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
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
        <section class="account_section">
    <div class="account_nav_block">
        <h3>Личный кабинет</h3>
        <nav class="account_navigation">
            <ul>
                <li><a href="#user_profile" class="account_links content_links">Профиль</a></li>
                <li><a href="#user_orders" class="account_links content_links">Заказы</a></li>
                <li>
                    <button class="account_logout_btn" onclick="window.user_modal_exit.showModal()">
                        <a class="account_links account_logout_link">Выйти</a>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    <div class="account_content">
        <article class="account_content__profile_settings account_content__article" id="user_profile">
            <h4 class="account_content__title">Мой профиль</h4>
            <?php if (isset($_SESSION['id'])) : ?>
                <form class="profile_settings__form">
                    <fieldset class="profile_settings__form_data">
                        <legend>Данные профиля</legend>
                        <div class="profile_settings__name">
                            <label class="profile_label__name profile_label">Отоброжаемое имя<span class="red">&nbsp;*</span></label>
                            <input type="text" value="<?php echo $_SESSION['username']; ?>" class="profile_input__change_name profile_input" id="profile_input__change_name">
                        </div>
                        <div class="profile_settings__email">
                            <label class="profile_label__email profile_label">Email<span class="red">&nbsp;*</span></label>
                            <input type="email" value="<?php echo $_SESSION['email']; ?>" class="profile_input__change_email profile_input" id="profile_input__change_email">
                        </div>
                    </fieldset>
                    <fieldset class="profile_settings__form_password">
                        <legend>Смена пароля</legend>
                        <div class="profile_settings__old_password">
                            <label class="profile_label__old_password profile_label">Дейсвтующий пароль</label>
                            <input type="password" class="profile_input__old_password profile_input" id="profile_input__old_password">
                        </div>
                        <div class="profile_settings__new_password">
                            <label class="profile_label__new_password profile_label">Новый пароль</label>
                            <input type="password" class="profile_input__new_password profile_input" id="profile_input__new_password">
                        </div>
                        <div class="profile_settings__new_password_re">
                            <label class="profile_label__new_password_re profile_label">Подтвердите новый пароль</label>
                            <input type="password" class="profile_input__new_password_re profile_input" id="profile_input__new_password_re">
                        </div>
                    </fieldset>
                    <button type="submit" class="save_acc_settings_btn" value="Сохранить изменения">Сохранить изменения</button>
                </form>
            <?php else : ?>
                <form class="profile_settings__form">
                    <fieldset class="profile_settings__form_data">
                        <legend>Данные профиля</legend>
                        <div class="profile_settings__name">
                            <label class="profile_label__name profile_label">Отоброжаемое имя<span class="red">&nbsp;*</span></label>
                            <input type="text" class="profile_input__change_name profile_input" id="profile_input__change_name">
                        </div>
                        <div class="profile_settings__email">
                            <label class="profile_label__email profile_label">Email<span class="red">&nbsp;*</span></label>
                            <input type="email" class="profile_input__change_email profile_input" id="profile_input__change_email">
                        </div>
                    </fieldset>
                    <fieldset class="profile_settings__form_password">
                        <legend>Смена пароля</legend>
                        <div class="profile_settings__old_password">
                            <label class="profile_label__old_password profile_label">Дейсвтующий пароль</label>
                            <input type="password" class="profile_input__old_password profile_input" id="profile_input__old_password">
                        </div>
                        <div class="profile_settings__new_password">
                            <label class="profile_label__new_password profile_label">Новый пароль</label>
                            <input type="password" class="profile_input__new_password profile_input" id="profile_input__new_password">
                        </div>
                        <div class="profile_settings__new_password_re">
                            <label class="profile_label__new_password_re profile_label">Подтвердите новый пароль</label>
                            <input type="password" class="profile_input__new_password_re profile_input" id="profile_input__new_password_re">
                        </div>
                    </fieldset>
                    <button type="submit" class="save_acc_settings_btn" value="Сохранить изменения">Сохранить изменения</button>
                </form>
            <?php endif; ?>
        </article>
        <article class="account_content__orders account_content__article" id="user_orders">
            <h4 class="account_content__title">Мои заказы</h4>
            <?php if (!empty($orders)) : ?>
                <?php foreach ($groupedOrders as $key => $ordersGroup) : ?>
                    <div class="user_order_block">
                        <div class="user_order_block__title">
                            <div class="order_block_title__info">
                                <strong>
                                    Заказ №<?= str_replace(array("-", " ", ":"), '', $ordersGroup['orders'][0]['created']); ?>,
                                    от <?= DateTime::createFromFormat('Y-m-d H:i:s', $ordersGroup['orders'][0]['created'])->format('d.m.Y'); ?>,
                                    товаров <?= $ordersGroup['order_count']; ?> на сумму <?= $ordersGroup['total_price']; ?> руб.
                                </strong>
                            </div>
                            <div class="order_block_title__status">
                                <p class="status"><?= $ordersGroup['orders'][0]['status']; ?></p>
                            </div>
                        </div>
                        <div class="user_order_block__pay">
                            <p>Тут будет информация об оплате</p>
                        </div>
                        <div class="user_order_block__delivery">
                            <p>А тут информация о доставке</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="message_empty__content message_empty">
                    <div class='icon_warning_outline'><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class='message_empty_order'>
                        <p>Заказов еще не создано.</p>
                    </div>
                </div>
            <?php endif; ?>
        </article>
    </div>
</section>
    </main>
    <footer class="footer">
    <div class="footer_box">
        <div class="upper_footer">
            <nav class="footer__navigation">
                <ul class="footer__links">
                    <li><a href="../services.php">наши услуги</a></li>
                    <li><a href="../delivery.php">оплата и доставка</a></li>
                    <li><a href="../requirements.php">макеты</a></li>
                    <li><a href="../contacts.php">контакты</a></li>
                </ul>
            </nav>
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
                <img class="image_pay" src="../img/pay_methods/pay.png" alt="Способ оплаты" />
            </div>
            <div class="footer__copyrite">
                <h6 class="copyrite">2024 © StickerWizard.ru - интернет-магазин стикеров</h5>
                    <a href="agreement" class="agree_link">Согласие на обработку персональных данных</a>
            </div>
        </div>
    </div>
</footer>

    <script src="./js/user.bundle.js"></script>
</body>

</html>