<?php/** * The Page template * * @package ProperWeb * @subpackage ProperFramework * @since ProperFramework 1.0 */?>
<?php get_header(); ?>
<div id="aside" class="box">	<ul id="aside-sidebar" class="sidebar">		<?php dynamic_sidebar( 'Page Aside' ); ?>	</ul></div>
<?php if(have_posts()): while(have_posts()): the_post(); ?>	<div class="box mid-width article">		<h2 class="title"><a class="to-article" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>		<?php if ( has_post_thumbnail() ) : ?>			<?php	the_post_thumbnail( 'thumbnail', array( 'class' => 'thumbnail alignleft') ); ?>		<?php endif; ?>		<?php 			the_excerpt(); 		?>	</div>
<?php endwhile; else : ?>	<div class="box mid-width er404">		<h2 class="title">No post submitted</h2>		<h3>Sorry, this category contains no post</h3>		<p>The corresponding content will be added later on.</p>	</div><?php endif; ?>
<?php get_footer(); ?>