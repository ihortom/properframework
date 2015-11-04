<?php
/**
 * 
 */
?>

<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">

        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>
        </nav>

        <!-- Off Canvas Menu -->
        
            <nav class="left-off-canvas-menu">
                <ul class="off-canvas-list">
                    <?php 
                        if (has_nav_menu('primary')) {
                            $offcanvas =
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'depth'          => '2', 
                                'link_before'    => '', 
                                'link_after'     => '',
                                'items_wrap'     => '%3$s',  //remove <ul> container
                                'echo'           => false
                            ) );
                        }
                        $offcanvas = preg_replace('/ dropdown"/',' left-submenu"><li class="back"><a href="#">Back</a></li', $offcanvas);
                        $offcanvas = preg_replace('/has-dropdown/','has-submenu', $offcanvas);
                        echo $offcanvas;
                    ?>
                </ul>
            </nav>
        