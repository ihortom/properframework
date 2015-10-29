<?php get_header(); ?>
	<div id="aside" class="box">		<ul id="aside-sidebar" class="sidebar">			<?php dynamic_sidebar( 'Aside' ); ?>		</ul>	</div>
<?php if (have_posts()): while(have_posts()): the_post(); ?>	<div class="box mid-width article">		<h2 class="title"><?php the_title(); ?></h2>		<?php the_content(); ?>	</div>	
<?php endwhile; endif; ?>
<?php get_footer(); ?>