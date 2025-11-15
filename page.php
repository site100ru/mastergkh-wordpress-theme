<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package newTheme
 */

get_header();
?>
<section class="container-xl main wow animate__animated animate__fadeInUp" data-wow-duration="1.2s">

	<?php
	if (have_posts()):
		while (have_posts()):
			the_post();
			the_content();
		endwhile;
	endif;
	?>

</section>

<?php
get_footer();
