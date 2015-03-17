<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="small"
	data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"
	data-yashareTheme="counter"
	data-yashareLink="<?php the_permalink(); ?>"
	data-yashareTitle="<?php the_title_attribute(); ?>"
	data-yashareDescription="<?php esc_attr( get_the_excerpt() ); ?>"
	<?php if(has_post_thumbnail( )){
		$thumb=wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
		?> data-yashareImage="<?php echo $thumb[0]; ?>"<?php
	} ?>
></div>