<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action( 'wp_enqueue_scripts', 'pweb_scripts' );

function pweb_scripts() {
    wp_register_style('normalize', get_stylesheet_directory_uri().'/css/normalize.css');
    wp_enqueue_style(
        'foundation', 
        get_stylesheet_directory_uri().'/css/foundation.min.css',
        array( 'normalize' )
    );
    wp_enqueue_style(
        'app', 
        get_stylesheet_directory_uri().'/css/app.css',
        array( 'normalize' )
    );
    wp_enqueue_style(
        'properframework', 
        get_stylesheet_directory_uri().'/style.css',
        array( 'normalize' )
    );
    wp_enqueue_script(
        'modernizr',
        get_stylesheet_directory_uri() . '/js/vendor/modernizr.js'
    );    
    //add /js/menu.js to the <head> catering for its dependancy on jQuery
//    wp_enqueue_script(
//        'pweb_menu',
//        get_stylesheet_directory_uri() . '/js/menu.js',
//        array( 'jquery' )
//    );
}

?>
