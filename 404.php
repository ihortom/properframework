<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package ProperWeb
 * @subpackage ProperFramework 1.0
 * @since ProperFramework 1.0
 */
?>
<?php get_header(); ?>
    <div class="row row-with-sidebar">
        <div class="cell">
            <div class="article article-with-sidebar box full-width er404">
                    <h2 class="title"><?php _e('Document not found','properweb'); ?></h2>
                    <h3><?php _e('Sorry, the page you were looking for was not found.','properweb'); ?></h3>
                    <p><?php _e('It might have been removed or relocated. Try to use the search.','properweb'); ?></p>
            </div>
        </div>
        <div id="aside" class="right-sidebar">
            <div  class="box with-pads">
		<ul id="aside-sidebar" class="sidebar">
			<?php 
                        get_sidebar('search');
                        dynamic_sidebar( 'Page Aside' ); ?>
		</ul>
            </div>
	</div>
    </div>
<?php get_footer(); ?>
