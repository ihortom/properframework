<?php
/**
 * Custom taxonomy
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 * @uses Meta Box: 'rwmb_meta_boxes' @see http://metabox.io/
 * @uses Single-Choice Post Taxonomy: 'pweb_post_type' @see ../../mu-plugins/pweb_single_choice_tax.php
 */
?>

<?php get_header(); ?>

<div class="row row-with-sidebar">
    <div class="cell">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
        <div class="article article-with-sidebar box full-width">
            <h2 class="title"><a class="to-article" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="row meta-data">
                <p class="small-12 columns secondary">
                <time datetime="<?php the_date(); ?>" class="post-date">
                        <?php the_time( get_option( 'date_format' ) ); ?>
                </time>
                </p>
                <p class="line small-12 columns"></p>
            </div>
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'thumbnail', array( 'class' => 'thumbnail alignleft') );
                }
                the_excerpt(); 
            ?>
        </div>
<?php endwhile; else : ?>
        <div class="article article-with-sidebar box full-width er404">
            <h2 class="title"><?php _e('No news','properweb'); ?></h2>
            <h3><?php _e('We currently have no news to share','pweb'); ?></h3>
            <p><?php _e('A news article will appear soon','properweb'); ?></p>
        </div>
<?php endif; ?>
    </div>
    <div id="aside" class="right-sidebar">
        <div  class="box with-pads">
            <ul id="aside-sidebar" class="sidebar">
                <?php get_sidebar('default'); ?>    
                <?php dynamic_sidebar( 'Post Aside' ); ?>
            </ul>
        </div>
    </div>
</div>	
<?php get_footer(); ?>
