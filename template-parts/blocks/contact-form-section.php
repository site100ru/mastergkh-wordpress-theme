<?php
/**
 * Template part for displaying Contact Form section
 *
 */
?>

<section class="contact-form-section">
  <div class="container-xl wow animate__zoomIn" data-wow-duration="2s" >
    <div class="section-about__header-tel d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43 43">
        <path
          d="M32 43A32.209 32.209 0 0 1 0 11a7.009 7.009 0 0 1 2.391-5.27l4.853-4.624a3.99 3.99 0 0 1 6.07.66l4.942 6.917a3.985 3.985 0 0 1-.61 5.312l-3.967 3.508A2.266 2.266 0 0 0 13 19c-.01 1.92 1.525 4.7 3.91 7.086s5.15 3.91 7.069 3.91H24a2.292 2.292 0 0 0 1.543-.724l3.467-3.922a4.087 4.087 0 0 1 5.309-.613l6.941 4.959a3.989 3.989 0 0 1 .638 6.056l-4.652 4.883A6.98 6.98 0 0 1 32 43zM10 2a1.986 1.986 0 0 0-1.377.554L3.74 7.206A5.036 5.036 0 0 0 2 11a30.211 30.211 0 0 0 30 30 5.005 5.005 0 0 0 3.765-1.71l4.681-4.913a1.991 1.991 0 0 0-.333-3.035l-6.961-4.973a2.037 2.037 0 0 0-2.649.311L27 30.644A4.255 4.255 0 0 1 24 32h-.02c-2.461 0-5.709-1.721-8.484-4.5s-4.508-6.046-4.5-8.509a4.227 4.227 0 0 1 1.309-2.948l4.012-3.55A2.005 2.005 0 0 0 17 11a1.969 1.969 0 0 0-.37-1.152l-4.957-6.941A2.021 2.021 0 0 0 10 2z"
          fill-rule="evenodd"></path>
      </svg>

      <p>Аварийная служба</p>
      <?php
      $phone = get_field('phone', 'option');
      if ($phone):
        ?>
        <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
      <?php endif; ?>

    </div>

    <h2 class="w-100 text-start text-center text-lg-start section__title">
      Готовы к комфортной жизни?
    </h2>

    <p class="w-100 text-start text-center text-lg-start section__sibtitle">
      Оставьте заявку и мы свяжемся с вами в течение 10 минут!
    </p>

    <div class="row">
      <div class="col-12">
        <?php echo do_shortcode('[contact-form-7 id="c955e23" title="Контактная форма 2"]'); ?>
      </div>
    </div>
  </div>
</section>

