<?php

/*
Template Name: Homepage
*/

get_header();

?>

	<?php the_showcase(); ?>
	
	<div class="intro">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				the_content();
			endwhile;
		endif;
		?>
	</div>

	<?php the_icon_showcase(); ?>

	<div class="featured-image">
		<a href="/process"><?php the_post_thumbnail( 'full' ); ?></a>
	</div>

	<!--
	<div class="articles">
	<?php
	/*
	$args = array(
		'posts_per_page' => 3
	);
	
	// query
	$the_query = new WP_Query( $args );

	// loop
	if ( $the_query->have_posts() ) {
	    while ( $the_query->have_posts() ) {
	        $the_query->the_post(); ?>
	        <div class="article">
	        	<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
	        	<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	        	<?php the_excerpt(); ?>
	        	<p class="read-more"><a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
	        </div>
	        <?php
	    }
	}
	
	// reset post data
	wp_reset_postdata();
	
	*/
	?>
	</div>
	-->

<?php

get_footer();

?>