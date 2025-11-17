<?php
/**
 * newTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package newTheme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function newtheme_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on newTheme, use a find and replace
	 * to change 'newtheme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('newtheme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'newtheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'newtheme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newtheme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('newtheme_content_width', 640);
}
add_action('after_setup_theme', 'newtheme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function newtheme_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'newtheme'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'newtheme'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'newtheme_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function newtheme_scripts()
{
	wp_enqueue_style('newtheme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('newtheme-style', 'rtl', 'replace');

	wp_enqueue_script('newtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'newtheme_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

























// Скрипт для нормальной работы меню в шапке
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

function my_custom_gutenberg_assets()
{
	// Подключаем CSS Bootstrap только в редакторе Гутенберга
	wp_enqueue_style(
		'bootstrap-gutenberg',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
		false,
		'5.3.0-alpha1',
		'all'
	);

	// Подключаем JS Bootstrap только в редакторе Гутенберга
	wp_enqueue_script(
		'bootstrap-gutenberg',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js',
		array('wp-blocks', 'wp-element', 'wp-editor'),
		'5.3.0-alpha1',
		true
	);

	// Подключаем свои стили
	wp_enqueue_style(
		'my-gutenberg-style',
		get_template_directory_uri() . '/asset/css/theme.css',
		false,
		'1.0.0',
		'all'
	);
}

add_action('enqueue_block_editor_assets', 'my_custom_gutenberg_assets');

// Отдельные записи
function register_custom_post_types()
{
	// Отзывы
	register_post_type('reviews', [
		'label' => 'Отзывы',
		'public' => true,
		'menu_icon' => 'dashicons-format-quote',
		'supports' => ['title', 'thumbnail'],
		'has_archive' => true,
		'rewrite' => ['slug' => 'about/reviews'],
		'show_in_nav_menus' => true,
	]);

	// Вопросы и ответы
	register_post_type('faqs', [
		'label' => 'Вопросы и ответы',
		'public' => true,
		'menu_icon' => 'dashicons-editor-help',
		'supports' => ['title', 'thumbnail'],
		'has_archive' => true,
		'rewrite' => ['slug' => 'about/faqs'],
		'show_in_nav_menus' => true,
	]);

	register_post_type('services', [
		'label' => 'Услуги',
		'public' => true,
		'menu_icon' => 'dashicons-hammer',
		'supports' => ['title', 'editor', 'thumbnail'],
		'has_archive' => true,
		'rewrite' => ['slug' => 'services'],
		'show_in_nav_menus' => true,
	]);
}
add_action('init', 'register_custom_post_types');

// Регистарция меню
function register_my_menus()
{
	register_nav_menus([
		'main_menu' => 'Главное меню',
	]);
}
add_action('after_setup_theme', 'register_my_menus');



add_filter('block_categories_all', function ($categories, $post) {
	return array_merge($categories, [['slug' => 'custom-blocks', 'title' => 'Мои блоки', 'icon' => null],]);
}, 1, 2);

// Регистрация кастомных блоков acf
add_action('acf/init', function () {
	if (function_exists('acf_register_block_type')) {
		// Section Hero Block
		acf_register_block_type([
			'name' => 'section-hero',
			'title' => 'Секция Hero',
			'description' => 'Главная секция с приветствием',
			'render_template' => get_template_directory() . '/template-parts/blocks/section-hero.php',
			'category' => 'custom-blocks',
			'icon' => 'align-full-width',
			'keywords' => ['hero', 'главная', 'приветствие'],
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
		]);

		// Section About Block
		acf_register_block_type([
			'name' => 'section-about',
			'title' => 'О нас',
			'description' => 'Секция "О нас"',
			'render_template' => get_template_directory() . '/template-parts/blocks/section-about.php',
			'category' => 'custom-blocks',
			'icon' => 'info',
			'keywords' => ['о нас', 'about', 'информация'],
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
		]);

		// Section Advantages Block
		acf_register_block_type([
			'name' => 'section-advantages',
			'title' => 'Преимущества',
			'description' => 'Секция "Преимущества"',
			'render_template' => get_template_directory() . '/template-parts/blocks/section-advantages.php',
			'category' => 'custom-blocks',
			'icon' => 'star-filled',
			'keywords' => ['преимущества', 'почему мы'],
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
		]);

		// Section Contact Block
		acf_register_block_type([
			'name' => 'section-contact',
			'title' => 'Наши услуги',
			'description' => 'Секция "Услуги"',
			'render_template' => get_template_directory() . '/template-parts/blocks/section-contact.php',
			'category' => 'custom-blocks',
			'icon' => 'grid-view',
			'keywords' => ['услуги', 'предложения', 'карточки'],
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
		]);

		// How We Work Block
		acf_register_block_type([
			'name' => 'how-we-work',
			'title' => 'Как мы работаем',
			'description' => 'Секция "Как мы работаем"',
			'render_template' => get_template_directory() . '/template-parts/blocks/how-we-work.php',
			'category' => 'custom-blocks',
			'icon' => 'admin-users',
			'keywords' => ['работа', 'процесс'],
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
		]);

		// Section Gallery
		acf_register_block_type([
			'name' => 'gallery-block',
			'title' => 'Галерея',
			'description' => 'Блок с галереей работ',
			'render_template' => get_template_directory() . '/template-parts/blocks/gallery-block.php',
			'category' => 'custom-blocks',
			'icon' => 'format-gallery',
			'mode' => 'preview',
			'supports' => [
				'align' => false,
				'mode' => true,
			],
			'enqueue_assets' => function () {
				// Glide CSS
				wp_enqueue_style(
					'glide-css',
					'https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css',
					[],
					null
				);

				// Glide JS
				wp_enqueue_script(
					'glide-js',
					'https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js',
					[],
					null,
					true
				);

				wp_enqueue_script(
					'custom-gallery-js',
					get_template_directory_uri() . '/asset/js/gallery.js',
					['glide-js'],
					null,
					true
				);

				wp_localize_script('custom-gallery-js', 'galleryBlockVars', [
					'themeUrl' => get_template_directory_uri(),
				]);
			},
		]);
	}
});


function render_faq_block_shortcode()
{
	ob_start();

	$args = [
		'post_type' => 'faqs',
		'posts_per_page' => 3,
		'meta_query' => [
			[
				'key' => 'faq_show_on_home',
				'value' => '1',
				'compare' => '='
			]
		],
		'meta_key' => 'faq_home_order',
		'orderby' => 'meta_value_num',
		'order' => 'ASC'
	];

	$faqs_query = new WP_Query($args);
	$faqs = [];
	if ($faqs_query->have_posts()):
		while ($faqs_query->have_posts()):
			$faqs_query->the_post();
			$faqs[] = [
				'title' => get_the_title(),
				'answer' => get_field('faq_answer')
			];
		endwhile;
		wp_reset_postdata();
	endif;
	?>

	<section class="faq-section">
		<div id="faq-section" class="wow animate__fadeInUp container-xl" data-wow-duration="1s">
			<div class="col-12">
				<h2 class="section-title">Частые вопросы</h2>
			</div>

			<div class="row d-none d-lg-flex">
				<?php if (!empty($faqs)): ?>
					<?php foreach ($faqs as $faq): ?>
						<div class="col-lg-4 mb-4">
							<div class="faq-item">
								<h3 class="faq-title"><?= esc_html($faq['title']) ?></h3>
								<div class="faq-content"><?= wp_kses_post($faq['answer']) ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12">
						<p>Вопросы пока не добавлены</p>
					</div>
				<?php endif; ?>
			</div>

			<div class="row d-lg-none">
				<div class="col-12">
					<?php if (!empty($faqs)): ?>
						<div id="faqCarousel" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<?php foreach ($faqs as $i => $faq): ?>
									<div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
										<div class="faq-item">
											<h3 class="faq-title"><?= esc_html($faq['title']) ?></h3>
											<div class="faq-content"><?= wp_kses_post($faq['answer']) ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="carousel-indicators">
								<?php foreach ($faqs as $i => $_): ?>
									<button type="button" data-bs-target="#faqCarousel" data-bs-slide-to="<?= $i ?>"
										class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>"
										aria-label="Слайд <?= $i + 1 ?>"></button>
								<?php endforeach; ?>
							</div>
						</div>
					<?php else: ?>
						<p>Вопросы пока не добавлены</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php
	return ob_get_clean();
}
add_shortcode('faq_block', 'render_faq_block_shortcode');



function reviews_carousel_shortcode()
{
	ob_start();

	$args = [
		'post_type' => 'reviews',
		'posts_per_page' => -1
	];

	$query = new WP_Query($args);
	$reviews = [];

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$reviews[] = [
				'photo' => get_field('reviews_photo'),
				'fullname' => get_field('reviews_fullname'),
				'apartment' => get_field('reviews_apartment'),
				'description' => get_field('reviews_description'),
				'accent' => get_field('reviews_accent'),
			];
		}
		wp_reset_postdata();
	}

	// Подключаем шаблон
	include get_template_directory() . '/template-parts/reviews-carousel.php';

	return ob_get_clean();
}
add_shortcode('reviews_carousel', 'reviews_carousel_shortcode');


function render_custom_contact_form_section()
{
	ob_start();
	?>
	<section class="contact-form-section">
		<div class="container-xl wow animate__zoomIn" data-wow-duration="2s">
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
	<?php
	return ob_get_clean();
}
add_shortcode('custom_contact_form', 'render_custom_contact_form_section');


// Подключение скриптов
function theme_enqueue_scripts()
{
	// Bootstrap
	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/asset/js/bootstrap.bundle.min.js', [], null, true);

	// jQuery (уже встроен в WordPress, можно использовать 'jquery')
	wp_enqueue_script('jquery-custom', get_template_directory_uri() . '/asset/js/jquery-1.5.1.min.js', [], null, true);

	// WOW.js
	wp_enqueue_script('wow', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', [], null, true);

	// Custom JS
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/asset/js/index.js', [], null, true);

	// Init WOW.js
	wp_add_inline_script('wow', "
    document.addEventListener('DOMContentLoaded', function() {
      function isMobile() {
        return window.innerWidth < 768;
      }

      function initWowAnimations() {
        var wow = new WOW({
          boxClass: 'wow',
          animateClass: 'animated',
          offset: 100,
          mobile: false,
          live: true
        });
        wow.init();
      }

      initWowAnimations();
    });
  ");

	if (is_front_page()) {
		wp_enqueue_script('home-js', get_template_directory_uri() . '/asset/js/home.js', [], null, true);
	}

}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');














/**
 * Функция для получения услуг для форм с категориями
 */
