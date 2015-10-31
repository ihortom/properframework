<?php
/* LOGIN FORM */
//Customizing the Login Form: https://codex.wordpress.org/Customizing_the_Login_Form
function pweb_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png) !important;
            padding-bottom: 5px;
        }
    </style>
<?php } 
add_action( 'login_enqueue_scripts', 'pweb_login_logo' );

// Calling your own login css so you can style it
function pweb_login_css() {
	wp_enqueue_style( 'pweb_login_css', get_template_directory_uri() . '/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function pweb_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function pweb_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'pweb_login_css', 10 );
add_filter('login_headerurl', 'pweb_login_url');
add_filter('login_headertitle', 'pweb_login_title');
?>