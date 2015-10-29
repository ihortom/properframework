<?php/** * The Post template * * @package ProperWeb * @subpackage ProperFramework * @since ProperFramework 1.0 */?>
<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="featured-image">		<?php if ( has_post_thumbnail() ) : ?>			<?php	the_post_thumbnail( 'post-featured-image' ); ?>		<?php endif; ?>	</div>
	<div class="box mid-width article">		<h2 class="title"><?php the_title(); ?></h2>		<?php 			the_content(); 			if (comments_open()) comments_template();		?>	</div>
<?php endwhile; endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>