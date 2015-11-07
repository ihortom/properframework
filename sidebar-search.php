<?php
/**
 * The sidebar containing the main widget area on Post
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
 ?>

    <li class="widget">
        <?php get_search_form(); ?>
    </li>       

    <li class="widget">		
        <h3>Posts you might be interested in:</h3>
        <ul>
            <?php
                $args = array( 
                    'numberposts' => '20',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'post_type' => 'post'
                );
                $recent_posts = wp_get_recent_posts( $args );
                foreach( $recent_posts as $recent ){
                    echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a></li> ';
                }
            ?>
        </ul>
    </li>
    <?php 
        dynamic_sidebar( 'Post Aside' );
    ?>
