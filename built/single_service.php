<?php
include("blocks/path.php");
include("./controllers/orders.php");

$service = selectOne('services', ['id' => $_GET['service']]);

$materials = selectAll('materials');
$quantities = selectAll('quantities');

switch ($service['id_service_category_size']) {
    case 1:
        $sizeTable = 'small_size';
        break;
    case 2:
        $sizeTable = 'large_size';
        break;
    case 3:
        $sizeTable = 'standard_size';
        break;
    default:
        $sizeTable = 'small_size';
        break;
}

$sizies = selectAll($sizeTable);
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
    <title>plotter_cutting_sticker_wizard</title>
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
        <dialog id="successful_order_post" class="successful_order_post modal_window" aria-label="Окно выхода">
    <div class="modal_successful_order_post__content modal_content">
        <h4>Поздравляем!</h4>
        <span class="window_text">
            <p>Ваш заказ успешно оформлен!</p>
        </span>
        <button onclick="window.successful_order_post.close();" aria-label="close" class="x_exit"><i class="fa-solid fa-xmark"></i></button>
    </div>
</dialog>
        <dialog  id="modal_general_req" class="modal_general_req modal_window" aria-label="Окно требоавний к макетам">
    <div class="modal_general_req__content modal_content">
        <h4>Общие требоавния</h4>
        <span class="window_text">
            <ul>
                <li>Цветовая модель – CMYK, RGB.</li>
                <li>Цветовой профиль - для CMYK - Coated FOGRA 39, для RGB – Adobe RGB.</li>
                <li>Разрешение макета - 300ppi.</li>
                <li>Масштаб макета – 1:1.</li>
                <li>Один стикер – один файл с указанием в название имя_размер в мм_тираж (name_100x100mm_50st).</li>
                <li>Текста в макете быть не должно, он должен быть векторным объектом.</li>
                <li>Если в макет вставляли растровые готовые изображения, то их необходимо «Встроить». Растровое изображение должно быть разрешением 300ppi.</li>
            </ul>
        </span>
        <button onclick="window.modal_general_req.close();" aria-label="close" class="x_exit"><i class="fa-solid fa-xmark"></i></button>
    </div>
</dialog>
        <section class="section_constructor">
            <div class="section_constructor__left_side">
                <h2 class="h1_topic"><?= $service['service_name']  ?></h2>
                <p><?= $service['service_descryption']  ?></p>
            </div>
            <div class="section_constructor__right_side">
                <div class="constructor__box">
    <div class="constructor__calc_fields">
        <div class="material_field constructor__field">
            <div class="constructor_field__title">
                <h4 id="heading-1-15rem">Тип пленки</h4>
            </div>
            <?php
            if (!empty($materials)) {
                $firstMaterial = array_slice($materials, 0, 1);
                $otherMaterials = array_slice($materials, 1);
                foreach ($firstMaterial as $material) : ?>
                    <div class="constructor_button material_field__value material_field__value--active" data-coefficient="<?= $material['coefficient'] ?>">
                        <p class="material_name" name="material_name"><?= $material['material_name'] ?></p>
                    </div>
                <?php endforeach;
                foreach ($otherMaterials as $material) : ?>
                    <div class="constructor_button material_field__value" data-coefficient="<?= $material['coefficient'] ?>">
                        <p class="material_name" name="material_name"><?= $material['material_name'] ?></p>
                    </div>
            <?php endforeach;
            }
            ?>
        </div>
        <div class="size_field constructor__field">
            <div class="constructor_field__title">
                <h4 id="heading-1-15rem">Размер, см</h4>
            </div>

            <div id="yourSizeBtn" class="constructor_button size_field__value">
                <p>Свой размер</p>
            </div>
            <div class="constructor_field__control size_field__control">
                <input id="input_number_width" class="constructor_button input_number input_number__size" type="number" step="1" min="1" max="115" value="1">
                <span>x</span>
                <input id="input_number_height" class="constructor_button input_number input_number__size" type="number" step="1" min="1" max="115" value="1">
                <div class="hint">мин. - 1, макс. - 150</div>
            </div>
            <?php
            if (!empty($sizies)) {
                $firstSize = array_slice($sizies, 0, 1);
                $otherSize = array_slice($sizies, 1);
                foreach ($firstSize as $size) : ?>
                    <div class="constructor_button size_field__value size_field__value--active fixed_size_btn">
                        <?php if (!empty($size['size_format'])) : ?>
                            <span><?= $size['size_format'] ?>&nbsp;</span>
                        <?php endif; ?>
                        <p><?= $size['size_option'] ?></p>
                    </div>
                <?php endforeach;
                foreach ($otherSize as $size) : ?>
                    <div class="constructor_button size_field__value fixed_size_btn">
                        <?php if (!empty($size['size_format'])) : ?>
                            <span><?= $size['size_format'] ?>&nbsp;</span>
                        <?php endif; ?>
                        <p><?= $size['size_option'] ?></p>
                    </div>
            <?php endforeach;
            }
            ?>
        </div>
        <div class="quantity_field constructor__field">
            <div class="constructor_field__title">
                <h4 id="heading-1-15rem">Тираж, шт</h4>
            </div>

            <div id="yourQuantityBtn" class="quantity_field__value">
                <div class="constructor_button">
                    <p>Свой тираж</p>
                </div>
                <span></span>
                <span></span>
            </div>
            <div class="constructor_field__control quantity_field__control">
                <input id="input_number__quantity" type="number" step="1" min="1" max="50000" value="1" class="constructor_button input_number input_number__quantity">
                <span class="temp_price"></span>
                <span></span>
                <div class="hint">мин. - 1, макс. - 50000</div>
            </div>
            <?php
            if (!empty($quantities)) {
                $firstQuantity = array_slice($quantities, 0, 1);
                $otherQuantity = array_slice($quantities, 1);
                foreach ($firstQuantity as $quantity) : ?>
                    <div class="quantity_field__value quantity_field__value--active fixed_quantity_btn" data-sale="<?= $quantity['sale'] ?>">
                        <div class="constructor_button">
                            <p class="quantity_option" name="quantity_option"><?= $quantity['quantity_option'] ?></p>
                        </div>
                        <span class="temp_price"></span>
                        <span class="quantity_sale">-<?= $quantity['sale'] ?>%</span>
                    </div>
                <?php endforeach;
                foreach ($otherQuantity as $quantity) : ?>
                    <div class="quantity_field__value fixed_quantity_btn" data-sale="<?= $quantity['sale'] ?>">
                        <div class="constructor_button">
                            <p class="quantity_option" name="quantity_option"><?= $quantity['quantity_option'] ?></p>
                        </div>
                        <span class="temp_price"></span>
                        <span class="quantity_sale">-<?= $quantity['sale'] ?>%</span>
                    </div>
            <?php endforeach;
            }
            ?>
        </div>
    </div>
    <form id="constructor-form" enctype="multipart/form-data" method="POST" action="<?= BASE_URL . '/single_service.php?service=' . $service['id']; ?>">
        <div class="constructor__download_field">
            <label for="images" class="drop_container" id="dropcontainer">
                <span class="drop_title">Перетащите файл или нажмите на окно загрузки. Вес одного файла не более - 50Мб.</span>
                <input type="file" accept=".jpg, .jpeg, .png, .psd, .pdf, .tif, .ai" id="input-file" name="image">
            </label>
        </div>
        <div class="inputs_for_post">
            <input name="type" value="<?= $service['service_name'] ?>" type="hidden">
            <input name="material" id="material_input" value="" type="hidden">
            <input name="size" id="size_input" value="" type="hidden">
            <input name="quantity" id="quantity_input" value="" type="hidden">
            <input name="price" id="price_input" value="" type="hidden">
        </div>
        <div class="constructor__info_field">
            <div class="info_field__price">
                <p>Цена:</p>
                <span id="total-price" value=""></span>
            </div>
            <?php if (isset($_SESSION['id'])) : ?>
                <?php if ($_SESSION['admin']) : ?>
                    <button class="btn_add_card">В корзину</button>
                <?php else : ?>
                    <button type="submit" name="btn_add_card" class="btn_add_card">В корзину</button>
                <?php endif; ?>
            <?php else : ?>
                <button class="btn_add_card" onclick="document.location='../req.php'">В корзину</button>
            <?php endif; ?>
        </div>
    </form>
    <div class="constructor__info_field">
        <div class="info_field__links">
            <button class="account_logout_btn" onclick="window.modal_general_req.showModal()">
                <a>Общие требования</a>
            </button>
        </div>
    </div>
