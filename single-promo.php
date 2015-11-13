<?php
/** 
 * The Category template for Promotions
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
 ?>
 
<?php get_header(); ?>
 
<div class="row row-with-sidebar">
    <div class="cell">
        
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
            <div class="article article-with-sidebar box full-width">
                <?php if ( has_post_thumbnail() ) { 
                //featured image is to be used in the background
                $featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() ); } ?>	

                <h2 class="title"><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </div>
		
	<?php endwhile; else : ?>
            <div class="article article-with-sidebar box full-width">
                <?php include_once 'parts/no-post.php'; ?>
            </div>
		
	<?php endif; ?>
    </div>	
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>