function get_services_for_forms($form_type = 'feedback')
{
	$services = array(
		'one_time' => array(),
		'annual' => array()
	);

	// Получаем все посты типа 'services'
	$posts = get_posts(array(
		'post_type' => 'services',
		'post_status' => 'publish',
		'numberposts' => -1
	));

	foreach ($posts as $post) {
		$template_type = get_field('service_template_type', $post->ID);

		if ($template_type === 'single') {
			// Одиночная услуга - проверяем чекбоксы для показа в формах
			$show_in_form = $form_type === 'feedback' ?
				get_field('show_in_feedback_form', $post->ID) :
				get_field('show_in_page_form', $post->ID);

			if ($show_in_form) {
				$category = get_field('service_category', $post->ID) ?: 'one_time';
				$services[$category][] = array(
					'id' => $post->ID,
					'title' => $post->post_title,
					'type' => 'single',
					'category' => $category
				);
			}
		} elseif ($template_type === 'multiple') {
			// Множественные подуслуги
			$sub_services = get_field('sub_services', $post->ID);
			if ($sub_services) {
				foreach ($sub_services as $sub_service) {
					$show_in_form = $form_type === 'feedback' ?
						$sub_service['details']['show_in_feedback_form'] :
						$sub_service['details']['show_in_page_form'];

					if ($show_in_form) {
						$category = $sub_service['details']['category'] ?: 'one_time';
						$services[$category][] = array(
							'id' => $post->ID . '_' . sanitize_title($sub_service['details']['title']),
							'title' => $sub_service['details']['title'],
							'type' => 'sub_service',
							'parent_id' => $post->ID,
							'parent_title' => $post->post_title,
							'category' => $category
						);
					}
				}
			}
		}
	}

	return $services;
}

/**
 * Генерация чекбоксов для Contact Form 7 с категориями
 */
add_filter('wpcf7_form_elements', function ($content) {
	// Заменяем плейсхолдер на реальные чекбоксы
	if (strpos($content, '[dynamic_services_checkboxes') !== false) {
		$services = get_services_for_forms('feedback');
		$checkboxes_html = '';

		// Проверяем наличие услуг в каждой категории
		$has_one_time = !empty($services['one_time']);
		$has_annual = !empty($services['annual']);

		if ($has_one_time || $has_annual) {
			// Добавляем выбор категории услуг
			$checkboxes_html .= '<div class="service-category-selector mb-3">';
			$checkboxes_html .= '<label class="form-label">Тип услуг <span class="text-danger">*</span></label>';

			if ($has_one_time) {
				$checkboxes_html .= '<div class="form-check">';
				$checkboxes_html .= '<input class="form-check-input service-category-toggle" type="checkbox" name="service_categories[]" value="one_time" id="category_one_time" data-category="one_time">';
				$checkboxes_html .= '<label class="form-check-label" for="category_one_time">Разовые услуги</label>';
				$checkboxes_html .= '</div>';
			}

			if ($has_annual) {
				$checkboxes_html .= '<div class="form-check">';
				$checkboxes_html .= '<input class="form-check-input service-category-toggle" type="checkbox" name="service_categories[]" value="annual" id="category_annual" data-category="annual">';
				$checkboxes_html .= '<label class="form-check-label" for="category_annual">Услуги</label>';
				$checkboxes_html .= '</div>';
			}

			$checkboxes_html .= '</div>';

			// Разовые услуги
			if ($has_one_time) {
				$checkboxes_html .= '<div class="services-group" id="one_time_services" style="display: none;">';
				$checkboxes_html .= '<h6 class="mb-3">Разовые услуги:</h6>';
				foreach ($services['one_time'] as $service) {
					$checkboxes_html .= '<div class="form-check">';
					$checkboxes_html .= '<input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="' . esc_attr($service['title']) . '" id="service_' . esc_attr($service['id']) . '" data-category="one_time">';
					$checkboxes_html .= '<label class="form-check-label" for="service_' . esc_attr($service['id']) . '">';
					$checkboxes_html .= esc_html($service['title']);
					$checkboxes_html .= '</label>';
					$checkboxes_html .= '</div>';
				}
				$checkboxes_html .= '</div>';
			}

			// Услуги
			if ($has_annual) {
				$checkboxes_html .= '<div class="services-group" id="annual_services" style="display: none;">';
				$checkboxes_html .= '<h6 class="mb-3">Услуги:</h6>';
				foreach ($services['annual'] as $service) {
					$checkboxes_html .= '<div class="form-check">';
					$checkboxes_html .= '<input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="' . esc_attr($service['title']) . '" id="service_' . esc_attr($service['id']) . '" data-category="annual">';
					$checkboxes_html .= '<label class="form-check-label" for="service_' . esc_attr($service['id']) . '">';
					$checkboxes_html .= esc_html($service['title']);
					$checkboxes_html .= '</label>';
					$checkboxes_html .= '</div>';
				}
				$checkboxes_html .= '</div>';
			}
		} else {
			$checkboxes_html = '<p>Услуги не найдены. <a href="' . admin_url('edit.php?post_type=services') . '">Добавить услуги</a></p>';
		}

		// Заменяем шорткод на HTML
		$content = preg_replace('/\[dynamic_services_checkboxes[^\]]*\]/', $checkboxes_html, $content);
	}

	return $content;
});

/**
 * JavaScript для управления выпадающими списками (ИСПРАВЛЕНО)
 */