</div>



<!-- <div class="constructor_button material_field__value material_field__value--active" value="1">
                <p>Белая матовая</p>
            </div>
            <div class="constructor_button material_field__value">
                <p>Белая с глянцевой ламинацией</p>
            </div>
            <div class="constructor_button material_field__value">
                <p>Прозрачная матовая</p>
            </div>
            <div class="constructor_button material_field__value">
                <p>Прозрачная глянцевая</p>
            </div>
            <div class="constructor_button material_field__value">
                <p>Голографическая</p>
            </div> -->
<!-- <div class="constructor_button size_field__value size_field__value--active fixed_size_btn">
                <p>4x4</p>
            </div>
            <div class="constructor_button size_field__value fixed_size_btn">
                <p>5x5</p>
            </div>
            <div class="constructor_button size_field__value fixed_size_btn">
                <p>6x6</p>
            </div>
            <div class="constructor_button size_field__value fixed_size_btn">
                <p>7x7</p>
            </div>
            <div class="constructor_button size_field__value fixed_size_btn">
                <p>8x8</p>
            </div> -->
<!-- <div class="quantity_field__value quantity_field__value--active fixed_quantity_btn">
                <div class="constructor_button">
                    <p>50</p>
                </div>
                <span class="temp_price"></span>
                <span class="quantity_sale">-16%</span>
            </div>
            <div class="quantity_field__value fixed_quantity_btn">
                <div class="constructor_button">
                    <p>100</p>
                </div>
                <span class="temp_price"></span>
                <span class="quantity_sale">-30%</span>
            </div>
            <div class="quantity_field__value fixed_quantity_btn">
                <div class="constructor_button">
                    <p>200</p>
                </div>
                <span class="temp_price"></span>
                <span class="quantity_sale">-45%</span>
            </div>
            <div class="quantity_field__value fixed_quantity_btn">
                <div class="constructor_button">
                    <p>300</p>
                </div>
                <span class="temp_price"></span>
                <span class="quantity_sale">-60%</span>
            </div>
            <div class="quantity_field__value fixed_quantity_btn">
                <div class="constructor_button">
                    <p>500</p>
                </div>
                <span class="temp_price"></span>
                <span class="quantity_sale">-70%</span>
            </div> -->
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

    <script src="./js/constructor.bundle.js"></script>
</body>

</html>