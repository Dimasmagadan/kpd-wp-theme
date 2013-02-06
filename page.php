<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="post" id="post-<?php the_ID(); ?>">
		<header>
			<h2><?php the_title(); ?></h2>
		</header>
	
		<?php the_content(); ?>

		<?php wp_link_pages(array('before' => '<p><strong>Страницы:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
	</article>
	<?php endwhile; endif; ?>

	<?php comments_template(); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