add_action('wp_footer', function () {
	if (is_singular('services')) {
		return; // Выходим из функции
	}
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			// Функция для инициализации выпадающего списка
			function initServiceDropdown(config) {

				const dropdownToggle = document.getElementById(config.toggleId);
				const dropdownContent = document.getElementById(config.contentId);
				const selectedDisplay = document.getElementById(config.displayId);
				const selectedList = document.getElementById(config.listId);

				if (!dropdownToggle) {
					return;
				}


				// Получаем чекбоксы только внутри этого конкретного контейнера
				const container = dropdownToggle.closest('.services-dropdown-container');
				const serviceCheckboxes = container ? container.querySelectorAll('input[type="checkbox"][name="services[]"]') : [];


				const dropdownText = dropdownToggle.querySelector('.dropdown-text');
				const dropdownIcon = dropdownToggle.querySelector('.dropdown-icon');

				let isDropdownOpen = false;

				// Функция переключения выпадающего списка
				function toggleDropdown() {
					isDropdownOpen = !isDropdownOpen;

					if (isDropdownOpen) {
						dropdownContent.style.display = 'block';
						dropdownContent.classList.add('show');
						dropdownIcon.querySelector('img').style.transform = 'rotate(180deg)';
						dropdownToggle.classList.add('active');
					} else {
						dropdownContent.style.display = 'none';
						dropdownContent.classList.remove('show');
						dropdownIcon.querySelector('img').style.transform = 'rotate(0deg)';
						dropdownToggle.classList.remove('active');
						// Автоматически обновляем отображение при закрытии
						updateSelectedDisplay();
					}
				}

				// Функция обновления отображения выбранных услуг
				function updateSelectedDisplay() {
					const selectedServices = Array.from(serviceCheckboxes)
						.filter(checkbox => checkbox.checked)
						.map(checkbox => {
							const label = checkbox.nextElementSibling;
							return label ? label.textContent.trim() : checkbox.value;
						});

					if (selectedServices.length > 0) {
						selectedDisplay.style.display = 'block';
						selectedList.innerHTML = '';

						selectedServices.forEach(serviceName => {
							const serviceTag = document.createElement('span');
							serviceTag.className = 'service-tag ' + config.tagClass;
							serviceTag.textContent = serviceName;
							selectedList.appendChild(serviceTag);
						});

						dropdownText.textContent = `Выбрано услуг: ${selectedServices.length}`;
					} else {
						selectedDisplay.style.display = 'none';
						dropdownText.textContent = config.defaultText;
					}
				}

				// Обработчик клика по кнопке
				dropdownToggle.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					toggleDropdown();
				});

				// Обработчики для чекбоксов и лейблов
				serviceCheckboxes.forEach((checkbox, index) => {

					// Обработчик изменения чекбокса
					checkbox.addEventListener('change', function (e) {
						e.stopPropagation();

						const selectedCount = Array.from(serviceCheckboxes).filter(cb => cb.checked).length;
						if (selectedCount > 0) {
							dropdownText.textContent = `Выбрано услуг: ${selectedCount}`;
						} else {
							dropdownText.textContent = config.defaultText;
						}

						updateSelectedDisplay();
					});

					// Обработчик клика по лейблу
					const label = checkbox.nextElementSibling;
					if (label && label.tagName === 'LABEL') {
						label.addEventListener('click', function (e) {
							e.preventDefault();
							e.stopPropagation();

							// Переключаем состояние чекбокса
							checkbox.checked = !checkbox.checked;

							// Вручную запускаем событие change
							const changeEvent = new Event('change', { bubbles: true });
							checkbox.dispatchEvent(changeEvent);
						});
					}

					// Предотвращаем всплытие событий от контейнера чекбокса
					const checkContainer = checkbox.closest('.service-option');
					if (checkContainer) {
						checkContainer.addEventListener('click', function (e) {
							e.stopPropagation();
						});
					}
				});

				// Закрытие при клике вне области
				document.addEventListener('click', function (e) {
					if (container && !container.contains(e.target) && isDropdownOpen) {
						toggleDropdown();
					}
				});

				// Предотвращаем закрытие при клике внутри контента
				if (dropdownContent) {
					dropdownContent.addEventListener('click', function (e) {
						e.stopPropagation();
					});
				}

				// Инициализация
				updateSelectedDisplay();
			}

			// Небольшая задержка для загрузки всех элементов
			setTimeout(() => {
				// Инициализация для разовых услуг
				initServiceDropdown({
					toggleId: 'servicesDropdownToggle',
					contentId: 'servicesDropdownContent',
					displayId: 'selectedServicesDisplay',
					listId: 'selectedServicesList',
					defaultText: 'Выберите услуги',
					tagClass: 'one-time-tag'
				});

				// Инициализация для годовых услуг
				initServiceDropdown({
					toggleId: 'annualServicesDropdownToggle',
					contentId: 'annualServicesDropdownContent',
					displayId: 'selectedAnnualServicesDisplay',
					listId: 'selectedAnnualServicesList',
					defaultText: 'Выберите услуги',
					tagClass: 'annual-tag'
				});
			}, 100);

			// Валидация форм
			const forms = document.querySelectorAll('.wpcf7-form');
			forms.forEach(form => {
				form.addEventListener('submit', function (e) {
					const allCheckboxes = form.querySelectorAll('input[name="services[]"]');
					const selectedServices = Array.from(allCheckboxes).filter(checkbox => checkbox.checked);

					if (selectedServices.length === 0) {
						e.preventDefault();
						return false;
					}

					// Проверка для универсальной формы
					const categoryToggles = form.querySelectorAll('.service-category-toggle');
					if (categoryToggles.length > 0) {
						const selectedCategories = Array.from(categoryToggles).filter(toggle => toggle.checked);
						if (selectedCategories.length === 0) {
							e.preventDefault();
							return false;
						}
					}
				});
			});
		});
	</script>
	<?php
});

/**
 * Обработка отправки формы для сохранения выбранных услуг и категорий
 */
add_action('wpcf7_before_send_mail', function ($contact_form) {
	$submission = WPCF7_Submission::get_instance();
	if ($submission) {
		$posted_data = $submission->get_posted_data();

		// Обрабатываем выбранные категории услуг
		$categories_list = '';
		if (isset($posted_data['service_categories']) && is_array($posted_data['service_categories'])) {
			$category_names = array_map(function ($cat) {
				return $cat === 'one_time' ? 'Разовые услуги' : 'Услуги';
			}, $posted_data['service_categories']);
			$categories_list = implode(', ', $category_names);
		}

		// Обрабатываем выбранные услуги
		$services_list = '';
		if (isset($posted_data['services']) && is_array($posted_data['services'])) {
			$services_list = implode(', ', $posted_data['services']);
		}

		// Заменяем плейсхолдеры в шаблоне письма
		$mail = $contact_form->prop('mail');
		$mail['body'] = str_replace('[service_categories]', $categories_list, $mail['body']);
		$mail['body'] = str_replace('[services]', $services_list, $mail['body']);
		$contact_form->set_properties(array('mail' => $mail));
	}
});

























/**
 * Функция для получения только разовых услуг (ИСПРАВЛЕНО: используем feedback форму)
 */
function get_one_time_services_for_forms($form_type = 'feedback')
{
	$services = array();

	// Получаем все посты типа 'services'
	$posts = get_posts(array(
		'post_type' => 'services',
		'post_status' => 'publish',
		'numberposts' => -1
	));

	// Отладка - логируем количество найденных постов
	error_log('Total services posts found: ' . count($posts));

	foreach ($posts as $post) {
		$template_type = get_field('service_template_type', $post->ID);
		error_log('Post ID: ' . $post->ID . ', Title: ' . $post->post_title . ', Template type: ' . $template_type);

		if ($template_type === 'single') {
			// Одиночная услуга - проверяем категорию и чекбоксы для показа в формах
			$category = get_field('service_category', $post->ID);
			$show_in_feedback = get_field('show_in_feedback_form', $post->ID);

			error_log('Single service - Category: ' . $category . ', Feedback: ' . ($show_in_feedback ? 'yes' : 'no'));

			if ($category === 'one_time' && $show_in_feedback) {
				$services[] = array(
					'id' => $post->ID,
					'title' => $post->post_title,
					'type' => 'single',
					'category' => 'one_time'
				);
				error_log('Added single service: ' . $post->post_title);
			}
		} elseif ($template_type === 'multiple') {
			// Множественные подуслуги - только разовые с отмеченной галочкой "форма обратной связи"
			$sub_services = get_field('sub_services', $post->ID);
			error_log('Multiple service - Sub services count: ' . (is_array($sub_services) ? count($sub_services) : 'none'));

			if ($sub_services) {
				foreach ($sub_services as $index => $sub_service) {
					$category = isset($sub_service['details']['category']) ? $sub_service['details']['category'] : 'one_time';
					$show_in_feedback = isset($sub_service['details']['show_in_feedback_form']) ? $sub_service['details']['show_in_feedback_form'] : false;

					error_log('Sub service ' . $index . ' - Category: ' . $category . ', Feedback: ' . ($show_in_feedback ? 'yes' : 'no'));

					if ($category === 'one_time' && $show_in_feedback) {
						$services[] = array(
							'id' => $post->ID . '_' . sanitize_title($sub_service['details']['title']),
							'title' => $sub_service['details']['title'],
							'type' => 'sub_service',
							'parent_id' => $post->ID,
							'parent_title' => $post->post_title,
							'category' => 'one_time'
						);
						error_log('Added sub service: ' . $sub_service['details']['title']);
					}
				}
			}
		}
	}

	error_log('Total one-time services found: ' . count($services));
	return $services;
}

