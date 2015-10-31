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

?>