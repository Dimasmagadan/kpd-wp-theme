<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="catalog">
	<?php while (have_posts()) : the_post();
		$url=os_get_item_link($post->ID);
		?>
		<div <?php post_class( 'item' ); ?>>
			<div>
				<a href="<?php echo $url; ?>">
					<?php get_image_from_catalog_item($post); ?>
				</a>
			</div>
			<div>
				<h2><a href="<?php echo $url; ?>"> <?php the_title(); ?> </a></h2>
				<p><?php the_taxonomies( '&post='.$post->ID); ?></p>
				<div>
					<?php the_excerpt(); ?>
				</div>
				<div>
					<span><?php echo get_post_meta($post->ID, 'price', TRUE); ?> <?php echo (get_post_meta($post->ID, 'currency', TRUE) == 'RUR' ? 'руб.' : get_post_meta($post->ID, 'currency', TRUE)); ?></span>
					<span> <a href="<?php echo $url; ?>"> Купить </a> </span>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	</div>
		<?php get_template_part( 'block', 'pagenavi' ); ?>
	<?php else : ?>
		<?php get_template_part( 'block', 'notfound' ); ?>
	<?php endif; ?>

<?php get_footer(); ?>