/**
 * Генерация чекбоксов для формы разовых услуг 
 */
add_filter('wpcf7_form_elements', function ($content) {
	// Заменяем плейсхолдер для разовых услуг
	if (strpos($content, '[one_time_services_checkboxes') !== false) {
		// Генерируем уникальный ID для каждой формы
		static $form_counter = 0;
		$form_counter++;
		$unique_id = 'form_' . $form_counter;

		$services = get_one_time_services_for_forms('feedback');
		$checkboxes_html = '';

		if (!empty($services)) {
			// Скрытое поле с типом услуг (всегда разовые)
			$checkboxes_html .= '<input type="hidden" name="service_categories[]" value="one_time">';

			// Кнопка для раскрытия списка услуг с уникальным ID
			$checkboxes_html .= '<div class="services-dropdown-container" data-form-id="' . $unique_id . '">';
			$checkboxes_html .= '<button type="button" class="services-dropdown-toggle btn btn-outline-primary w-100 text-start" data-target="servicesDropdownContent_' . $unique_id . '">';
			$checkboxes_html .= '<span class="dropdown-text">Выберите услуги</span>';
			$checkboxes_html .= '<span class="dropdown-icon"><img src="/wp-content/themes/newtheme/asset/img/arrow-bottom.svg" alt=""></span>';
			$checkboxes_html .= '</button>';

			// Контейнер с услугами (изначально скрыт) с уникальным ID
			$checkboxes_html .= '<div class="services-dropdown-content" id="servicesDropdownContent_' . $unique_id . '" style="display: none;">';
			$checkboxes_html .= '<div class="services-list">';

			foreach ($services as $service) {
				$checkbox_id = 'service_' . $unique_id . '_' . $service['id'];
				$checkboxes_html .= '<div class="form-check service-option">';
				$checkboxes_html .= '<input class="form-check-input service-checkbox" type="checkbox" name="services[]" value="' . esc_attr($service['title']) . '" id="' . $checkbox_id . '">';
				$checkboxes_html .= '<label class="form-check-label" for="' . $checkbox_id . '">';
				$checkboxes_html .= esc_html($service['title']);
				$checkboxes_html .= '</label>';
				$checkboxes_html .= '</div>';
			}

			$checkboxes_html .= '</div>';
			$checkboxes_html .= '</div>';
			$checkboxes_html .= '</div>';

			// Контейнер для отображения выбранных услуг с уникальным ID
			$checkboxes_html .= '<div class="selected-services-display" id="selectedServicesDisplay_' . $unique_id . '" style="display: none;">';
			$checkboxes_html .= '<h6>Выбранные услуги:</h6>';
			$checkboxes_html .= '<div class="selected-services-list" id="selectedServicesList_' . $unique_id . '"></div>';
			$checkboxes_html .= '</div>';

		} else {
			$checkboxes_html = '<div class="alert alert-warning">';
			$checkboxes_html .= '<p>Разовые услуги не найдены.</p>';
			$checkboxes_html .= '<small>Проверьте:</small>';
			$checkboxes_html .= '<ul>';
			$checkboxes_html .= '<li>Есть ли услуги с категорией "Разовая услуга"</li>';
			$checkboxes_html .= '<li>Отмечена ли галочка "Выводить в форме обратной связи"</li>';
			$checkboxes_html .= '<li><a href="' . admin_url('edit.php?post_type=services') . '">Перейти к управлению услугами</a></li>';
			$checkboxes_html .= '</ul>';
			$checkboxes_html .= '</div>';
		}

		// Заменяем шорткод на HTML
		$content = preg_replace('/\[one_time_services_checkboxes[^\]]*\]/', $checkboxes_html, $content);
	}

	return $content;
});






/**
 * Функция для получения только годовых услуг 
 */
function get_annual_services_for_forms($form_type = 'feedback')
{
	$services = array();

	// Получаем все посты типа 'services'
	$posts = get_posts(array(
		'post_type' => 'services',
		'post_status' => 'publish',
		'numberposts' => -1
	));

	foreach ($posts as $post) {
		$template_type = get_field('service_template_type', $post->ID);

		if ($template_type === 'single') {
			// Одиночная услуга - проверяем категорию и чекбоксы для показа в формах
			$category = get_field('service_category', $post->ID);
			$show_in_feedback = get_field('show_in_feedback_form', $post->ID);

			if ($category === 'annual' && $show_in_feedback) {
				$services[] = array(
					'id' => $post->ID,
					'title' => $post->post_title,
					'type' => 'single',
					'category' => 'annual'
				);
			}
		} elseif ($template_type === 'multiple') {
			// Множественные подуслуги - только годовые с отмеченной галочкой "форма обратной связи"
			$sub_services = get_field('sub_services', $post->ID);
			if ($sub_services) {
				foreach ($sub_services as $sub_service) {
					$category = isset($sub_service['details']['category']) ? $sub_service['details']['category'] : 'one_time';
					$show_in_feedback = isset($sub_service['details']['show_in_feedback_form']) ? $sub_service['details']['show_in_feedback_form'] : false;

					if ($category === 'annual' && $show_in_feedback) {
						$services[] = array(
							'id' => $post->ID . '_' . sanitize_title($sub_service['details']['title']),
							'title' => $sub_service['details']['title'],
							'type' => 'sub_service',
							'parent_id' => $post->ID,
							'parent_title' => $post->post_title,
							'category' => 'annual'
						);
					}
				}
			}
		}
	}

	return $services;
}

/**
 * Генерация чекбоксов для формы годовых услуг 
 */
add_filter('wpcf7_form_elements', function ($content) {
	// Заменяем плейсхолдер для годовых услуг
	if (strpos($content, '[annual_services_checkboxes') !== false) {
		// Генерируем уникальный ID для каждой формы
		static $annual_form_counter = 0;
		$annual_form_counter++;
		$unique_id = 'annual_form_' . $annual_form_counter;

		$services = get_annual_services_for_forms('feedback');
		$checkboxes_html = '';

		if (!empty($services)) {
			// Скрытое поле с типом услуг (всегда годовые)
			$checkboxes_html .= '<input type="hidden" name="service_categories[]" value="annual">';

			// Кнопка для раскрытия списка услуг с другими цветами для годовых
			$checkboxes_html .= '<div class="services-dropdown-container annual-services" data-form-id="' . $unique_id . '">';
			$checkboxes_html .= '<button type="button" class="services-dropdown-toggle btn btn-outline-success w-100 text-start" data-target="annualServicesDropdownContent_' . $unique_id . '">';
			$checkboxes_html .= '<span class="dropdown-text">Выберите услуги</span>';
			$checkboxes_html .= '<span class="dropdown-icon"><img src="/wp-content/themes/newtheme/asset/img/arrow-bottom.svg" alt=""></span>';
			$checkboxes_html .= '</button>';

			// Контейнер с услугами (изначально скрыт)
			$checkboxes_html .= '<div class="services-dropdown-content annual-content" id="annualServicesDropdownContent_' . $unique_id . '" style="display: none;">';
			$checkboxes_html .= '<div class="services-list">';

			foreach ($services as $service) {
				$checkbox_id = 'annual_service_' . $unique_id . '_' . $service['id'];
				$checkboxes_html .= '<div class="form-check service-option">';
				$checkboxes_html .= '<input class="form-check-input annual-service-checkbox" type="checkbox" name="services[]" value="' . esc_attr($service['title']) . '" id="' . $checkbox_id . '">';
				$checkboxes_html .= '<label class="form-check-label" for="' . $checkbox_id . '">';
				$checkboxes_html .= esc_html($service['title']);
				$checkboxes_html .= '</label>';
				$checkboxes_html .= '</div>';
			}

			$checkboxes_html .= '</div>';
			$checkboxes_html .= '</div>';
			$checkboxes_html .= '</div>';

			// Контейнер для отображения выбранных услуг
			$checkboxes_html .= '<div class="selected-services-display annual-selected" id="selectedAnnualServicesDisplay_' . $unique_id . '" style="display: none;">';
			$checkboxes_html .= '<h6>Выбранные услуги:</h6>';
			$checkboxes_html .= '<div class="selected-services-list" id="selectedAnnualServicesList_' . $unique_id . '"></div>';
			$checkboxes_html .= '</div>';

		} else {
			$checkboxes_html = '<div class="alert alert-warning">';
			$checkboxes_html .= '<p>Услуги не найдены.</p>';
			$checkboxes_html .= '<small>Проверьте:</small>';
			$checkboxes_html .= '<ul>';
			$checkboxes_html .= '<li>Есть ли услуги с категорией "Годовая услуга"</li>';
			$checkboxes_html .= '<li>Отмечена ли галочка "Выводить в форме обратной связи"</li>';
			$checkboxes_html .= '<li><a href="' . admin_url('edit.php?post_type=services') . '">Перейти к управлению услугами</a></li>';
			$checkboxes_html .= '</ul>';
			$checkboxes_html .= '</div>';
		}

		// Заменяем шорткод на HTML
		$content = preg_replace('/\[annual_services_checkboxes[^\]]*\]/', $checkboxes_html, $content);
	}

	return $content;
});

