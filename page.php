<?php

get_header();

the_large_title();

the_showcase();

?>

<div class="content-wide" role="main">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>
	<?php the_content(); ?>
			<?php
		endwhile;
	endif;

	?>
</div><!-- #content -->

<?php

get_footer();

?>