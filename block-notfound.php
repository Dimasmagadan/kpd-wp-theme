<?php
if(isset($_GET['s'])) { ?>
	<h2>Ничего не найдено</h2>
	<p>Попробуйте найти что-то другое?</p>
<?php } else {?>
	<h2>Запись не найдена</h2>
	<p>Извините, по этому адресу у нас ничего нет.</p>
<?php }
get_search_form();
