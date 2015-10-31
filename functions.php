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
    $content_width = 1000;
}
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

// Add relevant stylesheets and scripts within <head> tags (register scripts and stylesheets)
require_once(get_template_directory().'/functions/enqueue-scripts.php'); 

// Add menu compatible with 'foundation' framework
require_once(get_template_directory().'/functions/menu.php'); 

// Register new custom fields in Settings > General
require_once(get_template_directory().'/functions/admin.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/functions/sidebars.php'); 

// Customize Guest Book (Comments)
require_once(get_template_directory().'/functions/gbook.php'); 

// Add support for meta tags (custom fields)
require_once(get_template_directory().'/functions/meta.php'); 

// Customize login page
require_once(get_template_directory().'/functions/login.php'); 

// Theme support (featured image)
require_once(get_template_directory().'/functions/theme-support.php'); 

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

?> 
