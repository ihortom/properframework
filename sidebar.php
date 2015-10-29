<?php
/**
 * The sidebar containing the main widget area on Post
 *
 * @package ProperWeb
 * @subpackage ProperFramework
 * @since ProperFramework 1.0
 */
 ?>

<div id="aside" class="box">
	<ul id="aside-sidebar" class="sidebar">
		<?php dynamic_sidebar( 'Post Aside' ); ?>
		
		<?php if ( is_single() ) : ?>
		<li class="widget">		
			<?php
				$categories = get_the_category();
				if ($categories) : ?>
					<h3 class="widget-title">Other posts of this category</h3>
						<ul>
							<?php foreach ($categories as $category) :
								$args=array(
									'cat' => $category->cat_ID,
									'post__not_in' => array($post->ID),
									'posts_per_page'=>10,
									'caller_get_posts'=>1
								);
									$the_query = new WP_Query($args);
									if( $the_query->have_posts() ) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
										<li class="page_item page-item-<?php echo $post->ID; ?>"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Navigate to the page '<?php the_title_attribute(); ?>'"><?php the_title(); ?></a></li>
										 <?php
									endwhile; endif; //if ($the_query)
								endforeach; //foreach
							endif; //if ($categories) ?>
						</ul>
					<?php wp_reset_query();  // Restore global post data stomped by the_post().
				else : ?>
				<p>This is the only post of this category</p>
			<?php endif; //if (is_single()) ?>
		</li>
	</ul>
</div>
