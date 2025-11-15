<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package newTheme
 */

get_header();
?>

<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">
	<div class="row align-items-center">
		<div class="col-lg-7 py-5">
			<h1>Вы перешли на страницу которой не существует</h1>
			<h2>Возможно она была удалена</h2>
			<a href="/" class="btn btn-accent ps-4 pe-4 mt-3 mt-md-6">
				Перейти на главную
			</a>
		</div>
		<div class="col-lg-5 py-5">
			<img src="<?= get_template_directory_uri() ?>/asset/img/404.png" class="img-fluid" alt="" />
		</div>
	</div>
</section>

<?php
get_footer();
