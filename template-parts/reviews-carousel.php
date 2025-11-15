<?php
/**
 * Шаблон для отображения карусели отзывов на главной странице
 */

// Получаем отзывы для главной страницы
$args = array(
    'post_type' => 'reviews',
    'posts_per_page' => -1,
);

$reviews_query = new WP_Query($args);
?>

<section class="reviews">
    <div class="container-xl">
        <div class="row">
            <div id="reviews" class="col-lg-6 d-none d-lg-block wow animate__fadeInBottomLeft" data-wow-duration="1s">
                <img src="<?php echo get_template_directory_uri(); ?>/asset/img/reviews.webp" alt="Изображение" class="img-fluid reviews-big" />
                <a href="<?php echo get_post_type_archive_link('reviews'); ?>" class="btn btn-primary reviews-carousel-btn">Все отзывы</a>
            </div>

            <div id="reviews-content-wrapper" class="col-lg-6 col-12 reviews-content-wrapper wow animate__fadeInBottomRight" data-wow-duration="1s">
                <h2 class="reviews-title">Отзывы жильцов</h2>

                <?php if ($reviews_query->have_posts()) : ?>
                <!-- Карусель -->
                <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                        $i = 0;
                        while ($reviews_query->have_posts()) : $reviews_query->the_post();
                            $photo = get_field('reviews_photo');
                            $fullname = get_field('reviews_fullname');
                            $apartment = get_field('reviews_apartment');
                            $description = get_field('reviews_description');
                            $accent = get_field('reviews_accent');
                            $active = ($i == 0) ? 'active' : '';
                        ?>
                            <!-- Слайд -->
                            <div class="carousel-item <?php echo $active; ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="reviews-subtitle">
                                        <?php 
                                        echo esc_html($fullname);
                                        if ($apartment) {
                                        echo ' ' . esc_html($apartment);
                                        }
                                        ?>
                                    </h3>
                                    <div class="reviews-min-wrapper">
                                        <?php if ($photo) : ?>
                                            <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" class="reviews-min" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="d-flex flex-column reviews-content">
                                    <p class="reviews-text">
                                        <?php echo wp_kses_post($description); ?>
                                    </p>
                                    
                                    <?php if ($accent) : ?>
                                    <span class="reviews-subtext"><?php echo esc_html($accent); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php
                            $i++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <?php if ($i > 1) : ?>
                    <!-- Пагинация для карусели -->
                    <div class="carousel-pagination">
                        <div class="carousel-indicators">
                            <?php for($j = 0; $j < $i; $j++) : ?>
                                <button 
                                    type="button" 
                                    data-bs-target="#reviewsCarousel" 
                                    data-bs-slide-to="<?php echo $j; ?>" 
                                    <?php echo ($j == 0) ? 'class="active"' : ''; ?> 
                                    aria-label="Слайд <?php echo $j+1; ?>"
                                ></button>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <a href="<?php echo get_post_type_archive_link('reviews'); ?>" class="btn btn-primary d-block d-lg-none reviews-carousel-btn">Все отзывы</a>
                </div>
                <?php else: ?>
                    <p>Отзывы не найдены</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>