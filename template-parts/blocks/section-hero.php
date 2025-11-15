<?php
/**
 * Block Template: Section Hero
 */

// Создаем id блока
$id = 'section-hero-' . $block['id'];
// Добавляем кастомные классы, если они указаны в блоке
if (!empty($block['className'])) {
  $className = ' ' . $block['className'];
}

// Получаем значения полей ACF
$subtitle = get_field('section_hero_subtitle') ?: 'Управляющая компания';
$title = get_field('section_hero_title') ?: 'Название';
$custom_title = get_field('section_hero_custom_title') ?: 'комфортное и безопасное жильё';
?>

<section id="<?php echo esc_attr($id); ?>" class="section-hero<?php echo esc_attr($className ?? ''); ?>">
  <div class="container-xl">
    <div class="row">
      <!-- Первая пустая колонка -->
      <div class="col-lg-5 col-xl-6"></div>

      <!-- Вторая колонка с текстом -->
      <div class="col-12 col-lg-7 col-xl-6">
        <div class="content">
          <h2 class="section-hero__sibtitle wow animate__fadeInLeft" data-wow-duration="1s">
            <?php echo esc_html($subtitle); ?>
          </h2>
          <p class="section-hero__title wow animate__fadeIn" data-wow-duration="1s">
            <?php echo esc_html($title); ?>
          </p>
          <p class="section-hero__custom-title wow animate__fadeIn" data-wow-duration="1.5s">
            <?php echo esc_html($custom_title); ?>
          </p>

          <div
            class="d-flex flex-column flex-lg-row align-items-center justify-content-between section-hero__custom-text">
            <div class="section-hero__image-wrapper wow animate__fadeInLeft" data-wow-duration="1s">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46" data-prefix="in9rabgaa">
                <path data-name="21iconka.svg"
                  d="M45.865 45.866a.458.458 0 0 1-.323.134H27.123a.458.458 0 0 1 0-.916h17.312l-8.014-8.015a.458.458 0 0 1 0-.648.459.459 0 0 1 .648 0l8.014 8.014V21.11L23.255 35.751a.456.456 0 0 1-.51 0L.916 21.11v23.325l8.015-8.014a.458.458 0 0 1 .648.648l-8.014 8.015h17.311a.458.458 0 1 1 0 .916H.458A.461.461 0 0 1 0 45.542V20.248a.475.475 0 0 1 .156-.342L22.7.114a.457.457 0 0 1 .6 0l22.542 19.793a.461.461 0 0 1 .155.341v25.293a.456.456 0 0 1-.132.325zM23 1.068L1.208 20.2 23 34.819 44.792 20.2zm0 44.016a.458.458 0 1 1-.458.458.458.458 0 0 1 .458-.458z"
                  fill-rule="evenodd" class="path-ier8ciflx"></path>
              </svg>
            </div>

            <div class="d-flex section-hero__toach">
              <p class="toach">•</p>
              <p class="section-hero__toach-text">
                Здесь Вы можете оставить заявку на гарантийное обслуживание по договору
              </p>
            </div>

            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#contactModal">
              Отправить заявку
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>