/**
 * JavaScript для управления выпадающими списками (разовые и годовые услуги)
 */
add_action('wp_footer', function () {
	if (is_singular('services')) {
		return; // Выходим из функции
	}
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {

			// Функция для инициализации одного выпадающего списка
			function initSingleDropdown(container) {
				const formId = container.getAttribute('data-form-id');
				const dropdownToggle = container.querySelector('.services-dropdown-toggle');
				const dropdownTarget = dropdownToggle.getAttribute('data-target');
				const dropdownContent = document.getElementById(dropdownTarget);

				if (!dropdownToggle || !dropdownContent) {
					return;
				}


				const dropdownText = dropdownToggle.querySelector('.dropdown-text');
				const dropdownIcon = dropdownToggle.querySelector('.dropdown-icon');
				const serviceCheckboxes = container.querySelectorAll('input[type="checkbox"][name="services[]"]');

				// Элементы для отображения выбранных услуг
				const selectedDisplay = container.querySelector('.selected-services-display');
				const selectedList = container.querySelector('.selected-services-list');

				let isDropdownOpen = false;

				// Функция переключения выпадающего списка
				function toggleDropdown() {
					isDropdownOpen = !isDropdownOpen;

					if (isDropdownOpen) {
						dropdownContent.style.display = 'block';
						dropdownContent.classList.add('show');
						if (dropdownIcon && dropdownIcon.querySelector('img')) {
							dropdownIcon.querySelector('img').style.transform = 'rotate(180deg)';
						}
						dropdownToggle.classList.add('active');
					} else {
						dropdownContent.style.display = 'none';
						dropdownContent.classList.remove('show');
						if (dropdownIcon && dropdownIcon.querySelector('img')) {
							dropdownIcon.querySelector('img').style.transform = 'rotate(0deg)';
						}
						dropdownToggle.classList.remove('active');
						updateSelectedDisplay();
					}
				}

				// Функция обновления отображения выбранных услуг
				function updateSelectedDisplay() {
					const selectedServices = Array.from(serviceCheckboxes)
						.filter(checkbox => checkbox.checked)
						.map(checkbox => {
							const label = checkbox.nextElementSibling;
							return label ? label.textContent.trim() : checkbox.value;
						});

					if (selectedServices.length > 0) {
						if (selectedDisplay) selectedDisplay.style.display = 'block';
						if (selectedList) {
							selectedList.innerHTML = '';
							selectedServices.forEach(serviceName => {
								const serviceTag = document.createElement('span');
								serviceTag.className = 'service-tag';
								// Добавляем разные классы для разных типов услуг
								if (container.classList.contains('annual-services')) {
									serviceTag.classList.add('annual-tag');
								} else {
									serviceTag.classList.add('one-time-tag');
								}
								serviceTag.textContent = serviceName;
								selectedList.appendChild(serviceTag);
							});
						}
						dropdownText.textContent = `Выбрано услуг: ${selectedServices.length}`;
					} else {
						if (selectedDisplay) selectedDisplay.style.display = 'none';
						if (container.classList.contains('annual-services')) {
							dropdownText.textContent = 'Выберите услуги';
						} else {
							dropdownText.textContent = 'Выберите услуги';
						}
					}
				}

				// Обработчик клика по кнопке
				dropdownToggle.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					toggleDropdown();
				});

				// Обработчики для чекбоксов
				serviceCheckboxes.forEach((checkbox, index) => {

					// Обработчик изменения чекбокса
					checkbox.addEventListener('change', function (e) {
						e.stopPropagation();

						const selectedCount = Array.from(serviceCheckboxes).filter(cb => cb.checked).length;
						if (selectedCount > 0) {
							dropdownText.textContent = `Выбрано услуг: ${selectedCount}`;
						} else {
							if (container.classList.contains('annual-services')) {
								dropdownText.textContent = 'Выберите услуги';
							} else {
								dropdownText.textContent = 'Выберите услуги';
							}
						}
						updateSelectedDisplay();
					});

					// Обработчик клика по лейблу
					const label = checkbox.nextElementSibling;
					if (label && label.tagName === 'LABEL') {
						label.addEventListener('click', function (e) {
							e.preventDefault();
							e.stopPropagation();

							checkbox.checked = !checkbox.checked;
							const changeEvent = new Event('change', { bubbles: true });
							checkbox.dispatchEvent(changeEvent);
						});
					}

					// Предотвращаем всплытие событий от контейнера чекбокса
					const checkContainer = checkbox.closest('.service-option');
					if (checkContainer) {
						checkContainer.addEventListener('click', function (e) {
							e.stopPropagation();
						});
					}
				});

				// Закрытие при клике вне области
				document.addEventListener('click', function (e) {
					if (!container.contains(e.target) && isDropdownOpen) {
						toggleDropdown();
					}
				});

				// Предотвращаем закрытие при клике внутри контента
				dropdownContent.addEventListener('click', function (e) {
					e.stopPropagation();
				});

				// Инициализация
				updateSelectedDisplay();
			}

			// Инициализация всех форм на странице
			function initAllDropdowns() {
				// Находим все контейнеры с выпадающими списками
				const allContainers = document.querySelectorAll('.services-dropdown-container[data-form-id]');

				allContainers.forEach((container, index) => {
					initSingleDropdown(container);
				});
			}

			// Запускаем инициализацию с небольшой задержкой
			setTimeout(initAllDropdowns, 100);

			// Валидация форм (общая для всех типов)
			const forms = document.querySelectorAll('.wpcf7-form');
			forms.forEach((form, formIndex) => {
				form.addEventListener('submit', function (e) {

					const allCheckboxes = form.querySelectorAll('input[name="services[]"]');
					const selectedServices = Array.from(allCheckboxes).filter(checkbox => checkbox.checked);

					if (selectedServices.length === 0) {
						e.preventDefault();
						return false;
					}

					// Проверка для универсальной формы
					const categoryToggles = form.querySelectorAll('.service-category-toggle');
					if (categoryToggles.length > 0) {
						const selectedCategories = Array.from(categoryToggles).filter(toggle => toggle.checked);
						if (selectedCategories.length === 0) {
							e.preventDefault();
							return false;
						}
					}

				});
			});

			// Функция для переинициализации после AJAX загрузки (если нужно)
			window.reinitServiceDropdowns = function () {
				setTimeout(initAllDropdowns, 100);
			};
		});
	</script>
	<?php
});



function section_stock_shortcode($atts)
{
	ob_start();
	include get_template_directory() . '/template-parts/blocks/section-stock.php';
	return ob_get_clean();
}
add_shortcode('section_stock', 'section_stock_shortcode');













/**
 * Функция для получения услуг для показа на странице (в блоках)
 */
function get_page_services_for_display()
{
	$services = array();

	// Получаем все посты типа 'services'
	$posts = get_posts(array(
		'post_type' => 'services',
		'post_status' => 'publish',
		'numberposts' => -1
	));

	foreach ($posts as $post) {
		$template_type = get_field('service_template_type', $post->ID);

		if ($template_type === 'single') {
			// Одиночная услуга - проверяем галочку "Выводить в форме на странице"
			$show_in_page = get_field('show_in_page_form', $post->ID);
			$category = get_field('service_category', $post->ID);

			if ($show_in_page) {
				$price_field = get_field('single_service_details', $post->ID);
				$price = isset($price_field['price']) ? intval($price_field['price']) : 5000;

				$services[] = array(
					'id' => $post->ID,
					'title' => $post->post_title,
					'type' => 'single',
					'category' => $category ?: 'one_time',
					'price' => $price
				);
			}
		} elseif ($template_type === 'multiple') {
			// Множественные подуслуги - только те, что отмечены для показа на странице
			$sub_services = get_field('sub_services', $post->ID);
			if ($sub_services) {
				foreach ($sub_services as $sub_service) {
					$show_in_page = isset($sub_service['details']['show_in_page_form']) ? $sub_service['details']['show_in_page_form'] : false;

					if ($show_in_page) {
						$category = isset($sub_service['details']['category']) ? $sub_service['details']['category'] : 'one_time';
						$price_group = isset($sub_service['details']['price_group']) ? $sub_service['details']['price_group'] : array();
						$price = isset($price_group['price']) ? intval($price_group['price']) : 5000;

						$services[] = array(
							'id' => $post->ID . '_' . sanitize_title($sub_service['details']['title']),
							'title' => $sub_service['details']['title'],
							'type' => 'sub_service',
							'parent_id' => $post->ID,
							'parent_title' => $post->post_title,
							'category' => $category,
							'price' => $price
						);
					}
				}
			}
		}
	}

	return $services;
}

