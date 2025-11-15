<?php
/**
 * Template Name: Front Page
 * Description: Шаблон для главной страницы сайта.
 */

get_header(); // подключаем header.php
?>

<section>

  <?php
  // Проверим, есть ли контент у страницы
  while (have_posts()):
    the_post();
    the_content();
  endwhile;
  ?>

</section>

<?php
get_footer(); // подключаем footer.php
?>