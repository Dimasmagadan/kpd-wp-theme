<?php get_header(); ?>

<div id="main" role="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<header>
			<h2><?php the_title(); ?></a></h2>
		</header>
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '<p><strong>Страницы:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php the_tags( '<p>Теги: ', ', ', '</p>'); ?>
		<footer>
			<p>Опубликовал <?php the_author() ?>
			<time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
			<time><?php the_time() ?></time>
			в рубрике <?php the_category(', ') ?>.
			
			Подписаться на <?php post_comments_feed_link('RSS 2.0'); ?>.

			<?php if ( comments_open() && pings_open() ) {
				// Both Comments and Pings are open ?>
				<a href="#respond">Оставить комментарий</a>, или <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a>.

			<?php } elseif ( !comments_open() && pings_open() ) {
				// Only Pings are Open ?>
				Комментарии отключены, вы можете оставить <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a>.

			<?php } elseif ( comments_open() && !pings_open() ) {
				// Comments are open, Pings are not ?>
				<a href="#respond">Оставить комментарий</a>.

			<?php } elseif ( !comments_open() && !pings_open() ) {
				// Neither Comments, nor Pings are open ?>
				Комментарии закрыты.
			<?php } ?>
			</p>
		</footer>
		<?php get_template_part( 'block', 'pagenavi' ); ?>

		<?php comments_template(); ?>

	</article>

<?php endwhile; else: ?>

	<?php get_template_part( 'block', 'notfound' ); ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>
