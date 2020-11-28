<?php


// output the icons on the homepage
function the_icon_showcase() {

	// get the icons
	$icons = get_cmb_value( 'icon_showcase' );

	// if it's an array
	if ( is_array( $icons ) ) {

		if ( !empty( $icons[0]['background'] ) && !empty( $icons[0]['image'] ) && !empty( $icons[0]['title'] ) && !empty( $icons[0]['subtitle'] ) ) {

		// if it's an array, we'll assume it's got content
		?>
		<div class="icons">
			<?php
			foreach ( $icons as $icon ) {
				if ( !empty( $icon['background'] ) && !empty( $icon['image'] ) && !empty( $icon['title'] ) && !empty( $icon['subtitle'] ) ) { 
					if ( !empty( $icon['link'] ) ) { ?><a href="<?php print $icon['link']; ?>"><?php } ?><div class="icon" style="background-image: url(<?php print $icon['background'] ?>);">
    				<img src="<?php print $icon['image']; ?>" alt="<?php print ( !empty( $icon['alt-text'] ) ? $icon['alt-text'] : $icon['title'] ); ?>">
                    <div class="text <?php print $icon['color']; ?>">
                        <h3><?php print $icon['title'] ?></h3>
                        <h4><?php print $icon['subtitle'] ?></h4>
                    </div>
                </div><?php if ( !empty( $icon['link'] ) ) { ?></a><?php }
				} 
			}
			?>
		</div>
		<?php
		}
	}
}



// add the showcase metabox
function icons_metabox( $meta_boxes ) {

    // thumb showcase metabox
    $icon_showcase_metabox = new_cmb2_box( array(
        'id' => 'icon_showcase_metabox',
        'title' => 'Icons',
        'object_types' => array( 'page' ),
        'show_on' => array( 
            'key' => 'template',
            'value' => 'page-front'
        ),
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $icon_showcase_metabox_group = $icon_showcase_metabox->add_field( array(
        'id' => 'icon_showcase',
        'type' => 'group',
        'options' => array(
            'add_button' => __('Add Icon', 'cmb2'),
            'remove_button' => __('Remove Icon', 'cmb2'),
            'group_title'   => __( 'Icon {#}', 'cmb' ), // since version 1.1.4, {#} gets replaced by row number
            'sortable' => true, // beta
        )
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Background Image',
        'desc' => 'Upload a background image that will cover the background of this icon box.',
        'id'   => 'background',
        'type' => 'file',
        'preview_size' => array( 90, 90 ),
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Icon Image',
        'desc' => 'Upload a 90x90 pixel icon image, ideally a transparent PNG with the icon in white.',
        'id'   => 'image',
        'type' => 'file',
        'preview_size' => array( 90, 90 ),
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Image Alt Text',
        'desc' => 'Set alt text for the icon.',
        'id'   => 'alt-text',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Title',
        'desc' => 'Set a title to display below this icon.',
        'id'   => 'title',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Subtitle',
        'desc' => 'Set a subtitle to display below the title in this icon box.',
        'id'   => 'subtitle',
        'type' => 'text',
        'sanitization_cb' => false
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Link',
        'desc' => 'Specify a URL to which this ad should link.',
        'id'   => 'link',
        'type' => 'text',
        'sanitization_cb' => 'cmb2_relative_urls'
    ) );

    $icon_showcase_metabox->add_group_field( $icon_showcase_metabox_group, array(
        'name' => 'Color',
        'desc' => 'Choose a color for the background of the icon and the text-color.',
        'id'   => 'color',
        'type' => 'select',
        'options' => array(
            'navy' => "Navy",
            'teal' => "Teal",
            'lime' => "Lime"
        ),
        'default' => 'navy'
    ) );

}
add_filter( 'cmb2_init', 'icons_metabox' );

