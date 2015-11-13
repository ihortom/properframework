<?php
/*
 * The template for displaying the footer
 *
 * Contains the closing of the "content" div and all content after.
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
?>
        
                    <!-- close the off-canvas menu -->
                    <a class="exit-off-canvas"></a>
                </div>
            </div>

        </div><!-- #content -->
        
        <div id="footer">
            <?php if (is_active_sidebar( 'footer_sidebar' )) : ?> 
                <ul id="footer-sidebar" class="sidebar">
                    <?php dynamic_sidebar( 'Footer' ); ?>
                </ul>
            <?php endif; ?>
            <div id="copyright">Copyright &copy; 
                <?php 
                    if (get_option('online_since_year')) { 
                            echo get_option('online_since_year'); 
                            if (date('Y') != get_option('online_since_year')) echo ' - '.date('Y').' '; 
                    }
                    else { echo date('Y').' '; }
                    echo bloginfo('name'); 
                ?> | <?php _e('All rights reserved','properweb'); ?> | <?php _e('Developed by','properweb');?> <a href="https://www.properweb.ca">ProperWeb</a> | Tomilenko Company</div>
        </div>
    </div><!-- #wrap -->
    <?php wp_footer(); ?>
</body>
</html>