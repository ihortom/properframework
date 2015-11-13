<?php
/**
 * The Page template
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
?>

<?php get_header(); ?>

<div class="row row-with-sidebar">
    <div class="cell">
        <div class="article article-with-sidebar box full-width">
            <h2 class="title"><?php _e( 'Search results for:', 'properweb' ); printf( ' "%s"', get_search_query() ); ?></h2>
            <?php if ( have_posts() ) : ?>			
                <?php while ( have_posts() ) : the_post(); ?>
                <h3><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h3>
                <?php the_excerpt(); ?><br>
                <?php endwhile; ?>
                <?php 
                    // Previous/next page navigation.
                    pweb_posts_pagination( array(
                            'mid_size'      => 2,
                            'prev_text'     => '<i class="fa fa-angle-double-left"></i>',
                            'next_text'     => '<i class="fa fa-angle-double-right"></i>'
                    ) );
                ?>
            <?php else : ?>
                <div class="er404">
                    <h3>Search returned no result</h3>
                    <p>Try to use different keywords or check out the list of pages and posts located to the right of this text.</p>
                </div>
            <?php endif; ?>
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
