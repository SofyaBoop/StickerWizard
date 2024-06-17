<table class="cart_order_table" cellspacing="0">
    <thead class="">
        <tr>
            <th class="order_remove">&nbsp;</th>
            <th class="order_thumbmail">&nbsp;</th>
            <th class="order_name">Товар</th>
            <th class="order_quantity">Количество</th>
            <th class="order_subtotal">Подытог</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($card_orders as $key => $card_order) : ?>
            <tr class="order_item">
                <td class="order_remove">
                    <a href="cart.php?delete_id=<?= $card_order['id']; ?>"><i class="fa-solid fa-xmark"></i></a>
                </td>
                <td class="order_thumbmail">
                    <div class="preview_order_in_cart">
                        <div class="qo_preview_item">
                            <img src="<?= BASE_URL . '\img\reviews_avatars\avataka_1.png' ?>">
                        </div>
                    </div>
                </td>
                <td class="order_name" data-title="Товар">
                    <b class="type_order"></b>
                    <dl class="description_order">
                        <div class="description_order__item description_order__type">
                            <dt class="description_order__title description_order__title_material">Тип:</dt>
                            <dd class="description_order__meaning description_order__meaning_material">
                                <span>&nbsp;</span>
                                <p><?= $card_order['order_service_name']; ?></p>
                            </dd>
                        </div>
                        <div class="description_order__item description_order__material">
                            <dt class="description_order__title description_order__title_material">Материал:</dt>
                            <dd class="description_order__meaning description_order__meaning_material">
                                <span>&nbsp;</span>
                                <p><?= $card_order['order_material']; ?></p>
                            </dd>
                        </div>
                        <div class="description_order__item description_order__size">
                            <dt class="description_order__title description_order__title_size">Размер:</dt>
                            <dd class="description_order__meaning description_order__meaning_size">
                                <span>&nbsp;</span>
                                <p><?= $card_order['order_size']; ?> см</p>
                            </dd>
                        </div>
                        <div class="description_order__item description_order__maket">
                            <dt class="description_order__title description_order__title_maket">Макет:</dt>
                            <dd class="description_order__meaning description_order__meaning_maket">
                                <span>&nbsp;</span>
                                <p><?= substr($card_order['file'], strpos($card_order['file'], "_") + 1); ?></p>
                            </dd>
                        </div>
                    </dl>
                </td>
                <td class="order_quantity" data-title="Количество">
                    <div class="order_quantity_block">
                        <input type="number" step="1" value="<?= $card_order['order_quantity']; ?>" class="input_order_quantity" readonly>
                    </div>
                </td>
                <td class="order_subtotal" data-title="Подытог">
                    <span class="order_subtotal__amount">
                        <bdi>
                            <?= $card_order['price']; ?>
                            <span>₽</span>
                        </bdi>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
        <!-- <tr сlass="order_item">
            <td class="order_remove">
                <button>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </td>
            <td class="order_thumbmail">
                <div class="preview_order_in_cart">
                    <div class="qo_preview_item">
                    </div>
                </div>
            </td>
            <td class="order_name" data-title="Товар">
                <b class="type_order"></b>
                <dl class="description_order">
                    <div class="description_order__item description_order__material">
                        <dt class="description_order__title description_order__title_material">Материал:</dt>
                        <dd class="description_order__meaning description_order__meaning_material">
                            <span>&nbsp;</span>
                            <p>Белая виниловая пленка</p>
                        </dd>
                    </div>
                    <div class="description_order__item description_order__size">
                        <dt class="description_order__title description_order__title_size">Размер:</dt>
                        <dd class="description_order__meaning description_order__meaning_size">
                            <span>&nbsp;</span>
                            <p>10х14.8 см</p>
                        </dd>
                    </div>
                    <div class="description_order__item description_order__maket">
                        <dt class="description_order__title description_order__title_maket">Макет:</dt>
                        <dd class="description_order__meaning description_order__meaning_maket">
                            <span>&nbsp;</span>
                            <p>ForgsStickers.psd</p>
                        </dd>
                    </div>
                </dl>
            </td>
            <td class="order_quantity" data-title="Количество">
                <div class="order_quantity_block">
                    <input type="number" step="1" class="input_order_quantity">
                </div>
            </td>
            <td class="order_subtotal" data-title="Подытог">
                <span class="order_subtotal__amount">
                    <bdi>
                        564
                        <span>₽</span>
                    </bdi>
                </span>
            </td>
        </tr> -->
    </tbody>
</table>