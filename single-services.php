<?php
/**
 * The template for displaying single service
 *
 * @package YourThemeName
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
                <li class="breadcrumb-item"><a href="<?php echo get_post_type_archive_link('services'); ?>">Услуги</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <div class="col-12">
            <h1 class="about-title title-custom"><?php the_title(); ?></h1>
        </div>
    </div>

    <div class="content-page content-page-service">
        <?php while (have_posts()):
            the_post(); ?>
            <!-- Общий контент из стандартного редактора выводится над услугами -->
            <div class="row mb-4">
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>

            <?php
            // Определяем, какой тип шаблона использовать
            $template_type = get_field('service_template_type');

            if ($template_type == 'multiple'):
                // Шаблон с несколькими услугами
                ?>
                <?php
                // Проверяем, есть ли у нас подуслуги
                $sub_services = get_field('sub_services');
                if ($sub_services):
                    foreach ($sub_services as $service):
                        $service_category = isset($service['details']['category']) ? $service['details']['category'] : 'one_time';
                        $modal_target = $service_category === 'annual' ? '#annualServiceModal' : '#oneTimeServiceModal';
                        ?>
                        <div class="row mb-5 content-page-service-alt">
                            <!-- Колонка с изображением -->
                            <div class="col-12 col-md-4 mb-4 mb-md-0">
                                <?php if (!empty($service['image'])): ?>
                                    <img src="<?php echo esc_url($service['image']); ?>"
                                        alt="<?php echo esc_attr($service['details']['title']); ?>" class="img-fluid rounded">
                                <?php endif; ?>
                            </div>

                            <!-- Колонка с текстом -->
                            <div class="col-12 col-md-8">
                                <h2 class="mb-3 mt-0"><?php echo esc_html($service['details']['title']); ?></h2>

                                <div class="mb-2">
                                    <?php echo $service['details']['description']; ?>
                                </div>

                                <p>Стоимость:</p>

                                <div class="d-flex price">
                                    <p class="fw-semibold text-primary">
                                        <?php echo esc_html($service['details']['price_group']['price']); ?> р.</p>
                                    <?php if (!empty($service['details']['price_group']['old_price'])): ?>
                                        <p class="text-muted text-decoration-line-through">
                                            <?php echo esc_html($service['details']['price_group']['old_price']); ?> р.</p>
                                    <?php endif; ?>
                                </div>

                                <button type="button" class="btn btn-primary service-order-btn" data-bs-toggle="modal"
                                    data-bs-target="<?php echo $modal_target; ?>"
                                    data-service-title="<?php echo esc_attr($service['details']['title']); ?>"
                                    data-service-category="<?php echo esc_attr($service_category); ?>">
                                    Оставить заявку
                                </button>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            <?php else:
                // Шаблон для одной услуги с фото и текстом
                $service_category = get_field('service_category') ?: 'one_time';
                $modal_target = $service_category === 'annual' ? '#annualServiceModal' : '#oneTimeServiceModal';
                ?>
                <div class="row mb-5 content-page-service-single">
                    <div class="col-12 col-md-4 mb-4 mb-lg-0">
                        <?php
                        // Выводим ACF-изображение, если есть, иначе пробуем thumbnail
                        $service_image = get_field('single_service_image');
                        if ($service_image): ?>
                            <img src="<?php echo esc_url($service_image); ?>" alt="<?php the_title(); ?>" class="img-fluid">
                        <?php elseif (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                        <?php endif; ?>
                    </div>

                    <!-- Колонка с текстом -->
                    <div class="col-12 col-md-8">
                        <?php
                        // Получаем данные из группы single_service_details
                        $service_details = get_field('single_service_details');

                        if (!empty($service_details['single_service_subtitle'])): ?>
                            <h2 class="mb-3"><?php echo esc_html($service_details['single_service_subtitle']); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($service_details['single_service_text'])): ?>
                            <div class="service-text mb-4">
                                <?php echo $service_details['single_service_text']; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($service_details['price'])): ?>
                            <p>Стоимость:</p>
                            <div class="d-flex price">
                                <p class="fw-semibold text-primary"><?php echo esc_html($service_details['price']); ?> р.</p>
                            </div>
                        <?php else: ?>
                            <p>Цена не найдена или пустая</p>
                            <p>Значение price: '<?php echo $service_details['price']; ?>'</p>
                        <?php endif; ?>

                        <button type="button" class="btn btn-primary service-order-btn" data-bs-toggle="modal"
                            data-bs-target="<?php echo $modal_target; ?>"
                            data-service-title="<?php echo esc_attr(get_the_title()); ?>"
                            data-service-category="<?php echo esc_attr($service_category); ?>">
                            Оставить заявку
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</section>

<?php
// Подключаем модальные окна только на страницах услуг
get_template_part('template-parts/service-modals');
?>

<?php get_footer(); ?>