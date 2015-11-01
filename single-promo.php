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
 
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<?php if ( has_post_thumbnail() ) { 
	
		$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id() ); } ?>	
		<div class="box mid-width article">
			<h2 class="title"><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
		
	<?php endwhile; else : ?>
	
		<div class="box mid-width er404">
			<h2 class="title">No post</h2>
			<h3>Sorry, this category contains no post yet.</h3>
			<p>Content will be added soon.</p>
		</div>
		
	<?php endif; ?>
		
<?php get_sidebar(); ?>

<?php get_footer(); ?>