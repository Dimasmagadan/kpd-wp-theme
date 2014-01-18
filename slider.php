<?php

$args = array( 
    'post_type' => array(
            'slide',
            ),  
    'post_status' => array(
            'publish',
            ),
    'nopaging' => true,
);

$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
?>

	<?php
	while ( $the_query->have_posts() ) : $the_query->the_post();
		?>
			<?php if(has_post_thumbnail( )) {
				the_post_thumbnail( 'slider' );
			}
			?>
			<?php the_title(); ?>
				<?php the_content( ); ?>
		<?php
	endwhile;
	?>
<?php
endif;
wp_reset_postdata();
