<?php
include("blocks/path.php");
include("./database/db_func.php");
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
    <title>contacts_sticker_wizard</title>
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
                        <div class="cart__num" id="cart_num">1</div>
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
        <section class='form_section'>
    <div class="form_section__left">
        <div class="time_info form__contacts">
            <i class="fa-solid fa-clock"></i>
            <p>Пн-Пт: 12:00 - 20:00</p>
        </div>
        <div class="phone_info form__contacts">
            <i class="fas fa-phone-alt"></i>
            <a href="tel:+79999999999">+7(999)999-99-99</a>
        </div>
        <div class="mail_info form__contacts">
            <i class="fas fa-envelope"></i>
            <a href="#">sticker_wizard@gmail.com</a>
        </div>
    </div>
    <div class="form_section__right">
        <h3 class="form_section__topic">Форма обратной связи</h3>
        <p class="form_section__description">Заполните, пожалуйста, форму, мы свяжемся с вами в самое ближайшее время</p>
        <form action="#" class="true_form">
            <div class="input-box">
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <input type="text" value="<?php echo $_SESSION['username']; ?>" placeholder="Имя" readonly>
                <?php else : ?>
                    <input type="text" placeholder="Имя">
                <?php endif; ?>
            </div>
            <div class="input-box">
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <input type="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Почта" readonly>
                <?php else : ?>
                    <input type="email" placeholder="Почта">
                <?php endif; ?>
            </div>
            <div class="input-box message-box">
                <textarea placeholder="Введите ваше сообщение"></textarea>
            </div>
            <button class="send_form_btn">Отправить</button>
        </form>
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

    <script src="./js/contacts.bundle.js"></script>
</body>

</html>