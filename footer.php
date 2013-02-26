<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */
?>
<footer>
	<?php if ( function_exists('dynamic_sidebar') ) { dynamic_sidebar('bottom'); } else { ?>
	<p>
		<?php bloginfo('name'); ?> is proudly powered by
		<a href="http://wordpress.org/">WordPress</a>, and built using the <a href="http://html5boilerplate.com/">HTML5 Boilerplate</a>.
		<br /><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
		and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
	</p>
	<?php } ?>
	<?php
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