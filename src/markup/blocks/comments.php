<?php if (!empty($comments)) : ?>
    <section id="testimonials">
        <?php if (isset($_SESSION['id'])) : ?>
            <div class="testimonial-link-heading">
                <button type="button" class="testimonial_btn_link write_review_btn">Написать отзыв</button>
            </div>
        <?php endif; ?>
        <div class="testimonial-box-container">
            <?php foreach ($comments as $comment) : ?>
                <div class="testimonial-box">
                    <div class="box-top">
                        <div class="profile_review">
                            <div class="profile-img">
                                <img src="../img/reviews_avatars/avataka_1.png" />
                            </div>
                            <div class="name-user">
                                <strong><?= $comment['username']; ?></strong>
                                <span><?= DateTime::createFromFormat('Y-m-d H:i:s', $comment['created'])->format('d.m.Y'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="client-comment">
                        <p><?= $comment['text']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($comments) > 2) : ?>
            <div class="testimonial-link">
                <button id="load_more_btn" type="button" class="testimonial_btn_link load_more_btn">Посмотреть еще отзывы</button>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>