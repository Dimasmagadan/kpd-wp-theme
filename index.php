<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<?php
if(isset($_GET['s'])){
	os_search_results($_GET['s']);
} ?>

<div id="main" role="main">
  <?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	  <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<header>
		  <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Перейти <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		  <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('F jS, Y') ?></time>
		  <span class="author"><?php the_author() ?></span>
		</header>
		<?php the_content('Далее &raquo;'); ?>
		<footer>
			<?php get_template_part( 'block', 'meta' ); ?>
		</footer>
	  </article>

	<?php endwhile; ?>

	<?php get_template_part( 'block', 'pagenavi' ); ?>

  <?php else : ?>

	<?php get_template_part( 'block', 'notfound' ); ?>

  <?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
