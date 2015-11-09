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
            <time datetime="<?php the_date(); ?>" class="post-date">
                    <?php the_time( get_option( 'date_format' ) ); ?>
            </time>
            </time>
            <p class="line"></p>
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'thumbnail', array( 'class' => 'thumbnail alignleft') );
                }
                the_excerpt(); 
            ?>
        </div>
<?php endwhile; else : ?>
        <div class="article article-with-sidebar box full-width er404">
            <h2 class="title">No post submitted</h2>
            <h3>Sorry, this category contains no post</h3>
            <p>The corresponding content will be added later on.</p>
        </div>
<?php endif; ?>
    </div>
    <div id="aside" class="right-sidebar">
        <div  class="box with-pads">
            <ul id="aside-sidebar" class="sidebar">
                    <?php dynamic_sidebar( 'Post Aside' ); ?>
            </ul>
        </div>
    </div>
</div>	
<?php get_footer(); ?>
