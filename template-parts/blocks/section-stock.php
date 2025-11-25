<?php
/**
 * Block Template: Section Stock 
 */

// Создаем id блока (уникальный для каждого вызова)
$id = 'section-stock-' . uniqid();
// Инициализируем переменную класса
$className = '';

// Получаем телефон из страницы настроек
$phone = '';
if (function_exists('get_field')) {
	$phone = get_field('phone', 'option') ?: '+7 (000) 000-00-00';
}

// Преобразуем телефон для ссылки (удаляем все, кроме цифр и +) 
$phone_link = preg_replace('/[^0-9+]/', '', $phone);

// Получаем услуги для отображения на странице
$page_services = get_page_services_for_display();
// Фильтруем только годовые услуги для акции
$annual_services = array_filter($page_services, function($service) {
	return $service['category'] === 'annual';
});
?>

<section id="<?php echo esc_attr($id); ?>" class="section-about-new<?php echo esc_attr($className ?? ''); ?>">
	<div class="container-xl">
		<div class="section-about__header">
			<div class="section-about__header-tel d-flex align-items-center wow animate__fadeInUp" data-wow-duration="1s">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 43 43">
					<path data-name="78standardSed.svg"
						  d="M32 43A32.209 32.209 0 0 1 0 11a7.009 7.009 0 0 1 2.391-5.27l4.853-4.624a3.99 3.99 0 0 1 6.07.66l4.942 6.917a3.985 3.985 0 0 1-.61 5.312l-3.967 3.508A2.266 2.266 0 0 0 13 19c-.01 1.92 1.525 4.7 3.91 7.086s5.15 3.91 7.069 3.91H24a2.292 2.292 0 0 0 1.543-.724l3.467-3.922a4.087 4.087 0 0 1 5.309-.613l6.941 4.959a3.989 3.989 0 0 1 .638 6.056l-4.652 4.883A6.98 6.98 0 0 1 32 43zM10 2a1.986 1.986 0 0 0-1.377.554L3.74 7.206A5.036 5.036 0 0 0 2 11a30.211 30.211 0 0 0 30 30 5.005 5.005 0 0 0 3.765-1.71l4.681-4.913a1.991 1.991 0 0 0-.333-3.035l-6.961-4.973a2.037 2.037 0 0 0-2.649.311L27 30.644A4.255 4.255 0 0 1 24 32h-.02c-2.461 0-5.709-1.721-8.484-4.5s-4.508-6.046-4.5-8.509a4.227 4.227 0 0 1 1.309-2.948l4.012-3.55A2.005 2.005 0 0 0 17 11a1.969 1.969 0 0 0-.37-1.152l-4.957-6.941A2.021 2.021 0 0 0 10 2z"
						  fill-rule="evenodd"></path>
				</svg>

				<p>Аварийная служба</p>

				<a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($phone); ?></a>
			</div>
		</div>
		<div class="section-about__body d-flex flex-column flex-lg-row wow animate__fadeInUp" data-wow-duration="1.5s">
			<div class="col col-sm-12 col-lg-6 col-xxl-4">
				<div class="d-flex flex-column section-about__body-inner section-about__body-inner-new">
					<h2 class="mb-0">Акция 1 + 1 = 3</h2>

					<h3 class="text-center text-lg-start">
						Выбери 2 услуги на годовое обслуживание, получи третью <span>бесплатно!</span>
					</h3>

					<p class="mb-3 mb-lg-0">Срок действия акции ограничен!</p>

					<!-- Блок цены для десктопа -->
					<div class="text-price d-none d-lg-block" id="price-block-desktop">
						<p>Стоимость выбранных услуг:</p>

						<p class="price">0 р</p>
						<button type="button" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#contactModalPrice" disabled>
							Заключить договор
						</button>
					</div>
				</div>
			</div>

			<div class="col col-sm-12 col-lg-6 col-xxl-4 d-flex gap-4 pe-4">
				<?php if (!empty($annual_services)): ?>
				<div class="page-services-container" data-price-calculation="yes">
					<div class="row">
						<?php 
						$services_to_show = array_slice($annual_services, 0, 15); 
						foreach ($services_to_show as $index => $service): 
						?>
						<div class="col-12 col-lg-6 mb-3">
							<label class="custom-checkbox">
								<input type="checkbox" 
									   class="page-service-checkbox" 
									   data-service-id="<?php echo esc_attr($service['id']); ?>"
									   data-service-title="<?php echo esc_attr($service['title']); ?>"
									   data-service-price="<?php echo esc_attr($service['price']); ?>"
									   data-service-category="<?php echo esc_attr($service['category']); ?>"
									   value="<?php echo esc_attr($service['title']); ?>"
									   id="page_service_<?php echo esc_attr($service['id']); ?>" />
								<span class="checkbox-text"><?php echo esc_html($service['title']); ?></span>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php else: ?>
				<div class="col-12">
					<p class="text-muted">Услуги не найдены. Настройте услуги в админке.</p>
					<p><small><a href="<?php echo admin_url('edit.php?post_type=services'); ?>">Перейти к управлению услугами</a></small></p>
				</div>
				<?php endif; ?>
			</div>

			<!-- Блок цены для мобильных устройств -->
			<div class="text-price d-block d-lg-none text-center" id="price-block-mobile">
				<p>Стоимость выбранных услуг:</p>

				<p class="price">0 р</p>
				<button type="button" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#contactModalPrice" disabled>
					Заключить договор
				</button>
			</div>

			<div class="d-none d-xxl-block col col-xxl-4">
				<div class="images-new">
					<img src="<?php echo get_template_directory_uri(); ?>/asset/img/men.png" alt="Мужчина" loading="lazy" />
				</div>
			</div>
		</div>
	</div>
</section>