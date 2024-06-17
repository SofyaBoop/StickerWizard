<?php
include("blocks/path.php");
include("./controllers/orders.php");
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
    <title>requirements_sticker_wizard</title>
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
        <div class="empty_div" style="margin-bottom: 4rem;"></div>
        <div class="requirements_section__topic" style="display: flex; justify-content: center;">
            <h2 id="heading-1-26rem">Требования к макетам</h2>
        </div>
        <section class="requirements_section">
    <div class="requirement_block requirement_block__general">
        <div class="general_block__list">
            <h4>Общие требования к макету:</h4>
            <ul>
                <li>Цветовая модель – CMYK, RGB</li>
                <li>Цветовой профиль - для CMYK - Coated FOGRA 39, для RGB – Adobe RGB</li>
                <li>Разрешение макета - 300ppi</li>
                <li>Масштаб макета – 1:1</li>
                <li>Один стикер – один файл с указанием в название имя_размер в мм_тираж (name_100x100mm_50st)</li>
                <li>Текста в макете быть не должно, он должен быть векторным объектом</li>
                <li>Если в макет вставляли растровые готовые изображения, то их необходимо «Встроить». Растровое изображение должно быть разрешением 300ppi.</li>
            </ul>
        </div>
        <div class="general_block__files">
            <div class="general_block__files_formats">
                <h4>Форматы файлов, которые мы принимаем:</h4>
                <div class="formats_list">
                    <img class="image_format" src="./img/file_formats/png/ai.png" />
                    <img class="image_format" src="./img/file_formats/png/eps.png" />
                    <img class="image_format" src="./img/file_formats/png/jpg.png" />
                    <img class="image_format" src="./img/file_formats/png/pdf.png" />
                    <img class="image_format" src="./img/file_formats/png/psd.png" />
                    <img class="image_format" src="./img/file_formats/png/tif.png" />
                </div>
            </div>
            <div class="general_block__files_examples">
                <h4>Примеры макетов для скачивания:</h4>
                <div class="formats_list">
                    <a href="<?php echo BASE_URL . "/img/servive_pictures/assets.ai"; ?>">
                        <img class="image_format" src="./img/file_formats/png/psd.png" alt="Скачать шаблон psd" />
                    </a>
                    <a href="<?php echo BASE_URL . "/img/servive_pictures/assets.ai"; ?>">
                        <img class="image_format" src="./img/file_formats/png/ai.png" alt="Скачать шаблон ai" />
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="requirement_block requirement_block__layers">
        <h4 class="requirement_block__title">Слои</h4>
        <div class="layers_block__info">
            <p>В векторных макетах (AI/EPS/PSD) должно быть два, либо три основных слоя: «PRINT», «REZ», «WHITE».</p>
            <div class="layers_block__info_list">
                <div class="layers_block__info_item">
                    <p class="info_item_title"><strong class="info_item_title__text">Слой "Print"</strong><em class="warning_text">Обязательно</em></p>
                    <p>Содержит все, что относится к дизайну макета.</p>
                </div>
                <div class="layers_block__info_item">
                    <p class="info_item_title"><strong class="info_item_title__text">Слой "REZ"</strong><em class="warning_text">Обязательно</em></p>
                    <p>Контур реза. По этой линии будет вырезаться ваш стикер.
                        Этот элемент должен быть на отдельном слое. Называем слой REZ.
                        Значения цвета делаем отличным от других цветов, либо берем его с этого макета(рекомендуется).</p>
                </div>
                <div class="layers_block__info_item">
                    <p class="info_item_title"><strong class="info_item_title__text">Слой "White"</strong><em class="warning_text">Внимание! Слой используется на всех видах пленки кроме «глянцевой», «матовой» и «с усиленным клеем»</em></p>
                    <p>Слой, где будут печататься белила(белый цвет и подложка), там, где не должны просвечиваться эффекты плёнки.
                        Этот элемент должен быть на отдельном слое. Называем слой White.
                        Значения цвета делаем отличным от других цветов, либо берём его с этого макета(рекомендуется).</p>
                </div>
            </div>
        </div>
        <div class="layers_block__picture">
            <img class="image_layers" src="./img/maket_layers/layers.png" alt="Слои макета" />
        </div>
    </div>
    <div class="requirement_block requirement_block__cutting">
        <h4 class="requirement_block__title">Линии резки</h4>
        <div class="requirement_block__box">
            <div class="cutting_block__info">
                <p>Первый важный момент – линии резки должны быть на отдельном слое. Далее определяемся с формой стикера и деталями (например нужно ли белая обводка) и рисуем её (как умеем) цветом, который не используется в макете (или который просто выделяется). В нашем случае для создании наклейки мы используем наш логотип, а цветом линии резки выбрали циан. Мы сделали два основных вариантов резки стикера:</p>
                <ul>
                    <li>
                        <p>
                            <strong>Стикер с белой обводкой.</strong>
                            Классический и самый простой вариант. Отступ от края изображения должен быть не мене 2 мм. Иначе велика вероятность того что будет смещение и часть стикера просто зарежется.
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Стикер без белой обводки.</strong>
                            Тут нужно вынести/добавить часть изображения за пределы резки, на случай смещения. Важный момент! Если у вашего стикера есть рамка и вы хотите, чтобы наклейка была вырезана по ней, то рамка должна быть не менее 2мм. иначе ее просто зарежет/сместит и результат будет выглядеть не очень опрятно.
                        </p>
                    </li>
                </ul>
            </div>
            <div class="cutting_block__img">
                <img class="image_rez" src="./img/maket_layers/inside_outside_rez.png" alt="Линии реза" />
            </div>
        </div>
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
    <script src="./js/requirements.bundle.js"></script>
</body>

</html>