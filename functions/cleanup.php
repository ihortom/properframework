<?php

/* <HEAD> */

// Clean up <head> tags of unnnesesary links
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
//remove_action( 'wp_head', 'index_rel_link' ); // index link
//remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
//remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
//remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
//remove emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/* BODY */

//Replace [...] in the_excerpt
add_filter('excerpt_more', 'pweb_excerpt_more');

function pweb_excerpt_more( $more ) {
    return '... <p class="text-center"><a class="read-more button tiny round" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'properweb') . '</a></p>';
}

//Custom read-more link in the_content
add_filter( 'the_content_more_link', 'pweb_read_more_link' );

function pweb_read_more_link() {
    return '... <p class="text-center"><a class="read-more button tiny round" href="' . get_permalink() . '">' . __('Read More', 'properweb') . '</a></p>';
}
