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

<div id="casing">

<div id="left">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'item', 'single' ); ?>
	<?php endwhile; ?>
		<?php get_template_part( 'block', 'pagenavi' ); ?>
		<div class="clear"></div>
		<?php // comments_template(); ?>
	<?php else : ?>
		<?php get_template_part( 'block', 'notfound' ); ?>
	<?php endif; ?>

	<div><?php if(function_exists('os_related_stuff')){ echo os_related_stuff(); } ?></div>

</div>

<?php get_sidebar(); ?>


<div class="clear"></div>
</div>

<?php get_footer(); ?>
