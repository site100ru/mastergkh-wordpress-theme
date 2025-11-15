<?php
/**
 * The template for displaying services archive
 *
 * @package ThemeName
 */

get_header();
?>

<!-- Основной контент -->
<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
  <div class="row">
    <!-- Хлебные крошки -->
    <nav aria-label="breadcrumb" class="py-4">
      <ol class="breadcrumb  ms-0">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Услуги</li>
      </ol>
    </nav>

    <div class="col-12">
      <h1 class="about-title title-custom">Услуги</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="content-page content-page-services">
        <?php
        // Получаем контент страницы услуг, если она создана
        $services_page = get_page_by_path('services');
        if ($services_page) {
          echo apply_filters('the_content', $services_page->post_content);
        } else {
          ?>
          <p>
            Наши специалисты всегда рады предложить Вам широкий спектр услуг. В
            нашем штате работают исключительно высококвалифицированные, опытные
            сотрудники, готовые сопровождать и направлять Вас.
          </p>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="row">
    <?php
    // Запрос на получение всех услуг
    $services_query = new WP_Query([
      'post_type' => 'services',
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
    ]);

    if ($services_query->have_posts()): ?>
      <div class="col-12 col-md-4">
        <div class="related-links">
          <ul class="list-group ms-0">
            <?php while ($services_query->have_posts()):
              $services_query->the_post(); ?>
              <li class="list-group-item">
                <a href="<?php the_permalink(); ?>" class="list-group-link">
                  <span><?php the_title(); ?></span>
                  <span class="arrow">
                    <span class="arrow-line"></span>
                    <span class="arrow-line"></span>
                  </span>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
    <?php else: ?>
      <div class="col-12">
        <p>Услуги в настоящее время не добавлены.</p>
      </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php get_footer(); ?>