/**
 * Шорткод для отображения чекбоксов услуг на странице
 */
function page_services_checkboxes_shortcode($atts)
{
	$atts = shortcode_atts(array(
		'category' => 'all', // all, one_time, annual
		'layout' => 'grid', // grid, list
		'price_calculation' => 'yes' // yes, no
	), $atts);

	$services = get_page_services_for_display();

	// Фильтруем по категории если указана
	if ($atts['category'] !== 'all') {
		$services = array_filter($services, function ($service) use ($atts) {
			return $service['category'] === $atts['category'];
		});
	}

	if (empty($services)) {
		return '<p>Услуги для отображения не найдены.</p>';
	}

	ob_start();
	?>
	<div class="page-services-container" data-price-calculation="<?php echo esc_attr($atts['price_calculation']); ?>">
		<?php if ($atts['layout'] === 'grid'): ?>
			<div class="row">
				<?php foreach ($services as $index => $service): ?>
					<div class="col-6 mb-3">
						<label class="custom-checkbox">
							<input type="checkbox" class="page-service-checkbox" data-service-id="<?php echo esc_attr($service['id']); ?>"
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
		<?php else: ?>
			<div class="services-list">
				<?php foreach ($services as $service): ?>
					<div class="form-check mb-2">
						<input type="checkbox" class="form-check-input page-service-checkbox"
							data-service-id="<?php echo esc_attr($service['id']); ?>"
							data-service-title="<?php echo esc_attr($service['title']); ?>"
							data-service-price="<?php echo esc_attr($service['price']); ?>"
							data-service-category="<?php echo esc_attr($service['category']); ?>"
							value="<?php echo esc_attr($service['title']); ?>" id="page_service_<?php echo esc_attr($service['id']); ?>" />
						<label class="form-check-label" for="page_service_<?php echo esc_attr($service['id']); ?>">
							<?php echo esc_html($service['title']); ?>
							<?php if ($atts['price_calculation'] === 'yes'): ?>
								<span class="service-price">(<?php echo number_format($service['price'], 0, '', ' '); ?> р.)</span>
							<?php endif; ?>
						</label>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode('page_services_checkboxes', 'page_services_checkboxes_shortcode');

/**
 * JavaScript для управления выбором услуг на странице и расчета стоимости 
 */
add_action('wp_footer', function () {
	if (is_singular('services')) {
		return; // Выходим из функции
	}
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// ИСПРАВЛЕННАЯ функция расчета стоимости по принципу 1+1=3
			function calculatePrice(selectedCount, basePrice = 5000) {
				if (selectedCount === 0) return 0;

				// Универсальная формула: каждые 3 услуги стоят как 2
				const fullGroups = Math.floor(selectedCount / 3);  // Полные группы по 3
				const remainder = selectedCount % 3;               // Остаток

				return (fullGroups * 2 + remainder) * basePrice;
			}

			// Обновление цены и управление формой
			function updatePriceAndForm() {
				const checkboxes = document.querySelectorAll('.page-service-checkbox');
				const selectedServices = Array.from(checkboxes).filter(cb => cb.checked);

				// Находим ВСЕ элементы цены (и для мобильной, и для десктопной версии)
				const priceElements = document.querySelectorAll('.price');
				// Находим ВСЕ кнопки модального окна
				const submitButtons = document.querySelectorAll('[data-bs-target="#contactModalPrice"]');

				// Расчет стоимости
				const totalPrice = calculatePrice(selectedServices.length);

				// Обновляем отображение цены во ВСЕХ элементах
				priceElements.forEach(priceElement => {
					if (priceElement) {
						priceElement.textContent = totalPrice.toLocaleString('ru-RU') + ' р';
					}
				});

				// Активируем/деактивируем ВСЕ кнопки
				submitButtons.forEach(submitButton => {
					if (submitButton) {
						if (selectedServices.length > 0) {
							submitButton.disabled = false;
							submitButton.classList.remove('disabled');
						} else {
							submitButton.disabled = true;
							submitButton.classList.add('disabled');
						}
					}
				});

				// Сохраняем выбранные услуги для передачи в модальное окно
				window.selectedPageServices = selectedServices.map(cb => ({
					id: cb.dataset.serviceId,
					title: cb.dataset.serviceTitle,
					price: parseInt(cb.dataset.servicePrice),
					category: cb.dataset.serviceCategory
				}));

				window.selectedPageServicesTotal = totalPrice;
			}

			// Добавляем обработчики для всех чекбоксов услуг на странице
			const pageCheckboxes = document.querySelectorAll('.page-service-checkbox');
			pageCheckboxes.forEach(checkbox => {
				checkbox.addEventListener('change', updatePriceAndForm);
			});

			// Инициализация
			updatePriceAndForm();

			// Обработчик открытия модального окна для ВСЕХ кнопок
			const modalTriggers = document.querySelectorAll('[data-bs-target="#contactModalPrice"]');
			modalTriggers.forEach(modalTrigger => {
				modalTrigger.addEventListener('click', function (e) {
					if (window.selectedPageServices && window.selectedPageServices.length > 0) {
						// Передаем данные в модальное окно
						setTimeout(() => {
							populateModalWithServices();
						}, 100);
					} else {
						e.preventDefault();
						return false;
					}
				});
			});
		});

		// Функция заполнения модального окна выбранными услугами
		function populateModalWithServices() {
			if (!window.selectedPageServices) return;

			// Ищем контейнер для услуг в модальном окне
			const modalServicesContainer = document.querySelector('#contactModalPrice .services-display');
			if (!modalServicesContainer) {
				// Создаем контейнер если его нет
				const modalBody = document.querySelector('#contactModalPrice .modal-body');
				if (modalBody) {
					const servicesHTML = `
					<div class="services-display mb-3">
						<label class="form-label">Выбранные услуги:</label>
						<div class="selected-services-list" id="modalServicesList"></div>
						<div class="promotion-hint mb-2">
							<small class="text-muted">🎉 Действует акция: каждая 3-я услуга бесплатно!</small>
						</div>
					</div>
				`;

					// Вставляем перед последним элементом (кнопками)
					const lastElement = modalBody.querySelector('.mb-3:last-child');
					if (lastElement) {
						lastElement.insertAdjacentHTML('beforebegin', servicesHTML);
					} else {
						modalBody.insertAdjacentHTML('afterbegin', servicesHTML);
					}
				}
			}

			// Заполняем список услуг
			const servicesList = document.querySelector('#modalServicesList');
			if (servicesList) {
				servicesList.innerHTML = '';
				window.selectedPageServices.forEach((service, index) => {
					const serviceElement = document.createElement('div');
					serviceElement.className = 'service-item mb-1';

					// Определяем, какие услуги бесплатные (каждая 3-я)
					const isFreeDueToPromotion = (index + 1) % 3 === 0;

					serviceElement.innerHTML = `
					<span class="service-name">
						${service.title}
					</span>
					<input type="hidden" name="selected_services[]" value="${service.title}">
				`;
					servicesList.appendChild(serviceElement);
				});
			}

			// Обновляем общую стоимость
			const totalPriceElement = document.querySelector('#modalTotalPrice');
			if (totalPriceElement) {
				totalPriceElement.textContent = window.selectedPageServicesTotal.toLocaleString('ru-RU') + ' р';
			}
		}

		// Функция для добавления анимации обновления цены
		window.animatePriceUpdate = function () {
			const priceElements = document.querySelectorAll('.price');
			priceElements.forEach(priceElement => {
				if (priceElement) {
					priceElement.classList.add('price-updated');
					setTimeout(() => {
						priceElement.classList.remove('price-updated');
					}, 500);
				}
			});
		};

		// Дополнительные функции для работы с модальным окном
		document.addEventListener('DOMContentLoaded', function () {
			// Обработчик события показа модального окна
			const contactModal = document.getElementById('contactModalPrice');
			if (contactModal) {
				contactModal.addEventListener('shown.bs.modal', function () {
					// Фокус на первое поле при открытии модального окна
					const firstInput = contactModal.querySelector('input[type="text"], input[type="tel"]');
					if (firstInput) {
						setTimeout(() => firstInput.focus(), 100);
					}

					// Показываем блок с услугами если он скрыт
					const servicesDisplay = contactModal.querySelector('.services-display');
					if (servicesDisplay && window.selectedPageServices && window.selectedPageServices.length > 0) {
						servicesDisplay.style.display = 'block';
					}
				});

				// Обработчик закрытия модального окна
				contactModal.addEventListener('hidden.bs.modal', function () {
					// Очищаем форму при закрытии
					const form = contactModal.querySelector('.wpcf7-form');
					if (form) {
						form.reset();
					}
				});
			}

			// Улучшенная функция заполнения модального окна
			window.populateModalWithServices = function () {
				if (!window.selectedPageServices || window.selectedPageServices.length === 0) return;

				const modal = document.getElementById('contactModalPrice');
				if (!modal) return;

				// Ищем или создаем контейнер для услуг
				let servicesDisplay = modal.querySelector('.services-display');
				if (!servicesDisplay) {
					const modalBody = modal.querySelector('.modal-body');
					if (modalBody) {
						const servicesHTML = `
							<div class="services-display mb-3">
								<label class="form-label">Выбранные услуги:</label>
								<div class="selected-services-list" id="modalServicesList"></div>
								<div class="promotion-hint">
									<small class="text-muted">🎉 Действует акция: при выборе 3 услуг третья - бесплатно!</small>
								</div>
								<input type="hidden" name="total_price" id="hiddenTotalPrice" value="">
							</div>
						`;

						// Вставляем перед полем согласия
						const acceptanceField = modalBody.querySelector('.form-check');
						if (acceptanceField) {
							acceptanceField.insertAdjacentHTML('beforebegin', servicesHTML);
							servicesDisplay = modal.querySelector('.services-display');
						}
					}
				}

				// Заполняем список услуг
				const servicesList = modal.querySelector('#modalServicesList');
				if (servicesList) {
					servicesList.innerHTML = '';
					window.selectedPageServices.forEach((service, index) => {
						const serviceElement = document.createElement('div');
						serviceElement.className = 'service-item';
						serviceElement.innerHTML = `
							<span class="service-name">
								${service.title}
							</span>
							<input type="hidden" name="selected_services[]" value="${service.title}">
						`;
						servicesList.appendChild(serviceElement);
					});
				}

				// Обновляем общую стоимость
				const totalPriceElement = modal.querySelector('#modalTotalPrice');
				const hiddenPriceElement = modal.querySelector('#hiddenTotalPrice');
				if (totalPriceElement && hiddenPriceElement) {
					const formattedPrice = window.selectedPageServicesTotal.toLocaleString('ru-RU') + ' р';
					totalPriceElement.textContent = formattedPrice;
					hiddenPriceElement.value = window.selectedPageServicesTotal;
				}

				// Показываем контейнер
				if (servicesDisplay) {
					servicesDisplay.style.display = 'block';
				}
			};
		});
	</script>
	<?php
});

