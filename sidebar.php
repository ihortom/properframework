<?php
/**
 * The sidebar containing the main widget area on Post
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
 ?>

<div id="aside" class="right-sidebar">
    <div  class="box with-pads">
        <ul id="aside-sidebar" class="sidebar">
            <li class="widget">
                <?php get_search_form(); ?>
            </li>
            <?php if ( is_single() ) : ?>
            
            <?php $pweb_term = get_the_terms($post->ID, 'pweb_post_type');
            if ($pweb_term && !in_array($pweb_term[0]->name, array('Standard'))) : ?>
                <li class="widget">	
                <?php    
                    $args = array(
                        'post__not_in' => array($post->ID),
                        'posts_per_page'=>10,
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'pweb_post_type',
                                    'field'    => 'slug',
                                    'terms'    => $pweb_term[0]->slug
                                )
                        )
                    );
                    $current_pweb_term = $pweb_term[0]->name;
                $query = new WP_Query( $args );
                if( $query->have_posts() ) : ?>
                    <h3 class="widget-title">Recent <?php the_terms($post->ID, 'pweb_post_type'); ?></h3>
                    <ul>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <li class="page_item page-item-<?php echo $post->ID; ?>">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="Navigate to the post '<?php the_title_attribute(); ?>'"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>This is the only post of the category <?php the_terms($post->ID, 'pweb_post_type'); ?></p>
                <?php endif; 
                    wp_reset_query(); ?>
                </li>
            <?php endif; ?>
            
            
            <?php    
                $taxonomies = array( 
                    'category',
                    'pweb_post_type',
                );
                $args = array(
                    'orderby'           => 'name', 
                    'order'             => 'ASC',
                    'hide_empty'        => true, 
                );
                $terms = get_terms( $taxonomies, $args ); //Array of term objects
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
                <li class="widget">	    
                    <h3><?php echo (in_array($pweb_term[0]->name, array('Standard'))) 
                                ? __('Available ', 'properweb'): __('Other ', 'properweb'); ?> categories:</h3>
                    <ul>
                    <?php
                        foreach ( $terms as $term ) {
                            if ( ! in_array($term->name, array('Standard', 'Uncategorised', $current_pweb_term))) {
                                echo '<li><a href="'.get_term_link($term).'">' .$term->name.'</a></li>';
                            }
                        } ?>
                    </ul>
                </li> 
            <?php endif; ?>           
            
            <li class="widget">		
                <h3>Recent Posts</h3>
                <ul>
                    <?php
                        $args = array( 
                            'numberposts' => '10', 
                            'exclude' => $post->ID 
                        );
                        $recent_posts = wp_get_recent_posts( $args );
                        foreach( $recent_posts as $recent ){
                            echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a></li> ';
                        }
                    ?>
                </ul>
            </li>
            <?php endif; 
                dynamic_sidebar( 'Post Aside' );
            ?>
	</ul>
    </div>
</div>
