<?php
/**
 * The template for displaying FAQ archive
 *
 * 
 */

get_header();
?>

<!-- Основной контент -->
<section class="container-xl main faq wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
    <!-- Хлебные крошки -->
    <nav aria-label="breadcrumb" class="py-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>">Главная</a></li>
            <li class="breadcrumb-item"><a href="<?php echo home_url('/about/'); ?>">О нас</a></li>
            <li class="breadcrumb-item active" aria-current="page">Вопросы и ответы</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h1 class="about-title title-custom"><?php post_type_archive_title(); ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="content-page content-page-faq">
                <h2>Вопрос-ответ</h2>

                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); 
                        $answer = get_field('faq_answer');
                    ?>
                        <h3><?php the_title(); ?></h3>
                        <div><?php echo wp_kses_post($answer); ?></div>
                    <?php endwhile; ?>
                    
                    <div class="pagination">
                        <?php the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        )); ?>
                    </div>
                <?php else : ?>
                    <p>Вопросы пока не добавлены</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();