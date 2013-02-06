<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

	<div id="main" role="main">

	<?php if (have_posts()) : ?>

		<h2>Результаты поиска</h2>

		<?php get_template_part( 'block', 'pagenavi' ); ?>

		<?php while (have_posts()) : the_post(); ?>

			<article <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<time><?php the_time('l, F jS, Y') ?></time>

				<footer>
					<?php get_template_part( 'block', 'meta' ); ?>
				</footer>
			</article>

		<?php endwhile; ?>

		<?php get_template_part( 'block', 'pagenavi' ); ?>

	<?php else : ?>

		<h2>Ничего не найдено. Попробуйте искать что-то другое?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
