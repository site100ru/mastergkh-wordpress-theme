<?php
/**
 * Block Template: Section Advantages
 */

// Создаем id блока
$id = 'section-advantages-' . $block['id'];
// Добавляем кастомные классы, если они указаны в блоке
if (!empty($block['className'])) {
    $className = ' ' . $block['className'];
}

// Получаем значения полей ACF
$heading = get_field('advantages_heading') ?: 'Почему выбирают нас';
$advantages_list = get_field('advantages_list');
$slider_items = get_field('advantages_slider');

// Если список преимуществ пуст, устанавливаем дефольтные значения
if (empty($advantages_list)) {
    // Создаем массив дефолтных пунктов в формате повторителя ACF
    $default_items = [
        ['item' => 'Опыт работы и квалифицированные специалисты'],
        ['item' => '24/7 поддержка жильцов'],
        ['item' => 'Современные технологии управления ЖК'],
        ['item' => 'Прозрачность и удобная система оплаты'],
        ['item' => 'Полный комплекс услуг (благоустройство, безопасность, ремонт)']
    ];
    $advantages_list = $default_items;
}

// Если элементы слайдера пусты, устанавливаем дефолтные
if (empty($slider_items)) {
    $slider_items = [
        [
            'image' => get_template_directory_uri() . '/img/slider-1.webp',
            'description' => 'Примерное описание'
        ],
        [
            'image' => get_template_directory_uri() . '/img/slider-2.webp',
            'description' => 'Примерное описание'
        ],
        [
            'image' => get_template_directory_uri() . '/img/slider-3.webp',
            'description' => 'Примерное описание'
        ]
    ];
}

// Уникальный ID для карусели
$carousel_id = 'carousel-' . $block['id'];
?>

<section id="<?php echo esc_attr($id); ?>" class="section-advantages wow animate__fadeInUp<?php echo esc_attr($className ?? ''); ?>" data-wow-duration="1.5s">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-6 p-0">
                <div class="content-block h-100">
                    <h2><?php echo esc_html($heading); ?></h2>
                    <ul>
                        <?php if(is_array($advantages_list)) : ?>
                            <?php foreach ($advantages_list as $advantage) : ?>
                                <li><?php echo esc_html($advantage['item']); ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="slider-block h-100">
                    <div id="<?php echo esc_attr($carousel_id); ?>" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                            $i = 0;
                            if(is_array($slider_items)) :
                                foreach ($slider_items as $slide) : 
                                    $active = $i === 0 ? ' active' : '';
                                    $i++;
                            ?>
                                <div class="carousel-item<?php echo $active; ?>">
                                    <img 
                                        src="<?php echo esc_url($slide['image']); ?>" 
                                        class="d-block" 
                                        alt="<?php echo esc_attr($slide['description']); ?>" 
                                    />
                                    <p><?php echo esc_html($slide['description']); ?></p>
                                </div>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- Пагинация (индикаторы) -->
                    <div class="carousel-pagination">
                        <div class="carousel-indicators">
                            <?php 
                            if(is_array($slider_items)) :
                                for ($j = 0; $j < count($slider_items); $j++) : 
                            ?>
                                <button 
                                    type="button" 
                                    data-bs-target="#<?php echo esc_attr($carousel_id); ?>" 
                                    data-bs-slide-to="<?php echo $j; ?>" 
                                    <?php echo $j === 0 ? 'class="active" aria-current="true"' : ''; ?> 
                                    aria-label="Слайд <?php echo $j + 1; ?>"
                                ></button>
                            <?php 
                                endfor;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>