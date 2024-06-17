<?php
include("blocks/path.php");
include("./database/db_func.php");

$services = selectAll('services', ['status' => 1]);
$maxItems = count($services);
$limitedServices = array_slice($services, 0, $maxItems);
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
    <title>services_sticker_wizard</title>
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
        <div class="empty_div" style="margin-bottom: 4rem;"></div>
        <div class="services_section__topic" style="display: flex; justify-content: center;">
            <h2 id="heading-1-26rem">Наши услуги</h2>
        </div>
        <section class="services_section">
    <div class="services_section__box">
    <?php foreach ($limitedServices as $service) : ?>
        <div class="service">
            <button name="service_btn" class="service_btn" onclick="document.location='<?= BASE_URL . '/single_service.php?service=' . $service['id']; ?>'">
                <div class="service_img">
                    <img src="<?= BASE_URL . '\img\servive_pictures\_services_pictures\\' . $service['image']  ?>" alt="<?= $service['service_name']  ?>">
                </div>
                <h4 id="heading-1-1.44rem"><?= $service['service_name']  ?></h4>
            </button>
        </div>
    <?php endforeach; ?>
</div>
</section>
        <div class="reviews_section__topic" style="display: flex; justify-content: center; margin-bottom: 2rem;">
            <h2 id="heading-1-26rem">Отзывы</h2>
        </div>
        <section id="testimonials">
    <div class="testimonial-link-heading">
        <button type="button" class="testimonial_btn_link write_review_btn">Написать отзыв</button>
    </div>
    <div class="testimonial-box-container">
        <div class="testimonial-box">
            <div class="box-top">
                <div class="profile_review">
                    <div class="profile-img">
                        <img src="../img/reviews_avatars/avataka_1.png" />
                    </div>
                    <div class="name-user">
                        <strong>Котито</strong>
                        <span>18 мая 2024</span>
                    </div>
                </div>
            </div>
            <div class="client-comment">
                <p>Ярко, плотно, надёжно, быстро! Слов нет, одни эмоции, а что самое главное, эмоции положительные!</p>
            </div>
        </div>
        <div class="testimonial-box">
            <div class="box-top">
                <div class="profile_review">
                    <div class="profile-img">
                        <img src="../img/reviews_avatars/avataka_2.png" />
                    </div>
                    <div class="name-user">
                        <strong>Александр</strong>
                        <span>17 мая 2024</span>
                    </div>
                </div>
            </div>
            <div class="client-comment">
                <p>Очень все удобно, онлайн превью просто супер! По качеству нареканий нет. Что хотел, то и получил.</p>
            </div>
        </div>
        <div class="testimonial-box">
            <div class="box-top">
                <div class="profile_review">
                    <div class="profile-img">
                        <img src="../img/reviews_avatars/avataka_1.png" />
                    </div>
                    <div class="name-user">
                        <strong>Елена</strong>
                        <span>16 мая 2024</span>
                    </div>
                </div>
            </div>
            <div class="client-comment">
                <p>Отличный сервис, заказ исполнен на отлично, заказывала наклейки со своим логотипом, доставка Сдэк. Наклейки отличного качества, смотрится супер!) Очень рада,что выбрала эту компанию! Советую)</p>
            </div>
        </div>
        <div class="testimonial-box">
            <div class="box-top">
                <div class="profile_review">
                    <div class="profile-img">
                        <img src="../img/reviews_avatars/avataka_2.png" />
                    </div>
                    <div class="name-user">
                        <strong>Олег</strong>
                        <span>15 мая 2024</span>
                    </div>
                </div>
            </div>
            <div class="client-comment">
                <p>Обратились за срочной печатью, ответили оперативно, сразу приняли заказ. Печать выполнили быстрее оговорённого срока,что оказалось очень хорошо. Отпечатали все качественно.</p>
            </div>
        </div>
    </div>
    <div class="testimonial-link">
        <button id="load_more_btn" type="button" class="testimonial_btn_link load_more_btn">Посмотреть еще отзывы</button>
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
    <script src="./js/services.bundle.js"></script>
</body>

</html>