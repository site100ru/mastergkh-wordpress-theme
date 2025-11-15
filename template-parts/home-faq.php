<?php
/**
 * Template part for displaying FAQs on home page
 *
 * 
 */

// Аргументы для выборки FAQ, отмеченных для главной страницы
$args = array(
    'post_type' => 'faqs',
    'posts_per_page' => 3,
    'meta_query' => array(
        array(
            'key' => 'faq_show_on_home',
            'value' => '1',
            'compare' => '='
        )
    ),
    'meta_key' => 'faq_home_order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC'
);

$faqs_query = new WP_Query($args);
?>

<section class="faq-section">
    <div id="faq-section" class="wow animate__fadeInUp container-xl" data-wow-duration="1s">
        <!-- Заголовок секции -->
        <div class="col-12">
            <h2 class="section-title">Частые вопросы</h2>
        </div>

        <!-- Desktop version (3 columns) -->
        <div class="row d-none d-lg-flex">
            <?php if ($faqs_query->have_posts()) : ?>
                <?php while ($faqs_query->have_posts()) : $faqs_query->the_post(); 
                    $answer = get_field('faq_answer');
                ?>
                    <div class="col-lg-4 mb-4">
                        <div class="faq-item">
                            <h3 class="faq-title">
                                <?php the_title(); ?>
                            </h3>
                            <div class="faq-content">
                                <?php echo wp_kses_post($answer); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="col-12">
                    <p>Вопросы пока не добавлены</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Mobile version (carousel) -->
        <div class="row d-lg-none">
            <div class="col-12">
                <?php if ($faqs_query->have_posts()) : ?>
                    <div id="faqCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $active = true; ?>
                            <?php while ($faqs_query->have_posts()) : $faqs_query->the_post(); 
                                $answer = get_field('faq_answer');
                            ?>
                                <div class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                    <div class="faq-item">
                                        <h3 class="faq-title">
                                            <?php the_title(); ?>
                                        </h3>
                                        <div class="faq-content">
                                            <?php echo wp_kses_post($answer); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $active = false; ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>

                        <div class="carousel-indicators">
                            <?php for ($i = 0; $i < $faqs_query->post_count; $i++) : ?>
                                <button 
                                    type="button" 
                                    data-bs-target="#faqCarousel" 
                                    data-bs-slide-to="<?php echo $i; ?>" 
                                    <?php echo $i == 0 ? 'class="active" aria-current="true"' : ''; ?> 
                                    aria-label="Слайд <?php echo $i + 1; ?>"
                                ></button>
                            <?php endfor; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Вопросы пока не добавлены</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>