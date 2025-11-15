<?php
/**
 * Шаблон отдельного отзыва (single-reviews.php)
 */

get_header();
?>

<!-- Основной контент -->
<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
    <div class="row">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb" class="py-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
                <li class="breadcrumb-item"><a href="<?php echo home_url('/about/'); ?>">О нас</a></li>
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('reviews'); ?>">Отзывы</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <div class="col-12">
            <h1 class="title-custom mb-5">Отзыв</h1>
        </div>
    </div>

    <div class="content-page single-review">
        <div class="row">
            <?php
            if (have_posts()):
                while (have_posts()):
                    the_post();
                    $photo = get_field('reviews_photo');
                    $fullname = get_field('reviews_fullname');
                    $description = get_field('reviews_description');
                    ?>
                    <div class="col-12 col-md-8 mx-auto">
                        <div class="single-review-content">
                            <div class="review-author mb-4">
                                <?php if ($photo): ?>
                                    <div class="review-author-photo">
                                        <img src="<?php echo esc_url($photo['url']); ?>"
                                            alt="<?php echo esc_attr($photo['alt']); ?>" class="img-fluid" />
                                    </div>
                                <?php endif; ?>
                                <h2 class="review-author-name">
                                    <?php echo esc_html($fullname); ?>
                                </h2>
                            </div>

                            <div class="review-text">
                                <?php echo wp_kses_post($description); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
            else:
                ?>
                <div class="col-12">
                    <p>Отзыв не найден</p>
                    <a href="<?php echo get_post_type_archive_link('reviews'); ?>" class="btn btn-primary">Вернуться к
                        отзывам</a>
                </div>
            <?php endif; ?>

            <div class="faq-navigation mt-5">
                <div class="row">
                    <div class="col-6">
                        <?php previous_post_link('%link', '&laquo; Предыдущий отзыв'); ?>
                    </div>
                    <div class="col-6 text-end">
                        <?php next_post_link('%link', 'Следующий отзыв &raquo;'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>