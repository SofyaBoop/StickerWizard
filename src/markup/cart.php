<?php
include("blocks/path.php");
include("./controllers/orders.php");

$card_orders = selectAll('card_ordrers', ['id_user' => $_SESSION['id']]);

$total_price = array_sum(array_column($card_orders, 'price'));

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('blocks/head.html')
    <title>cart_sticker_wizard</title>
</head>

<body>
    @@include('blocks/header.php')
    <main>
        @@include('modal_windows/modal_notice_exit.php')
        @@include('modal_windows/modal_successful_order_cart.php')
        <?php
        if (!empty($card_orders)) : ?>
            <section class="cart_section">
                <h3>Моя корзина</h3>
                <div class="cart_section__box">
                    @@include('blocks/cart_table.php')
                    <form class="cart_checkout_section" action="cart.php" method="post">
                        <h4>Сумма заказа</h4>
                        <div class="cart_checkout_section__responsive">
                            <p class="cart_price_title">Итого:</p>
                            <strong>
                                <span id="cart_total_price" class="cart_total_price"><?= $total_price; ?></span>
                                <span>₽</span>
                            </strong>
                        </div>
                        <div class="cart_checkout_section__set_order">
                            <button name="btn_set_order" type="submit" class="btn_set_order">Оформить заказ</button>
                        </div>
                    </form>
                </div>
            </section>
        <?php else : ?>
            <div class="message_empty_card">
                <i class="fa-solid fa-cart-shopping" style="color: #ababab;"></i>
                <h3>Ваша корзина пуста</h3>
            </div>
        <?php endif; ?>
    </main>
    @@include('blocks/footer.php')
    <script src="./js/cart.bundle.js"></script>
    <?php if ($success_card) : ?>
        <script>
            window.onload = function() {
                var modal = document.getElementById('successful_order_cart');
                modal.showModal();
            }
        </script>
    <?php endif; ?>
</body>

</html>