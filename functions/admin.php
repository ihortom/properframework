<?php
/* ADMIN MENU */

//register new custom fields in Settings > General
add_action('admin_init', 'pweb_general_section');  

function pweb_general_section() {  
    add_settings_section(  
        'organization_section', // Section ID 
        __('Organization/Business'), // Section Title
        'pweb_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( 
        'main_service_type', // Option ID
        __('Main activity/service'), // Label
        'pweb_organization_type_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'organization_section', // Name of our section
        array( // The $args
            'main_service_type' // Should match Option ID
        )  
    ); 
		
		add_settings_field( 
        'online_since_year', // Option ID
        __('Online presence since (year)'), // Label
        'pweb_online_since_year_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'organization_section', // Name of our section
        array( // The $args
            'online_since_year' // Should match Option ID
        )  
    ); 

    register_setting('general','main_service_type', 'esc_attr');
		register_setting('general','online_since_year', 'esc_attr');
}
/*
function pwrf_section_options_callback() { // Section Callback
    echo '<p>A little message on editing info</p>';  
}
*/
function pweb_organization_type_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" class="regular-text" name="'. $args[0] .'" value="' . $option . '" />';
		echo '<br><p><em>'; _e('The phrase will appear in the header'); echo '</em></p>';
}

function pweb_online_since_year_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
		echo '<br><p><em>'; _e('The year will appear in the footer'); echo '</em></p>';
}

?>