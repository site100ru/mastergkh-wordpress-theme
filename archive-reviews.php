<?php
/**
 * Шаблон архива отзывов (archive-reviews.php)
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
                <li class="breadcrumb-item active" aria-current="page">Отзывы</li>
            </ol>
        </nav>

        <div class="col-12">
            <h1 class="title-custom mb-5">Отзывы</h1>
        </div>
    </div>

    <div class="content-page content-page-review">
        <div class="row g-4 g-md-5">
            <?php 
            if (have_posts()) : 
                while (have_posts()) : the_post();
                    $photo = get_field('reviews_photo');
                    $fullname = get_field('reviews_fullname');
                    $description = get_field('reviews_description');
            ?>
                    <!-- Колонка с отзывом -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="h-100">
                            <p>
                                <?php echo wp_kses_post($description); ?>
                            </p>

                            <div class="d-flex align-items-center mt-3">
                                <?php if ($photo) : ?>
                                    <img 
                                        src="<?php echo esc_url($photo['url']); ?>" 
                                        alt="<?php echo esc_attr($photo['alt']); ?>" 
                                        class="img-fluid me-3" 
                                        style="max-width: 80px" 
                                    />
                                <?php endif; ?>
                                <span><?php echo esc_html($fullname); ?></span>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            else:
            ?>
                <div class="col-12">
                    <p>Отзывы не найдены</p>
                </div>
            <?php endif; ?>
        </div>

        <button
            type="button"
            class="btn content-page-review-modal"
            data-bs-toggle="modal"
            data-bs-target="#heroContactModal"
        >
        Заключить договор
        </button>
    </div>
</section>

<?php get_footer(); ?>