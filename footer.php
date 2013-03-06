<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
<footer>
	<?php if ( function_exists('dynamic_sidebar') ) { dynamic_sidebar('bottom'); } ?>
	<?php bloginfo('name'); ?>
	<?php
		/* код sape */
		$kpd_options=get_option( 'kpd_options');
		if(!empty($kpd_options['kpd_sape_code'])){
			echo '<div class="sape">'.$kpd_options['kpd_sape_code'].'</div>';
		}
	?>
</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>