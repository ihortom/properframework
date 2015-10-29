<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "content" div.
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <title>
        <?php 
            if (is_front_page() || is_home()) { 
                bloginfo('name'); 
                if (get_option('main_service_type')) { echo ' | '; echo get_option('main_service_type'); }
                elseif (get_option('blogdescription')) { echo ' | '; echo get_option('blogdescription'); }
            }
            else {
                if ( function_exists('rwmb_meta') && rwmb_meta('pweb_title') ) {
                    echo rwmb_meta( 'pweb_title' ); echo " | "; bloginfo('name'); 
                }
                elseif ( get_the_title()) { the_title(); echo ' | '; bloginfo('name'); }
                else { bloginfo('name'); }
            }
        ?>
    </title>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="description" content="<?php if (function_exists('rwmb_meta')) { if (rwmb_meta('pweb_description')) echo rwmb_meta("pweb_description");} ?>" />
    <meta name="author" content="I. Tomilenko, ProperWeb" />
    <meta name="keywords" content="<?php if (function_exists('rwmb_meta')) { if (rwmb_meta('pweb_keywords')) echo rwmb_meta("pweb_keywords");} ?>" />

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans|Philosopher:400,700,400italic,700italic&subset=latin,cyrillic' >
    <link rel="stylesheet" type='text/css' href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <?php
            wp_head();
    ?>
</head>

<body>
	<div id="cap">	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/cap_left.png"></div>
	<div id="wrap">
		<div id="header">
			<div id="logo">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/crown.png">
				<h1 id="who"><?php bloginfo('name'); ?></h1>
				<h2 id="what"><?php echo get_option('main_service_type'); ?></h2>
				<h3 id="why"><?php bloginfo('description'); ?></h3>
			</div>
			<!--
			<?php if (is_active_sidebar( 'header_sidebar' )) : ?> 
				<div id="slider">
						<?php dynamic_sidebar( 'Header' ); ?>
				</div>
			<?php endif; ?>
			-->
		</div>

		<?php 
			if (has_nav_menu('primary')) wp_nav_menu( array('theme_location'=>'primary', 'container_id'=>'topmenu', 'depth'=>'2', 'link_before'=>'<span>', 'link_after'=>'</span>',) ); 
		?>

		<div id="content">
		
		<!-- Breadcrumb NavXT -->	
		<?php 
			if (!(is_front_page() || is_home())): 
				if (function_exists('bcn_display') && have_posts()) : ?>
				<div id="nav" class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
					<?php	bcn_display(); ?>
				</div>	
				<?php	endif; ?>
		<?php endif; ?>
	
		