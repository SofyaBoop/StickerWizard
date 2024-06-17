<section class="log_sign_section">
	<div class="form_log_sign">
		<form class="signup" action="req.php" method="post">
			<h3 class="form_log_sign_title" id="signup">Регистрация</h3>
			<div class="signup__block_errMsg block_errMsg">
				<p><?= $errMsg_sign ?></p>
			</div>
			<div class="form-holder">
				<input name="input_sign__name" type="text" class="input_log_sign" value="<?= $sign_name ?>" placeholder="Имя" />
				<input name="input_sign__email" type="email" class="input_log_sign" value="<?= $sign_email ?>" placeholder="Email" />
				<input name="input_sign__password" type="password" class="input_log_sign" placeholder="Пароль" />
			</div>
			<button type="submit" name="signup_btn" class="log_sign_btn sign_btn">Регистрация</button>
		</form>
		<form class="login slide-up" method="post">
			<div class="center">
				<h3 class="form_log_sign_title" id="login">Авторизация</h3>
				<div class="login__block_errMsg block_errMsg">
					<p><?= $errMsg_login ?></p>
				</div>
				<div class="form-holder">
					<input name="input_login__email" type="email" class="input_log_sign" placeholder="Email" />
					<input name="input_login__password" type="password" class="input_log_sign" placeholder="Пароль" />
				</div>
				<button type="submit" name="login_btn" class="log_sign_btn log_btn">Войти</button>
			</div>
		</form>
		</form>
</section>