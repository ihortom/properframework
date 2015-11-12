<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action( 'wp_enqueue_scripts', 'pweb_scripts_and_styles' );

function pweb_scripts_and_styles() {
    
    // Removes WP version of jQuery
    wp_deregister_script('jquery');
	
    // Loads jQuery from vendor directory in footer
    wp_enqueue_script( 
        'jquery', 
        get_template_directory_uri() . '/js/vendor/jquery.js', array(), '2.1.4', true );
    
    wp_enqueue_script(
        'modernizr',
        get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', true
    );
    wp_enqueue_script( 
        'foundation', 
        get_template_directory_uri() . '/js/foundation.min.js', 
        array( 'jquery' ), '', true 
    );
    // Adding scripts file in the footer
    wp_enqueue_script( 
        'site-js', 
        get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true 
    );
    
    wp_register_style('normalize', get_stylesheet_directory_uri().'/css/normalize.css');
    
    wp_enqueue_style(
        'foundation', 
        get_template_directory_uri().'/css/foundation.css',
        array( 'normalize' )
    );

    wp_enqueue_style(
        'site-css', 
        get_stylesheet_directory_uri().'/style.css',
        array( 'normalize' )
    );
}

?>
