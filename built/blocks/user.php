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
            <?php if (isset($_SESSION['id_user'])) : ?>
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
            <div class="message_empty__content message_empty">
                <div class='icon_warning_outline'><i class="fa-solid fa-circle-exclamation"></i></div>
                <div class='message_empty_order'>
                    <p>Заказов еще не создано.</p>
                </div>
            </div>
        </article>
    </div>
</section>