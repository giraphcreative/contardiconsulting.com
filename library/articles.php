<?php


// articles shortcode
function articles_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'style' => "card",
		'tags' => '',
		'cats' => '',
		'category__not_in' => '',
		'post_type' => 'post',
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'DESC'
	), $atts );

	$args = array(
		'posts_per_page' => $a['posts_per_page']
	);

	if ( !empty( $a['tags'] ) ) {
		$args['tag'] = $a['tags'];
	}

	if ( !empty( $a['cats'] ) ) {
		$args['category_name'] = $a['cats'];
	}

	if ( !empty( $a['category__not_in'] ) ) {
		$args['category__not_in'] = explode( ',', $a['category__not_in'] );
	}

	$args['order'] = $a['order'];
	$args['orderby'] = $a['orderby'];

	$query = new WP_Query( $args );

	// Check that we have query results.
	if ( $query->have_posts() ) {

		if ( $a['style'] == 'projects' ) {

			$return = '<div class="article-cards">';
		  
		    // Start looping over the query results.
		    while ( $query->have_posts() ) {
		        $query->the_post();
		        $location = get_cmb_value('location');
		        $return .= '<div class="entry">';
		        $return .= '<div class="entry-thumbnail">';
		        $return .= '<a href="' . get_the_permalink() . '">';
		        $return .= get_the_post_thumbnail( null, array( 768, 480 ) );
		        $return .= '</a>';
			    if ( !empty( $location ) ) $return .= '<div class="entry-category">' . $location . '</div>';
			    $return .= '</div>';
		        $return .= '<div class="entry-inner">';
			    $return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
			    $return .= '</div>';
			    $return .= '</div>';
		    }

			$return .= '</div>';
			
		} else {

			$return = '<div class="article-cards">';
		  
		    // Start looping over the query results.
		    while ( $query->have_posts() ) {
		        $query->the_post();
		        $categories = get_the_category();
		        $cat = $categories[0];
		        $return .= '<div class="entry">';
		        $return .= '<div class="entry-thumbnail">';
		        $return .= '<a href="' . get_the_permalink() . '">';
		        $return .= get_the_post_thumbnail( null, array( 768, 480 ) );
		        $return .= '</a>';
			    $return .= '<div class="entry-category ' . $cat->slug . '">' . $cat->name . '</div>';
			    $return .= '</div>';
		        $return .= '<div class="entry-inner">';
			    $return .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
			    $return .= wpautop( get_the_excerpt() );
			    $return .= '</div>';
			    $return .= '</div>';
		    }

			$return .= '</div>';
			
		}

	} else {
		return '';
	}

	  
	// Restore original post data.
	wp_reset_postdata();
	  

	return $return;
}
add_shortcode( 'articles', 'articles_shortcode' );


// add the title metabox
function article_metabox( $meta_boxes ) {

    $article_metabox = new_cmb2_box( array(
        'id' => 'article_metabox',
        'title' => 'Articles',
        'object_types' => array( 'post' ), // post type
        'context' => 'normal',
        'priority' => 'high',
    ) );

    $article_metabox->add_field( array(
        'name' => 'Location',
        'id'   => 'location',
        'type' => 'text',
    ) );

}
add_filter( 'cmb2_init', 'article_metabox' );




