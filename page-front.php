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

	<div class="content-wide">
		<h3 class="text-center"><strong>CONTARDI CONSULTING PROJECTS</strong></h3>
		<?php print do_shortcode( '[articles cats="projects" style="projects" orderby="title" order="ASC" posts_per_page=4 /]' ) ?>
	</div>

<?php

get_footer();

?>