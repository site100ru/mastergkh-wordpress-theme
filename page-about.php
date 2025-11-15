<?php
/**
 * Template Name: О нас
 */
get_header();
?>

<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
  <div class="row">
    <nav aria-label="breadcrumb" class="py-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">О нас</li>
      </ol>
    </nav>

    <div class="col-12">
      <h1 class="about-title title-custom"><?php the_title(); ?></h1>
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

  <div class="row">
    <div class="col-12 col-md-4">
      <?php if (have_rows('about_archives')): ?>
        <div class="related-links">
          <ul class="list-group">
            <?php while (have_rows('about_archives')):
              the_row(); ?>
              <li class="list-group-item">
                <a href="<?php the_sub_field('url'); ?>" class="list-group-link">
                  <span><?php the_sub_field('title'); ?></span>
                  <span class="arrow">
                    <span class="arrow-line"></span>
                    <span class="arrow-line"></span>
                  </span>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>

</section>

<?php get_footer(); ?>