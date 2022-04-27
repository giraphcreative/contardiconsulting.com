<?php


// include the main.js script in the header on the front-end.
function p_scripts() {
	wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'p_scripts' );



// register a couple nav menus
register_nav_menus( array(
	'main-menu' => 'Main'
) );



// register a generic sidebar.
register_sidebar( array(
	'id' => 'sidebar-generic',
	'name'=> 'General Sidebar',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
) );


// add wysiwyg to excerpt field
class TinyMceExcerptCustomization{
	const textdomain = '';
	const custom_exceprt_slug = '_custom-excerpt';
	var $contexts;

	/**
	 * Set the feature up
	 * @param array $contexts a list of context where you want the wysiwyg editor in the excerpt field. Defatul array('post','page')
	 */
	function __construct($contexts=array('post', 'page')){
		
		$this->contexts = $contexts;
		
		add_action('admin_menu', array($this, 'remove_excerpt_metabox'));
		add_action('add_meta_boxes', array($this, 'add_tinymce_to_excerpt_metabox'));
		add_filter('wp_trim_excerpt',  array($this, 'custom_trim_excerpt'), 10, 2);
		add_action('save_post', array($this, 'save_box'));
	}
	
	/**
	 * Removes the default editor for the excerpt
	 */
	function remove_excerpt_metabox(){
		foreach($this->contexts as $context)
			remove_meta_box('postexcerpt', $context, 'normal');
	}
	
	/**
	 * Adds a new excerpt editor with the wysiwyg editor
	 */
	function add_tinymce_to_excerpt_metabox(){
		foreach($this->contexts as $context)
		add_meta_box(
			'tinymce-excerpt', 
			__('Excerpt', self::textdomain), 
			array($this, 'tinymce_excerpt_box'), 
			$context, 
			'normal', 
			'high'
		);
	}
	
	/**
	 * Manages the excerpt escaping process
	 * @param string $text the default filtered version
	 * @param string $raw_excerpt the raw version
	 */
	function custom_trim_excerpt($text, $raw_excerpt) {
		global $post;
		$custom_excerpt = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($custom_excerpt)) return $text;
		return $custom_excerpt;
	}

	/**
	 * Prints the markup for the tinymce excerpt box
	 * @param object $post the post object
	 */
	function tinymce_excerpt_box($post){
		$content = get_post_meta($post->ID, self::custom_exceprt_slug, true);
		if(empty($content)) $content = '';
		wp_editor(
			$content,
			self::custom_exceprt_slug,
			array(
				'wpautop'		=>	true,
				'media_buttons'	=>	false,
				'textarea_rows'	=>	10,
				'textarea_name'	=>	self::custom_exceprt_slug
			)
		);
	}
	
	/**
	 * Called when the post is beeing saved
	 * @param int $post_id the post id
	 */
	function save_box($post_id){
		update_post_meta($post_id, self::custom_exceprt_slug, $_POST[self::custom_exceprt_slug]);
	}
}

global $tinymce_excerpt;
$tinymce_excerpt = new TinyMceExcerptCustomization();

