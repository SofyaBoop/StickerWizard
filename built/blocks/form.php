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