<?php/** * The Page template * * @package ProperWeb * @subpackage ProperFramework * @since ProperFramework 1.0 */?>
<?php get_header(); ?>
	<div class="box mid-width article">		<h2 class="title"><?php printf( __( 'Search result: "%s"', 'properweb' ), get_search_query() ); ?></h2>		<?php if ( have_posts() ) : ?>						<?php while ( have_posts() ) : the_post(); ?>			<h3><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></h3>			<?php the_excerpt(); ?><br>			<?php endwhile; ?>			<?php 				// Previous/next page navigation.				the_posts_pagination( array(					'prev_text'          => __( 'Previous page', 'properweb' ),					'next_text'          => __( 'Next page', 'properweb' ),					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'properweb' ) . ' </span>',				) );			?>		<?php else : ?>
		<div class="er404">			<h3>Search returned no result</h3>			<p>Try to use different keywords or check out the list of pages and posts located to the right of this text.</p>
		</div>
		<?php endif; ?>
	</div>
	<div id="aside" class="box">		<ul id="aside-sidebar" class="sidebar">			<?php dynamic_sidebar( 'Page Aside' ); ?>		</ul>	</div>
<?php get_footer(); ?>