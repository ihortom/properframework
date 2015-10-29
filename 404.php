<?php/** * The template for displaying 404 pages (Not Found) * * @package ProperWeb * @subpackage ProperFramework 1.0 * @since ProperFramework 1.0 */?><?php get_header(); ?>
	<div id="aside" class="box">		<ul id="aside-sidebar" class="sidebar">			<?php dynamic_sidebar( 'Page Aside' ); ?>		</ul>	</div>
	<div class="box mid-width er404">		<h2 class="title">Document not found</h2>		<h3>Sorry, the page you were looking for was not found.</h3>		<p>Try to use search.</p>	</div>
<?php get_footer(); ?>