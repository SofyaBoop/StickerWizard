<?php
include("../../controllers/services.php");
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
    <title>service_edit_sticker_wizard</title>
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
            <h3>Редактирование услуги</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/services/index.php"; ?>" class="admin_act_btn admin_act_btn__back_to_index">Назад к списку</a>
                <span class="col-1"></span>
            </div>
            <section class="row create_admin_section">
                <div class="edit_service__block_errMsg block_errMsg">
                    <?php include "../../helps/errorInfo.php"; ?>
                </div>
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_service" value="<?= $id_service; ?>">
                    <div class="edit_service_field">
                        <label for="formGroupExampleInput" class="form-label">Название</label>
                        <input name="input_edit_service__name" value="<?= $post['service_name']; ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Название услуги...">
                    </div>
                    <div class="edit_service_field">
                        <select name="service_size" class="form-select mb-2" aria-label="Default select example">
                            <?php foreach ($services_size as $key => $service_size) : ?>
                                <option value="<?= $service_size['id']; ?>"><?= $service_size['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="edit_service_field">
                        <label for="editor" class="form-label">Описание услуги</label>
                        <textarea name="descryption" id="editor" class="form-control" rows="6"><?= $post['service_descryption']; ?></textarea>
                    </div>
                    <div class="input-group mb-3 edit_service_field">
                        <input name="image" type="file" accept=".jpg, .jpeg, .png" class="input_edit_service__image" id="inputGroupFile02">
                    </div>
                    <div class="edit_service_field_check_admin">
                        <?php if (empty($publish) && $publish == 0) : ?>
                            <input name="publish" class="form_check_input" type="checkbox" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Publish
                            </label>
                        <?php else : ?>
                            <input name="publish" class="form_check_input" value="1" type="checkbox" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Publish
                            </label>
                        <?php endif; ?>
                    </div>
                    <div class="edit_service_field">
                        <button name="edit-service" class="edit_service_btn edit_btn" type="submit">Сохранить изменения</button>
                    </div>
                </form>
            </section>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });
    </script>
</body>

</html>