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