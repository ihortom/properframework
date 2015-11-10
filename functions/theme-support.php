<?php

//featured image
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_image_size( 'post-featured-image', $content_width, 200, true ); // (hard-cropped)
add_filter( 'image_size_names_choose', 'pweb_custom_sizes' );

function pweb_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'pweb-custom-size' => __( 'Featured imaage size' ),
    ) );
}

//gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
            if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
            return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

//gets pweb_post_type slug and looks for single-[pweb_post_type slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_terms($post->ID, "pweb_post_type") as $cat ) {
            if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
            return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

?>