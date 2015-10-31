<?php

/*** Register widgetized areas ***/

add_action( 'widgets_init', 'pweb_theme_widgets_init' );

function pweb_theme_widgets_init() {
    register_sidebar(
        array(
            'name'          => __( 'Header', 'properweb' ),
            'id'            => 'header_sidebar',
            'description'   => __('Widget area at the top of the home page.'),
            'class'         => 'header',
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '' 
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Footer', 'properweb' ),
            'id'            => 'footer_sidebar',
            'description'   => __('Widget area in the footer.'),
            'class'         => 'footer',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>' 
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Page Aside', 'properweb' ),
            'id'            => 'page_aside_sidebar',
            'description'   => __('Page side widget area.'),
            'class'         => 'aside',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>' 
        )
    );

    register_sidebar(
        array(
            'name'          => __( 'Post Aside', 'properweb' ),
            'id'            => 'post_aside_sidebar',
            'description'   => __('Post side widget area.'),
            'class'         => 'aside',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>' 
        )
    );
}

?>