<?php
/**
 * The template for displaying single FAQ
 *
 * @package YourTheme
 */

get_header();

// Получаем данные FAQ
$answer = get_field('faq_answer');
?>

<!-- Основной контент -->
<section class="container-xl main faq wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
    <!-- Хлебные крошки -->
    <nav aria-label="breadcrumb" class="py-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
            <li class="breadcrumb-item"><a href="<?php echo home_url('/about/'); ?>">О нас</a></li>
            <li class="breadcrumb-item"><a href="<?php echo esc_url(get_post_type_archive_link('faqs')); ?>">Вопросы и
                    ответы</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h1 class="about-title title-custom"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="content-page content-page-faq">
                <div class="faq-single-content">
                    <?php echo wp_kses_post($answer); ?>
                </div>

                <div class="faq-navigation mt-5">
                    <div class="row">
                        <div class="col-6">
                            <?php previous_post_link('%link', '&laquo; Предыдущий вопрос'); ?>
                        </div>
                        <div class="col-6 text-end">
                            <?php next_post_link('%link', 'Следующий вопрос &raquo;'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();