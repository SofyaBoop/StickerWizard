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