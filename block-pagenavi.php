<nav><?php
	if(function_exists('wp_pagenavi')){
		wp_pagenavi();
	} else {
		?>
		<div><?php next_posts_link('&laquo; Туда') ?></div>
		<div><?php previous_posts_link('Сюда &raquo;') ?></div><?php
	}
?></nav>