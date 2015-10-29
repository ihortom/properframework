<?php/** * The Page template * * @package ProperWeb * @subpackage ProperFramework * @since ProperFramework 1.0 */?><?php get_header(); ?>
	<div id="aside" class="box">		<ul id="aside-sidebar" class="sidebar">			<?php dynamic_sidebar( 'Page Aside' ); ?>		</ul>	</div>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="box mid-width article">		<h2 class="title"><?php the_title(); ?></h2>		<?php 			the_content(); 			if (comments_open()) comments_template();		?>	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>