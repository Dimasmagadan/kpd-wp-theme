<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="single-item">
			
			<div class="item-image">
				<?php
				// картинка для товара, первый параметр $post - объект, второй - ширина
				get_image_from_catalog_item($post,180); ?>
			</div>	
			
			<h2><?php the_title(); ?></h2>

			<div class="item-meta">
				<?php
				// категории товара
				the_taxonomies( '&post='.$post->ID); ?>
			</div>
			
			<?php // вывод таблицы с характеристиками
			if (get_post_meta($post->ID, 'vendor', TRUE) || get_post_meta($post->ID, 'params_list', TRUE)):?>
				<table>
					<?php if (get_post_meta($post->ID, 'vendor', TRUE)): ?>
					<tr>
						<td>Производитель</td>
						<td><?php echo get_post_meta($post->ID, 'vendor', TRUE); ?></td>
					</tr>
					<?php endif; ?>
					<?php if (get_post_meta($post->ID, 'params_list', TRUE)):?>
					<?php foreach(explode(',',get_post_meta($post->ID, 'params_list', TRUE)) as $paramKey):?>
						<tr>
							<td><?php echo $paramKey?></td>
							<td><?php echo get_post_meta($post->ID, $paramKey, TRUE)?></td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</table>
			<?php endif; ?>
			
			<?php // цена и ссылка "купить" ?>
			<span class="item-price"><?php echo get_post_meta($post->ID, 'price', TRUE); ?> <?php echo (get_post_meta($post->ID, 'currency', TRUE) == 'RUR' ? 'руб.' : get_post_meta($post->ID, 'currency', TRUE)); ?></span>
			<a class="item-purchase" href="<?php echo GS_PLUGIN_URL?>go.php?url=<?php echo get_post_meta($post->ID, 'url', TRUE); ?>">Купить</a>

			<div class="item-description">
				<?php echo html_entity_decode(nl2br($post->post_content)); ?>
			</div>
		</div>
	<?php endwhile; ?>

		<?php
		// блок навигации
		get_template_part( 'block', 'pagenavi' ); ?>
		
		<?php
		// блок похожих товаров
		if(function_exists('os_related_stuff')){ echo os_related_stuff(); } ?>

	<?php else : ?>
		<?php
		// сообщение, ничего не найдено
		get_template_part( 'block', 'notfound' ); ?>
	<?php endif; ?>


<?php get_sidebar(); ?>

<?php get_footer();