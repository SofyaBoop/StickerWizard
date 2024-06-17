<section class="services_section">
    <div class="services_section__topic section_topic">
        <h2 id="heading-1-26rem">Что мы делаем</h2>
    </div>
    <div class="services_section__box">
    <?php foreach ($limitedServices as $service) : ?>
        <div class="service">
            <button name="service_btn" class="service_btn" onclick="document.location='<?= BASE_URL . '/single_service.php?service=' . $service['id']; ?>'">
                <div class="service_img">
                    <img src="<?= BASE_URL . '\img\servive_pictures\_services_pictures\\' . $service['image']  ?>" alt="<?= $service['service_name']  ?>">
                </div>
                <h4 id="heading-1-1.44rem"><?= $service['service_name']  ?></h4>
            </button>
        </div>
    <?php endforeach; ?>
</div>
    <div class="services_section__block_link">
        <a class="services_section__link" href="../services.php">Все услуги</a>
    </div>
</section>