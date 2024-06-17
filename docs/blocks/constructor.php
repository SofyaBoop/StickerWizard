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
                <?php
                list($width, $height) = explode('x', $sizies[0]['size_option']);
                $width = (float)$width;
                $height = (float)$height;
                ?>
                <input id="input_number_width" class="constructor_button input_number input_number__size" type="number" step="1" min="1" max="150" value="<?php echo $width; ?>">
                <span>x</span>
                <input id="input_number_height" class="constructor_button input_number input_number__size" type="number" step="1" min="1" max="150" value="<?php echo $height; ?>">
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