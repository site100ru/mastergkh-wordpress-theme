<?php
/**
 * Block Template: Section About
 */

// Создаем id блока
$id = 'section-about-' . $block['id'];
// Добавляем кастомные классы, если они указаны в блоке
if (!empty($block['className'])) {
  $className = ' ' . $block['className'];
}

// Получаем значения полей ACF
$header_title = get_field('section_about_header_title') ?: 'Профессиональное управление вашим домом';
$header_subtitle = get_field('section_about_header_subtitle') ?: 'чистота, комфорт и безопасность';
$body_text = get_field('section_about_body_text') ?: 'Мы – управляющая компания с [X] лет опыта, обеспечиваем комфортное проживание и качественный сервис для жителей ЖК [название]. Работаем прозрачно, эффективно и всегда на связи с жильцами';

// Получаем телефон из страницы настроек
$phone = '';
if (function_exists('get_field')) {
  $phone = get_field('phone', 'option') ?: '+7 (000) 000-00-00';
}

// Преобразуем телефон для ссылки (удаляем все, кроме цифр и +)
$phone_link = preg_replace('/[^0-9+]/', '', $phone);
?>

<section id="<?php echo esc_attr($id); ?>" class="section-about<?php echo esc_attr($className ?? ''); ?>">
  <div class="container-xl">
    <div class="section-about__header">
      <!-- <div id="section-about__header-tel"
        class="d-flex align-items-center section-about__header-tel wow animate__fadeInUp" data-wow-duration="1s">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43 43">
          <path data-name="78standardSed.svg"
            d="M32 43A32.209 32.209 0 0 1 0 11a7.009 7.009 0 0 1 2.391-5.27l4.853-4.624a3.99 3.99 0 0 1 6.07.66l4.942 6.917a3.985 3.985 0 0 1-.61 5.312l-3.967 3.508A2.266 2.266 0 0 0 13 19c-.01 1.92 1.525 4.7 3.91 7.086s5.15 3.91 7.069 3.91H24a2.292 2.292 0 0 0 1.543-.724l3.467-3.922a4.087 4.087 0 0 1 5.309-.613l6.941 4.959a3.989 3.989 0 0 1 .638 6.056l-4.652 4.883A6.98 6.98 0 0 1 32 43zM10 2a1.986 1.986 0 0 0-1.377.554L3.74 7.206A5.036 5.036 0 0 0 2 11a30.211 30.211 0 0 0 30 30 5.005 5.005 0 0 0 3.765-1.71l4.681-4.913a1.991 1.991 0 0 0-.333-3.035l-6.961-4.973a2.037 2.037 0 0 0-2.649.311L27 30.644A4.255 4.255 0 0 1 24 32h-.02c-2.461 0-5.709-1.721-8.484-4.5s-4.508-6.046-4.5-8.509a4.227 4.227 0 0 1 1.309-2.948l4.012-3.55A2.005 2.005 0 0 0 17 11a1.969 1.969 0 0 0-.37-1.152l-4.957-6.941A2.021 2.021 0 0 0 10 2z"
            fill-rule="evenodd">
          </path>
        </svg>
        <p>Аварийная служба</p>
        <a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($phone); ?></a>
      </div> -->

      <h2 class="section-about__header-title wow animate__fadeInUp" data-wow-duration="1.5s">
        <?php echo esc_html($header_title); ?>
      </h2>

      <h3 class="section-about__header-sibtitle wow animate__fadeInUp" data-wow-duration="1.5s">
        <?php echo esc_html($header_subtitle); ?>
      </h3>
    </div>

    <div class="section-about__body d-flex flex-column flex-lg-row wow animate__fadeInUp" data-wow-duration="2s">
      <div class="d-flex section-about__body-inner">
        <h2>О нас</h2>
        <div class="section-about__body-image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/asset/img/about.webp" alt="Девушка с папкой бумаги" class=""
            loading="lazy" />
        </div>
      </div>

      <div class="section-about__body-text">
        <p>
		  <?php echo wp_kses_post(get_field('section_about_body_text')); ?>
        </p>
		 
        <a href="/about">Подробнее</a>
      </div>
    </div>
  </div>
</section>