<?php the_tags('Теги: ', ', ', '<br />'); ?> 
Рубрика <?php the_category(', ') ?>
<?php
	comments_popup_link('Нет комментариев &#187;', '1 Комментарий &#187;', 'Комментарии: % &#187;');
?>