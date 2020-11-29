<?php


// function to use on front-end templates to output the showcase.
function the_large_title() {

	// get the slides
	$title_photo = get_post_meta( get_the_ID(), "title_photo", 1 );
	$title_text = get_post_meta( get_the_ID(), "title_text", 1 );
	
	?>
<div class="page-title"<?php print ( !empty( $title_photo ) ? ' style="background-image: url(' . $title_photo . ')"' : '' ) ?>>
	<h1><?php print ( !empty( $title_text ) ? $title_text : get_the_title() ); ?></h1>
</div>
	<?php
}



// add the title metabox
function title_metabox( $meta_boxes ) {

    $showcase_metabox = new_cmb2_box( array(
        'id' => 'title_metabox',
        'title' => 'Title',
        'object_types' => array( 'page' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $showcase_metabox->add_field( array(
        'name' => 'Photo',
        'id'   => 'title_photo',
        'type' => 'file',
        'preview_size' => array( 200, 100 )
    ) );

    $showcase_metabox->add_field( array(
        'name' => 'Title Override',
        'id'   => 'title_text',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_init', 'title_metabox' );

