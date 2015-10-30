<?php
/**
 * The theme functions
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 * @uses Meta Box: 'rwmb_meta_boxes' @see http://metabox.io/
 * @uses Single-Choice Post Taxonomy: 'pweb_post_type' @see ../../mu-plugins/pweb_single_choice_tax.php
 */
?>
<?php

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
    $content_width = 993;
}
/* HEAD */

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

/**
 * Add relevant stylesheets and scripts within <head> tags
 */
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

add_action( 'wp_enqueue_scripts', 'pweb_scripts' );

/* HEADER */

/*** Menu ***/

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

/* SHORTCODES */

/* CUSTOM
//create shortcode to make a separator of the new article within the page
add_shortcode('royalfit', 'pwrf_royal_fit');
//usage [royalfit]
function pwrf_royal_fit() {
	return '«<strong><em><span style="color: #ed008c;">Royal Fit</span></em></strong>»';
}

//create shortcode to make a separator of the new article within the page
add_shortcode('article', 'pweb_article');

//usage [article title=""]
function pweb_article( $atts ) {
	return '<h2 class="title">' . $atts[title] . '</h2>';
}
*/

//create shortcode for promotions to use image background
add_shortcode('promo', 'pweb_promo');

//usage [promo start="mm/dd/yy" end="mm/dd/yy" height="px" bgsize="%" line=""]
function pweb_promo( $atts, $content = null  ) {
    global $featured_image_url;
    $regex = "/^[0-1][0-9]\/[0-3][0-9]\/[1-2][0-9]$/";	//american format
    $dated = true;
    $start = 0;
    $end = 0;
    preg_match($regex, trim($atts[start]), $start_date);
    preg_match($regex, trim($atts[end]), $end_date);
    try {
        if ( array_key_exists('start',$atts) && array_key_exists('end',$atts) ) {
                $start = new DateTime($start_date[0]);
                $end = new DateTime($end_date[0]);
        }
        elseif ( array_key_exists('start',$atts) ) {
                $start = new DateTime($start_date[0]);
        }
        elseif (array_key_exists('end',$atts) ) {
                $end = new DateTime($end_date[0]);
        }
        else $dated = false;
    }
    catch (Exception $e) { $dated = false; }

    if ( $dated ) { 
        if ( $start && $end ) {
                $range = date_format($start, get_option( 'date_format' )) . ' – '. date_format($end, get_option( 'date_format' ));
        }
        elseif ( $start ) $range = date_format($start, get_option( 'date_format' ));
        else $range = __('till ') . date_format($end, get_option( 'date_format' ));
        $period = '<div class="promo-date">'. $range .'</div><p class="line"></p>';
    }
    else $period = '';
    return ($period . '<div class="promo" style="height:'.$atts[height].'px;background-size:'.$atts[bgsize].'%; background-image: url('.$featured_image_url.'); line-height:'.$atts[line].'">'. $content . '</div>');
}


/* ADMIN MENU */

//register new custom field in Settings > General
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

/* BODY */

//replace [...] in excerpt
function pweb_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('»»»', 'properweb') . '</a><br />';
}
add_filter('excerpt_more', 'pweb_excerpt_more');

//gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);

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

<?php 
//custom gbook comment function
function pwrf_gbook_comment ($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-container">
                <div class="comment-avatar">
    <?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
            </div>
                <div class="comment-text">
                    <header class="comment-author">
                        <span class="author"><?php printf(__('<cite>%s</cite>','wip'), get_comment_author()) ?></span><br>
                        <time datetime="<?php echo get_comment_date("c")?>" class="comment-date">  
                                <?php 
                                        printf(__('%1$s %2$s','wip'), get_comment_date(),  get_comment_time()); 
                                ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php
                                        edit_comment_link(__('(Edit)','wip')); 
                                ?>
                        </time>
                    </header>
                    <?php if ($comment->comment_approved == '0') : ?>
                             <br /><em><?php _e('Your comment is awaiting approval.','wip') ?></em>
                    <?php endif; ?>

                    <?php comment_text() ?>

                </div>

                <div class="clearfix"></div>
            </div>
<?php } ?>

<?php
/**
 * Registering meta boxes. "Meta box" plug-in has to be activated (https://wordpress.org/plugins/meta-box/).
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */

add_filter( 'rwmb_meta_boxes', 'pweb_register_meta_boxes' );

function pweb_register_meta_boxes( $meta_boxes )
{
    /**
     * prefix of meta keys (optional)
     * Use underscore (_) at the beginning to make keys hidden
     * Alt.: You also can make prefix empty to disable it
     */
    // Better has an underscore as last sign
    $prefix = 'pweb_';

    // 1st meta box
    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id'         => 'meta_data',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title'      => __( 'Мета-теги', 'meta-box' ),

        // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
        'post_types' => array( 'post', 'page' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context'    => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority'   => 'high',

        // Auto save: true, false (default). Optional.
        'autosave'   => true,

        // List of meta fields
        'fields'     => array(
            // TEXT
            array(
                // Field name - Will be used as label
                'name'  => __( 'Заголовок', 'meta-box' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}title",
                // Field description (optional)
                'desc'  => __( 'Tег "title". По умолчанию изпользуется заголовок статьи/страницы.', 'meta-box' ),
                'type'  => 'text',
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
                'size' => 60,
            ),
            // TEXTAREA
            array(
                'name' => __( 'Описание', 'meta-box' ),
                'desc' => __( 'Мета-тег "description". Рекоммендуемая длина до 155 символов.', 'meta-box' ),
                'id'   => "{$prefix}description",
                'type' => 'textarea',
                'cols' => 20,
                'rows' => 3,
            ),
            // TEXTAREA
            array(
                'name' => __( 'Ключевые слова', 'meta-box' ),
                'desc' => __( 'Мета-тег "keywords". Рекоммендуемая длина до 170 символов (5-10 слов).', 'meta-box' ),
                'id'   => "{$prefix}keywords",
                'type' => 'textarea',
                'cols' => 20,
                'rows' => 3,
            ),
        ),
    );
    return $meta_boxes;
}
?>
<?php
/* LOGIN FORM */
//Customizing the Login Form: https://codex.wordpress.org/Customizing_the_Login_Form
function pweb_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/crown.png) !important;
            padding-bottom: 5px;
        }
    </style>
<?php } 
add_action( 'login_enqueue_scripts', 'pweb_login_logo' );

?>
