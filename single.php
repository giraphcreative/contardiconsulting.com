<?php
/**
 * The Template for displaying all single posts
 */

get_header();

the_showcase();

?>

	<div class="content-wide post-page" role="main">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php the_content();
			endwhile;
		endif;
		?>
	</div>

<?php

get_footer();

?>