/**
 * Обработка отправки формы из модального окна с предзаполненными услугами
 */
add_action('wpcf7_before_send_mail', function ($contact_form) {
	$submission = WPCF7_Submission::get_instance();
	if ($submission) {
		$posted_data = $submission->get_posted_data();

		// Проверяем, есть ли предзаполненные услуги
		$selected_services = '';
		$total_price = '';

		if (isset($posted_data['selected_services']) && is_array($posted_data['selected_services'])) {
			$services_list = implode(', ', $posted_data['selected_services']);
			$selected_services = $services_list;

			// Пытаемся получить общую стоимость из hidden поля или рассчитываем
			if (isset($posted_data['total_price'])) {
				$total_price = $posted_data['total_price'] . ' р';
			} else {
				// Рассчитываем стоимость по количеству услуг
				$count = count($posted_data['selected_services']);
				$calculated_price = calculatePromotionPrice($count);
				$total_price = number_format($calculated_price, 0, '', ' ') . ' р';
			}
		}

		// Заменяем плейсхолдеры в шаблоне письма
		$mail = $contact_form->prop('mail');
		$mail['body'] = str_replace('[selected_services]', $selected_services, $mail['body']);
		$mail['body'] = str_replace('[total_price]', $total_price, $mail['body']);
		$mail['body'] = str_replace('[promotion_type]', 'Акция 1+1=3', $mail['body']);
		$contact_form->set_properties(array('mail' => $mail));
	}
});

/**
 * Функция расчета стоимости по акции 1+1=3
 */
function calculatePromotionPrice($selectedCount, $basePrice = 5000)
{
	if ($selectedCount === 0)
		return 0;

	// Универсальная формула: каждые 3 услуги стоят как 2
	$fullGroups = intval($selectedCount / 3);  // Полные группы по 3
	$remainder = $selectedCount % 3;           // Остаток

	return ($fullGroups * 2 + $remainder) * $basePrice;
}

/**
 * Дополнительный JavaScript для улучшения работы модального окна
 */
add_action('wp_footer', function () {
	if (is_singular('services')) {
		return; // Выходим из функции
	}
	?>
	<script>
		// Дополнительные функции для работы с модальным окном
		document.addEventListener('DOMContentLoaded', function () {

			// Обработчик события показа модального окна
			const contactModal = document.getElementById('contactModalPrice');
			if (contactModal) {
				contactModal.addEventListener('shown.bs.modal', function () {
					// Фокус на первое поле при открытии модального окна
					const firstInput = contactModal.querySelector('input[type="text"], input[type="tel"]');
					if (firstInput) {
						setTimeout(() => firstInput.focus(), 100);
					}

					// Показываем блок с услугами если он скрыт
					const servicesDisplay = contactModal.querySelector('.services-display');
					if (servicesDisplay && window.selectedPageServices && window.selectedPageServices.length > 0) {
						servicesDisplay.style.display = 'block';
					}
				});

				// Обработчик закрытия модального окна
				contactModal.addEventListener('hidden.bs.modal', function () {
					// Очищаем форму при закрытии
					const form = contactModal.querySelector('.wpcf7-form');
					if (form) {
						form.reset();
					}
				});
			}

			// Улучшенная функция заполнения модального окна
			window.populateModalWithServices = function () {
				if (!window.selectedPageServices || window.selectedPageServices.length === 0) return;

				const modal = document.getElementById('contactModalPrice');
				if (!modal) return;

				// Ищем или создаем контейнер для услуг
				let servicesDisplay = modal.querySelector('.services-display');
				if (!servicesDisplay) {
					const modalBody = modal.querySelector('.modal-body');
					if (modalBody) {
						const servicesHTML = `
												<div class="services-display mb-3">
														<label class="form-label">Выбранные услуги:</label>
														<div class="selected-services-list" id="modalServicesList"></div>
														<div class="promotion-hint">
																<small class="text-muted">🎉 Действует акция: при выборе 3 услуг третья - бесплатно!</small>
														</div>
														<input type="hidden" name="total_price" id="hiddenTotalPrice" value="">
												</div>
										`;

						// Вставляем перед полем согласия
						const acceptanceField = modalBody.querySelector('.form-check');
						if (acceptanceField) {
							acceptanceField.insertAdjacentHTML('beforebegin', servicesHTML);
							servicesDisplay = modal.querySelector('.services-display');
						}
					}
				}

				// Заполняем список услуг
				const servicesList = modal.querySelector('#modalServicesList');
				if (servicesList) {
					servicesList.innerHTML = '';
					window.selectedPageServices.forEach((service, index) => {
						const serviceElement = document.createElement('div');
						serviceElement.className = 'service-item';
						serviceElement.innerHTML = `
												<span class="service-name">
														${service.title}
												</span>
												<input type="hidden" name="selected_services[]" value="${service.title}">
										`;
						servicesList.appendChild(serviceElement);
					});
				}

				// Обновляем общую стоимость
				const totalPriceElement = modal.querySelector('#modalTotalPrice');
				const hiddenPriceElement = modal.querySelector('#hiddenTotalPrice');
				if (totalPriceElement && hiddenPriceElement) {
					const formattedPrice = window.selectedPageServicesTotal.toLocaleString('ru-RU') + ' р';
					totalPriceElement.textContent = formattedPrice;
					hiddenPriceElement.value = window.selectedPageServicesTotal;
				}

				// Показываем контейнер
				if (servicesDisplay) {
					servicesDisplay.style.display = 'block';
				}
			};

			// Функция для добавления анимации обновления цены
			window.animatePriceUpdate = function () {
				const priceElement = document.querySelector('.price');
				if (priceElement) {
					priceElement.classList.add('price-updated');
					setTimeout(() => {
						priceElement.classList.remove('price-updated');
					}, 500);
				}
			};

			// Переопределяем функцию обновления цены с анимацией
			const originalUpdateFunction = window.updatePriceAndForm;
			if (typeof originalUpdateFunction === 'function') {
				window.updatePriceAndForm = function () {
					originalUpdateFunction();
					window.animatePriceUpdate();
				};
			}
		});
	</script>
	<?php
});


