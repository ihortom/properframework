<?php get_header(); ?>
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="box full-width article front-page">
		<h2 class="title"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>