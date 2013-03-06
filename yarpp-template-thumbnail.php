<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/
?><!-- Begin of Related Post -->
<div class="related-posts">
	<div id="related-post-title"><h5>Похожие записи</h5></div>
	<?php if (have_posts()):?>
	<?php while (have_posts()) : the_post(); ?>
	<!-- <div class="yarpp-thumbnails-horizontal"> -->
	<div class="product-box grid_2">
		<div class="prod-thumb">
			<a href="<?php the_permalink() ?>">
				<?php echo os_force_get_img($post->ID,array(120,120),array('class'=>'img-related')); ?>
			</a>
		</div>
		<div class="prod-info">
			<div class="pricebar cf"> 
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			</div>
			<?php // echo '<p>'.wp_trim_words($post->post_content,25).'</p>'; ?>
		</div>
	</div>	
	<?php endwhile; ?>
	<?php else: ?>
		<p>Нет похожих записей.</p>
	<?php endif; ?>
</div>
<!-- End of Related Post -->