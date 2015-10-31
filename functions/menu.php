<?php
/**
 * Register primary menu of the theme
 */
register_nav_menus( 
	array('primary' => __('Above the content'))	//theme location
);

//add a parent class for menu item
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );

function add_menu_parent_class( $items ) {
	
    $parents = array();
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'has-dropdown'; //class required by 'foundation'
        }
    }

    return $items;    
}

// add custom class to submenu (required for 'foundation')
add_filter('wp_nav_menu','change_submenu_class'); 

function change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/','/ class="sub-menu dropdown"/',$menu);  
  return $menu;  
}

//add class for active/current menu item (required for 'foundation')
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active';
     }
     return $classes;
}

?>