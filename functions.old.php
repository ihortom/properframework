<?php
/**
 * The theme functions
 *
 * @package ProperWeb
 * @subpackage RoyalFit
 * @since RoyalFit 1.0
 */
?>
<?php

//add /js/menu.js to the <head> catering for its dependancy on jQuery
function pwrf_menu() {
	wp_enqueue_script(
		'pwrf_menu',
		get_stylesheet_directory_uri() . '/js/menu.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'pwrf_menu' );

//register primary menu of the theme
register_nav_menus( array('primary' => 'Меню под логотипом') );

//create shortcode to make a separator of the new article within the page
add_shortcode('article', 'pwrf_article');

//usage [article title=""]
function pwrf_article( $atts ) {
	return '<h2 class="title">' . $atts[title] . '</h2>';
}

//create shortcode for promotions to use image background
add_shortcode('promo', 'pwrf_promo');

//usage [promo start="mm/dd/yy" end="mm/dd/yy" height="px" bgsize="%" line=""]
function pwrf_promo( $atts, $content = null  ) {
	global $featured_image_url;
	$regex = "/^[0-1][0-9]\/[0-3][0-9]\/[1-2][0-9]$/";
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
		else $range = 'до ' . date_format($end, get_option( 'date_format' ));
		$period = '<div class="promo-date">'. $range .'</div><p class="line"></p>';
	}
	else $period = '';
	return ($period . '<div class="promo" style="height:'.$atts[height].'px;background-size:'.$atts[bgsize].'%; background-image: url('.$featured_image_url.'); line-height:'.$atts[line].'">'. $content . '</div>');
}

//create shortcode to make a separator of the new article within the page
add_shortcode('royalfit', 'pwrf_royal_fit');
//usage [royalfit]
function pwrf_royal_fit() {
	return '«<strong><em><span style="color: #ed008c;">Royal Fit</span></em></strong>»';
}

//register new custom field in Settings > General
add_action('admin_init', 'pwrf_general_section');  

function pwrf_general_section() {  
    add_settings_section(  
        'organization_section', // Section ID 
        'Организация/Бизнес', // Section Title
        'pwrf_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( 
        'main_services_type', // Option ID
        'Основной вид предоставляемых услуг', // Label
        'pwrf_organization_type_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'organization_section', // Name of our section
        array( // The $args
            'main_services_type' // Should match Option ID
        )  
    ); 
		
		add_settings_field( 
        'online_since_year', // Option ID
        'Год, когда организация появилась online', // Label
        'pwrf_online_since_year_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'organization_section', // Name of our section
        array( // The $args
            'online_since_year' // Should match Option ID
        )  
    ); 

    register_setting('general','main_services_type', 'esc_attr');
		register_setting('general','online_since_year', 'esc_attr');
}
/*
function pwrf_section_options_callback() { // Section Callback
    echo '<p>A little message on editing info</p>';  
}
*/
function pwrf_organization_type_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
		echo '<br> <p><em>Основной вид предоставляемых услуг.</em></p>';
}

function pwrf_online_since_year_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
		echo '<br> <p><em>Год, когда организация появилась online.</em></p>';
}

//replace [...] in excerpt
function pwrf_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('»»»', 'royalfit') . '</a><br />';
}
add_filter('excerpt_more', 'pwrf_excerpt_more');

//register sidebars
register_sidebar(
	array(
		'name'          => __( 'Footer', 'theme_text_domain' ),
		'id'            => 'footer_sidebar',
		'description'   => 'Панель виджетов расположенная внизу страницы',
		'class'         => 'footer',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>' 
	)
);

register_sidebar(
	array(
		'name'          => __( 'Page Aside', 'theme_text_domain' ),
		'id'            => 'page_aside_sidebar',
		'description'   => 'Панель виджетов расположенная справа от основного контента страницы.',
		'class'         => 'aside',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>' 
	)
);

register_sidebar(
	array(
		'name'          => __( 'Post Aside', 'theme_text_domain' ),
		'id'            => 'post_aside_sidebar',
		'description'   => 'Панель виджетов расположенная справа от основного контента записи.',
		'class'         => 'aside',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>' 
	)
);

//featured image
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_image_size( 'post-featured-image', 993, 200, true ); // (hard-cropped)
add_filter( 'image_size_names_choose', 'pwrf_custom_sizes' );

function pwrf_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'your-custom-size' => __( 'Размер главного изображения записи' ),
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
							edit_comment_link(__('(Редактировать)','wip')); 
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

add_filter( 'rwmb_meta_boxes', 'pwrf_register_meta_boxes' );

function pwrf_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'pwrf_';

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
function pwrf_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/crown.png) !important;
            padding-bottom: 5px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'pwrf_login_logo' );
?>