<?php

// %1$s - заголовок блока
// %2$s - сам блок с данными
$related_template='
<div class="related-posts">
	<div id="related-post-title"><h5>%1$s</h5></div>
	%2$s
</div>';


// %1$s - ссылка на товар
// %2$s - картинка товара
// %3$s - заголовок товара
// %4$s - описание товара
$related_data='
<div class="product-box grid_2">
	<div class="prod-thumb">
		<a href="%1$s">
			%2$s
		</a>
	</div>
	<div class="prod-info">
		<div class="pricebar cf"> 
			<h2><a href="%1$s">%3$s</a></h2>
		</div>
		%4$s
	</div>
</div>';
?>