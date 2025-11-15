<?php
/**
 * Block Template: Section Contact (Services)
 */
$id = 'section-contact-' . $block['id'];
$className = !empty($block['className']) ? ' ' . $block['className'] : '';
$section_title = get_field('section_contact_title') ?: 'Что мы можем предоставить';
$service_cards = get_field('service_cards');
if (!$service_cards) return; // Если карточек нет — не выводим секцию
?>
<section id="<?php echo esc_attr($id); ?>" class="section-contact<?php echo esc_attr($className); ?>">
  <div class="container-xl">
    <h2 id="section-contact-title" class="section-title wow animate__fadeInUp" data-wow-duration="1.8s">
      <?php echo esc_html($section_title); ?>
    </h2>
    <div id="section-contact" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 wow animate__fadeInUp" data-wow-duration="2s">
      <?php foreach ($service_cards as $index => $card): ?>
        <?php
        $image = $card['image'];
        $title = $card['title'] ?: 'Название услуги';
        $text = $card['text'] ?: 'Описание услуги';
        $link = $card['link'] ?: '#'; // Добавляем поле для ссылки со значением по умолчанию
        ?>
        <div class="col">
          <div class="card h-100">
            <div class="card-img-container">
              <?php if ($image): ?>
                <img src="<?php echo esc_url($image['url']); ?>" class="card-img-top" alt="<?php echo esc_attr($title); ?>" />
              <?php endif; ?>
              <a href="<?php echo esc_url($link); ?>" class="btn btn-primary btn-sm wow animate__fadeInUp modal-btn"
                 data-wow-duration="1.2s" data-wow-delay="0.2s">
                Подробнее
              </a>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo esc_html($title); ?></h5>
              <p class="card-text"><?php echo esc_html($text); ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>