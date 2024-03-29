<?php


// removing this constant will mess up any modules that add to the theme options dashboard area.
define( 'PURE', true );


// require multiple - a little helper function to require multiple files from the library directory in a one 
function require_multi( $files ) {
    $files = func_get_args();
    foreach ( $files as $file )
        require_once 'library/' . $file . '.php';
}


// include utility functions
require_multi( 'core', 'admin', 'metabox', 'images', 'paginate', 'title', 'showcase', 'icons', 'button', 'calculator', 'articles' );


// limit the excerpt length
function excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'excerpt_length' );