/**
 * Модификация форм Contact Form 7 для предзаполнения услуг на страницах услуг
 */
add_filter('wpcf7_form_elements', function ($content) {
	// Проверяем, находимся ли мы на странице услуг
	if (!is_singular('services')) {
		return $content;
	}

	// Для форм с одноразовыми услугами на страницах услуг
	if (strpos($content, '[one_time_services_checkboxes') !== false) {
		// Добавляем блок для отображения предзаполненной услуги
		$preselected_display = '
        <div class="services-display mb-3" style="display: none;">
            <label class="form-label">Выбранная услуга:</label>
            <div class="selected-services-list"></div>
        </div>';

		// Вставляем перед шорткодом услуг
		$content = str_replace('[one_time_services_checkboxes]', $preselected_display . '[one_time_services_checkboxes]', $content);
	}

	// Для форм с годовыми услугами на страницах услуг
	if (strpos($content, '[annual_services_checkboxes') !== false) {
		// Добавляем блок для отображения предзаполненной услуги
		$preselected_display = '
        <div class="services-display mb-3" style="display: none;">
            <label class="form-label">Выбранная услуга:</label>
            <div class="selected-services-list"></div>
        </div>';

		// Вставляем перед шорткодом услуг
		$content = str_replace('[annual_services_checkboxes]', $preselected_display . '[annual_services_checkboxes]', $content);
	}

	return $content;
});

add_action('wpcf7_before_send_mail', function ($contact_form) {
	$submission = WPCF7_Submission::get_instance();
	if ($submission) {
		$posted_data = $submission->get_posted_data();

		// Отладка - смотрим все данные, которые приходят
		error_log('Posted data: ' . print_r($posted_data, true));

		// Ищем данные об услуге в разных возможных полях
		$preselected_service = '';
		$service_category = '';

		// Проверяем разные варианты названий полей
		if (isset($posted_data['preselected_service'])) {
			$preselected_service = $posted_data['preselected_service'];
		} elseif (isset($posted_data['preselected-service'])) {
			$preselected_service = $posted_data['preselected-service'];
		}

		if (isset($posted_data['service_category'])) {
			$service_category = $posted_data['service_category'];
		} elseif (isset($posted_data['service-category'])) {
			$service_category = $posted_data['service-category'];
		}

		// Если данные не найдены, пробуем получить из JavaScript переменных
		// или используем значения по умолчанию для тестирования
		if (empty($preselected_service)) {
			// Попробуем определить по ID формы или другим признакам
			$form_id = $contact_form->id();
			error_log('Form ID: ' . $form_id . ', no preselected service found');

			// Временно для отладки - можете убрать эти строки после исправления
			$preselected_service = 'Услуга не определена (проверьте форму)';
			$service_category = 'Тип не определен';
		}

		// Определяем название категории на русском
		$category_name = '';
		switch ($service_category) {
			case 'annual':
				$category_name = 'Годовая услуга';
				break;
			case 'one_time':
				$category_name = 'Разовая услуга';
				break;
			default:
				$category_name = $service_category ?: 'Тип услуги не определен';
		}

		// Получаем шаблон письма
		$mail = $contact_form->prop('mail');

		// Заменяем плейсхолдеры в теле письма
		$mail['body'] = str_replace('[preselected_service]', $preselected_service, $mail['body']);
		$mail['body'] = str_replace('[service_category]', $category_name, $mail['body']);

		// Заменяем плейсхолдеры в теме письма
		$mail['subject'] = str_replace('[preselected_service]', $preselected_service, $mail['subject']);
		$mail['subject'] = str_replace('[service_category]', $category_name, $mail['subject']);

		// Сохраняем изменения
		$contact_form->set_properties(array('mail' => $mail));

		// Подробное логирование для отладки
		error_log('Service data processed: service=' . $preselected_service . ', category=' . $category_name);
		error_log('Mail subject after processing: ' . $mail['subject']);
	}
});

/**
 * обработчик для добавления скрытых полей
 */
add_filter('wpcf7_form_elements', function ($content) {
	// Проверяем, что мы находимся на странице услуг и в форме есть блок services-display
	if (is_singular('services') && strpos($content, 'services-display') !== false) {
		// Добавляем скрытые поля прямо в HTML форм
		$hidden_fields = '
        <div style="display: none;">
            [hidden preselected_service class:preselected-service-input]
            [hidden service_category class:service-category-input]
        </div>';

		// Вставляем скрытые поля перед кнопкой отправки
		$content = str_replace('[submit', $hidden_fields . '[submit', $content);
	}

	return $content;
});

/**
 * Дополнительный JavaScript для корректной работы с обновленными формами
 */
add_action('wp_footer', function () {
	if (!is_singular('services')) {
		return;
	}
	?>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Обновленная функция заполнения модального окна
			function populateServiceModalAdvanced(modalId, serviceTitle, serviceCategory) {
				const modal = document.getElementById(modalId);
				if (!modal) return;

				// Ищем блок services-display ВНУТРИ формы Contact Form 7
				const servicesDisplay = modal.querySelector('.wpcf7-form .services-display');
				const servicesList = modal.querySelector('.wpcf7-form .selected-services-list');
				const modalTitle = modal.querySelector('.modal-title');

				// Находим скрытые поля Contact Form 7
				const preselectedInput = modal.querySelector('.wpcf7-form input[name="preselected_service"]');
				const categoryInput = modal.querySelector('.wpcf7-form input[name="service_category"]');

				if (servicesDisplay && servicesList) {
					// Показываем блок с услугой
					servicesDisplay.style.display = 'block';

					// Очищаем предыдущий контент
					servicesList.innerHTML = '';

					// Добавляем услугу в список
					const serviceElement = document.createElement('div');
					serviceElement.className = 'service-item';
					serviceElement.innerHTML = `<span class="service-name">${serviceTitle}</span>`;
					servicesList.appendChild(serviceElement);
				}

				// Устанавливаем значения в скрытые поля Contact Form 7
				if (preselectedInput) {
					preselectedInput.value = serviceTitle;
				} else {
				}

				if (categoryInput) {
					categoryInput.value = serviceCategory;
				} else {
				}
			}

			// Обработчик кликов
			document.addEventListener('click', function (e) {
				const button = e.target.closest('[data-bs-toggle="modal"][data-service-title]');
				if (!button) return;

				const serviceTitle = button.getAttribute('data-service-title');
				const serviceCategory = button.getAttribute('data-service-category');
				const targetModal = button.getAttribute('data-bs-target');

				if (serviceTitle && serviceCategory && targetModal) {
					const modalId = targetModal.replace('#', '');

					// Увеличиваем задержку для полной загрузки формы
					setTimeout(() => {
						populateServiceModalAdvanced(modalId, serviceTitle, serviceCategory);
					}, 500);
				}
			});

			// Очистка модальных окон при закрытии
			['oneTimeServiceModal', 'annualServiceModal'].forEach(modalId => {
				const modal = document.getElementById(modalId);
				if (modal) {
					modal.addEventListener('hidden.bs.modal', function () {

						// Скрываем блок с услугами в форме
						const servicesDisplay = this.querySelector('.wpcf7-form .services-display');
						if (servicesDisplay) servicesDisplay.style.display = 'none';

						// Очищаем список услуг в форме
						const servicesList = this.querySelector('.wpcf7-form .selected-services-list');
						if (servicesList) servicesList.innerHTML = '';

						// Очищаем скрытые поля Contact Form 7
						const preselectedInput = this.querySelector('.wpcf7-form input[name="preselected_service"]');
						const categoryInput = this.querySelector('.wpcf7-form input[name="service_category"]');

						if (preselectedInput) preselectedInput.value = '';
						if (categoryInput) categoryInput.value = '';

						// Сбрасываем форму
						const form = this.querySelector('.wpcf7-form');
						if (form) form.reset();
					});
				}
			});
		});
	</script>
	<?php
});