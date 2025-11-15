<?php
/*
Template Name: Реквизиты
*/
get_header();

$inn = get_field('inn', 'option');
$ep = get_field('ep', 'option');
$kpp = get_field('kpp', 'option');
$address = get_field('address', 'option');
?>

<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
  <div class="row">
    <!-- Хлебные крошки -->
    <nav aria-label="breadcrumb" class="py-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
        <li class="breadcrumb-item"><a href="<?php echo home_url('/about'); ?>">О нас</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
      </ol>
    </nav>

    <div class="col-12">
      <h1 class="title-custom mb-0"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="content-page content-page-requisite mb-5">
        <h3><?php echo get_bloginfo('name'); ?></h3>

        <?php
        if (have_posts()):
          while (have_posts()):
            the_post();
            the_content();
          endwhile;
        endif;
        ?>

        <?php if ($address): ?>
          <div class="row mb-2 mb-md-0">
            <div class="col-12 col-md-3">
              <p>Юридический адрес:</p>
            </div>
            <div class="col-12 col-md-6">
              <p><?php echo esc_html($address); ?></p>
            </div>
          </div>
        <?php endif; ?>

		<?php if ($ep): ?>
          <div class="row mb-2 mb-md-0">
            <div class="col-12 col-md-3">
              <p>ИП</p>
            </div>
            <div class="col-12 col-md-6">
              <p><?php echo esc_html($ep); ?></p>
            </div>
          </div>
        <?php endif; ?>
		  
        <?php if ($inn): ?>
          <div class="row mb-2 mb-md-0">
            <div class="col-12 col-md-3">
              <p>ИНН:</p>
            </div>
            <div class="col-12 col-md-6">
              <p><?php echo esc_html($inn); ?></p>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($kpp): ?>
          <div class="row mb-2 mb-md-0">
            <div class="col-12 col-md-3">
              <p>КПП:</p>
            </div>
            <div class="col-12 col-md-5">
              <p><?php echo esc_html($kpp); ?></p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>