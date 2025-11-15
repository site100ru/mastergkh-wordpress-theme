<?php
/**
 * Template Name: Контакты
 */

get_header();

// Получаем значения из ACF
$inn = get_field('inn', 'option');
$ep = get_field('ep', 'option');
$phone = get_field('phone', 'option');
$work_hours = get_field('work_hours', 'option');
$address = get_field('address', 'option');
$address_2 = get_field('address_2', 'option');
$email = get_field('email', 'option');

$vk_link = get_field('vk_link', 'option');
$telegram_link = get_field('telegram_link', 'option');
$ok_link = get_field('ok_link', 'option');
$whatsapp_link = get_field('whatsapp_link', 'option');
$viber = get_field('viber_link', 'option');
$rutube_link = get_field('rutube_link', 'option');

?>

<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
  <div class="row">
    <nav aria-label="breadcrumb" class="py-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Контакты</li>
      </ol>
    </nav>
    <div class="col-12">
      <h1 class="title-custom mb-0">Контакты</h1>
    </div>
  </div>

  <div class="row gy-4 content-page mb-5">
    <!-- Левая колонка -->
    <div class="col-lg-4 col-md-6">
      <div class="d-flex flex-column">
        <div class="d-flex align-items-center gap-3">
          <a href="tel:<?php echo preg_replace('/[^\d+]/', '', $phone); ?>"
            class="tel mb-3"><?php echo esc_html($phone); ?></a>

         <?php if (!empty($whatsapp_link)) : ?>
			<a href="<?= esc_url($whatsapp_link); ?>" class="btn mb-3">
				<img src="<?= get_template_directory_uri(); ?>/asset/img/icons/whatsapp.svg" alt="WhatsApp" class="img-fluid" width="40" height="40" />
			</a>
		<?php endif; ?>
			
		<?php if (!empty($telegram_link)) : ?>
			<a href="<?= esc_url($telegram_link); ?>" class="btn mb-3">
				<img src="<?= get_template_directory_uri(); ?>/asset/img/icons/telegram-color.svg" alt="Telegram" class="img-fluid" width="40" height="40" />
			</a>
		<?php endif; ?>
			
		<?php if (!empty($viber)) : ?>
			<a href="<?= esc_url($viber); ?>" class="btn mb-3">
				<img src="<?= get_template_directory_uri(); ?>/asset/img/icons/viber-color.png" alt="Viber" class="img-fluid" width="40" height="40" />
			</a>
		<?php endif; ?>

        </div>

        <p><?php echo esc_html($work_hours); ?></p>
        <p><?php echo esc_html($address); ?></p>

        <a href="mailto:<?php echo antispambot($email); ?>" class="w-auto"><?php echo antispambot($email); ?></a>
		  
		<?php if (!empty($ep)) : ?>
			<p>ИП <?= esc_html($ep) ?></p>
		<?php endif; ?>
		  
		<?php if (!empty($inn)) : ?>
			<p>ИНН: <?= esc_html($inn) ?></p>
		<?php endif; ?>

        <div class="d-flex gap-2 img-wrapper">
          <?php if ($vk_link): ?>
            <a href="<?php echo esc_url($vk_link); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icons/vk-color.svg" alt="Вконтакте"
                width="50" height="50" loading="lazy" />
            </a>
          <?php endif; ?>

          <?php if ($ok_link): ?>
            <a href="<?php echo esc_url($ok_link); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icons/ok.svg" alt="Одноклассники" width="50"
                height="50" loading="lazy" />
            </a>
          <?php endif; ?>

          <?php if ($rutube_link): ?>
            <a href="<?php echo esc_url($rutube_link); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/asset/img/icons/rutube.svg" alt="Rutube" width="50"
                height="50" loading="lazy" />
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Правая колонка -->
    <div class="col-lg-8 col-md-6">
      <div class="ratio ratio-16x9 h-100">
		  <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A239571a9cdc669336d565b8af157721d1ca1e5bc70d85b5ed08ef589c31f7f41&amp;source=constructor" width="100%" height="460" frameborder="0"></iframe>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-8">
      <div class="content-page">
        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            the_content();
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>