<?php
/**
 * Block Template: Галерея (Наши работы)
 */

$gallery = get_field('gallery');
if (!$gallery)
  return;
?>
<div class="wp-block-gallery">

  <div class="row">
    <nav aria-label="breadcrumb" class="py-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
      </ol>
    </nav>

    <div class="col-12">
      <?php if ($title = get_field('gallery_title')): ?>
        <h1 class="jobs-title title-custom"><?php echo esc_html($title); ?></h1>
      <?php endif; ?>
    </div>
  </div>

  <div class="row g-3 is-cropped">
    <?php foreach ($gallery as $item):
      $image = $item['image'];
      if (!$image)
        continue;
      ?>
      <div class="col-6 col-md-4 gallery-item">
        <figure>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Наши работы'); ?>"
            class="img-fluid rounded shadow-sm" />
        </figure>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content bg-dark text-white border-0">
        <div class="modal-body p-0 position-relative">
          <div class="position-absolute top-0 w-100 d-flex justify-content-between z-3">
            <div id="glide-counter" class="opacity-75">
              <p>1 / N</p>
            </div>
            <button id="glide-modal-close" type="button" class="btn-close btn-close-white"
              data-bs-dismiss="modal"></button>
          </div>

          <div id="glide-wrapper" class="w-100"></div>
        </div>
      </div>
    </div>
  </div>
</div>