<?php
/**
 * Block Template: How We Work
 */

// Создаем id блока
$id = 'how-we-work-' . $block['id'];
// Добавляем кастомные классы, если они указаны в блоке
if (!empty($block['className'])) {
    $className = ' ' . $block['className'];
}

// Получаем данные полей ACF
$image = get_field('how_we_work_image');
$section_title = get_field('how_we_work_title') ?: 'Как мы работаем';
$section_subtitle = get_field('how_we_work_subtitle') ?: 'Процесс сотрудничества';

// Получаем шаги процесса
$steps = get_field('work_steps');
$default_steps = [
    ['number' => '1', 'text' => 'Оставляете <br>заявку'],
    ['number' => '2', 'text' => 'Анализируем потребности ЖК'],
    ['number' => '3', 'text' => 'Заключаем договор'],
    ['number' => '4', 'text' => 'Начинаем качественное обслуживание']
];
?>

<section id="<?php echo esc_attr($id); ?>" class="how-we-work<?php echo esc_attr($className ?? ''); ?>">
    <div class="container-xl">
        <div id="how-work" class="row align-items-start wow animate__fadeInUp" data-wow-duration="1.5s">
            <!-- Колонка с изображением (5/12 ширины на ПК) -->
            <div class="col-lg-5 mb-4 mb-lg-0 image-column">
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($section_title); ?>"
                        class="img-fluid" />
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/img/how-we-work.webp" alt="Как мы работаем"
                        class="img-fluid" />
                <?php endif; ?>
            </div>

            <!-- Колонка с текстовым контентом (7/12 ширины на ПК) -->
            <div class="col-lg-7 content-column">
                <!-- Заголовок и подзаголовок -->
                <h2 class="section-title text-lg-start text-center"><?php echo esc_html($section_title); ?></h2>
                <p class="section-subtitle text-lg-start text-center"><?php echo esc_html($section_subtitle); ?></p>

                <!-- Блок с цифрами -->
                <div class="row numbers-block">
                    <?php
                    // Используем шаги из ACF, если они есть, иначе используем шаги по умолчанию
                    $work_steps = $steps ?: $default_steps;
                    $step_count = count($work_steps);

                    for ($i = 0; $i < $step_count; $i++):
                        $step = $work_steps[$i];
                        $number = isset($step['number']) ? $step['number'] : ($i + 1);
                        $text = isset($step['text']) ? $step['text'] : 'Шаг ' . ($i + 1);
                        ?>
                        <div class="col-md-6">
                            <div class="number-item d-flex align-items-center">
                                <div class="number-value d-md-block d-none"><?php echo esc_html($number); ?></div>
                                <div class="number-text"><?php echo wp_kses_post($text); ?></div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Кнопка-призыв -->
                <div class="cta-wrapper text-lg-start text-center">
                    <!-- <button type="button" class="btn btn-primary btn-sm modal-btn mb-3 mb-sm-0" data-bs-toggle="modal"
                        data-bs-target="#contactModalOneTime">
                        Разовый вызов мастера
                    </button> -->

                    <button type="button" class="btn btn-primary btn-sm modal-btn" data-bs-toggle="modal"
                        data-bs-target="#contactModalYear">
                        Заявка на обслуживание
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>