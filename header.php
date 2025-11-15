<?php
// Подключение ACF полей
$phone = get_field('phone', 'options');
$email = get_field('email', 'options');
$address = get_field('address', 'options');
$address_2 = get_field('address_2', 'options');
$work_hours = get_field('work_hours', 'options');
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="<?= get_template_directory_uri(); ?>/asset/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= get_template_directory_uri(); ?>/asset/css/theme.css" rel="stylesheet" />

  <link rel="shortcut icon" type="image/x-icon"
    href="<?= get_template_directory_uri(); ?>/asset/img/ico/email-ico.svg" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="container-xl header">
    <div class="header-top d-flex flex-column flex-lg-row justify-content-between align-items-center">
      <!-- Логотип -->
      <a href="<?= home_url(); ?>"
        class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-lg-start logo-wrapper text-decoration-none">
        <img src="<?= get_template_directory_uri(); ?>/asset/img/logo.webp" alt="Логотип" width="34" height="34" />
        <p class="logo-text">
          <span class="fs-6 fw-semibold">«Мастер ЖКХ»</span>
          Сервисная компания 
        </p>
      </a>

      <!-- Телефон -->
      <?php if ($phone): ?>
        <div class="d-flex align-items-center tel-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43 43" class="d-none d-lg-block">
            <path
              d="M32 43A32.209 32.209 0 0 1 0 11a7.009 7.009 0 0 1 2.391-5.27l4.853-4.624a3.99 3.99 0 0 1 6.07.66l4.942 6.917a3.985 3.985 0 0 1-.61 5.312l-3.967 3.508A2.266 2.266 0 0 0 13 19c-.01 1.92 1.525 4.7 3.91 7.086s5.15 3.91 7.069 3.91H24a2.292 2.292 0 0 0 1.543-.724l3.467-3.922a4.087 4.087 0 0 1 5.309-.613l6.941 4.959a3.989 3.989 0 0 1 .638 6.056l-4.652 4.883A6.98 6.98 0 0 1 32 43zM10 2a1.986 1.986 0 0 0-1.377.554L3.74 7.206A5.036 5.036 0 0 0 2 11a30.211 30.211 0 0 0 30 30 5.005 5.005 0 0 0 3.765-1.71l4.681-4.913a1.991 1.991 0 0 0-.333-3.035l-6.961-4.973a2.037 2.037 0 0 0-2.649.311L27 30.644A4.255 4.255 0 0 1 24 32h-.02c-2.461 0-5.709-1.721-8.484-4.5s-4.508-6.046-4.5-8.509a4.227 4.227 0 0 1 1.309-2.948l4.012-3.55A2.005 2.005 0 0 0 17 11a1.969 1.969 0 0 0-.37-1.152l-4.957-6.941A2.021 2.021 0 0 0 10 2z"
              fill-rule="evenodd"></path>
          </svg>
          <a href="tel:<?= preg_replace('/\D+/', '', $phone); ?>"
            class="text-decoration-none"><?= esc_html($phone); ?></a>
        </div>
      <?php endif; ?>

      <!-- Адрес -->
      <?php if ($address): ?>
        <div class="address-wrapper">
          <address class="m-0"><?= esc_html($address); ?></address>
        </div>
      <?php endif; ?>

      <!-- Кнопка почты -->
      <div class="dropdown">
        <button class="btn btn-header rounded-circle d-none d-lg-block" type="button" data-bs-toggle="dropdown">
          <!-- svg icon -->
          <svg xmlns="http://www.w3.org/2000/svg" width="53" height="38" viewBox="0 0 53 38">
            <path
              d="M52.969 23.346c0 2.32.007 4.641 0 6.961a7.5 7.5 0 0 1-7.347 7.667H10.331a25.805 25.805 0 0 1-4.217-.118 7.362 7.362 0 0 1-5.391-4.209 8.618 8.618 0 0 1-.67-3.6v-17.74c0-1.824-.143-3.714.03-5.534A7.483 7.483 0 0 1 7.626 0c4.689-.013 9.377 0 14.065 0h19.4c1.479 0 2.959-.009 4.439 0a7.478 7.478 0 0 1 7.443 7.42c.065 5.309-.004 10.62-.004 15.926zM51.142 27V8.908c0-.5.006-.995 0-1.492a5.645 5.645 0 0 0-3.385-5.145 11.346 11.346 0 0 0-4.415-.425H9.309c-1.761 0-3.446-.1-5 .956a5.651 5.651 0 0 0-2.426 4.661c-.006.623 0 1.247 0 1.87v18.225c0 2.044-.256 4.239.892 6.042a5.565 5.565 0 0 0 4.657 2.53H45.625a5.6 5.6 0 0 0 5.1-3.414c.699-1.696.417-3.916.417-5.716zm-6.647 2.683l-8.543-6.913c-.918-.742.384-2.039 1.293-1.3l8.543 6.913c.918.742-.388 2.039-1.288 1.303zm-6.3-15.049l-8.962 7.252c-1.114.9-2.24 1.822-3.787 1.182a10.893 10.893 0 0 1-2.352-1.749L7.237 8.488c-.918-.743.384-2.04 1.293-1.3l7.244 5.862 9.016 7.3c.642.519 1.427 1.461 2.279.946a18.986 18.986 0 0 0 1.947-1.575L44.5 7.187c.91-.736 2.21.561 1.293 1.3zM15.78 21.467c.91-.736 2.21.561 1.293 1.3L8.53 29.68c-.91.736-2.21-.561-1.293-1.3z"
              fill-rule="evenodd"></path>
          </svg>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li class="dropdown__content">
            <div class="dropdown__content-list">
              <?php if ($work_hours): ?>
                <p>Время работы <br /><?= esc_html($work_hours); ?></p>
              <?php endif; ?>

              <?php if ($phone): ?>
                <a href="tel:<?= preg_replace('/\D+/', '', $phone); ?>"><?= esc_html($phone); ?></a>
              <?php endif; ?>

              <?php if ($address_2): ?>
                <p><?= esc_html($address_2); ?></p>
              <?php endif; ?>

              <?php if ($email): ?>
                <a href="mailto:<?= antispambot($email); ?>" class="btn btn-sm btn-primary mt-2">Написать нам</a>
              <?php endif; ?>
            </div>
          </li>
        </ul>
      </div>

      <!-- Кнопка бургера -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Меню -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <div class="menu-close" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="true">
          <img src="<?= get_template_directory_uri(); ?>/asset/img/icons/close.svg" alt="Закрыть меню" width="18"
            height="18" loading="lazy" />
        </div>
        <?php
        wp_nav_menu([
          'theme_location' => 'main_menu',
          'container' => false,
          'menu_class' => 'navbar-nav',
          'fallback_cb' => '__return_false',
          'depth' => 2,
          'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'walker' => new WP_Bootstrap_Navwalker(),
        ]);
        ?>

      </div>
    </nav>
  </header>