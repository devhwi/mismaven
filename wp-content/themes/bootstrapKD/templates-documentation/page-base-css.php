<?php
/**
 * Template Name: Documentation - Base CSS Styles
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
wp_enqueue_script('prettify-js');
wp_enqueue_style('prettify-css');
wp_enqueue_style('docs-css');
?>
<?php while (have_posts()) : the_post(); ?>


	<div class="container">
		<div class="row">
			<div class="span3 bs-docs-sidebar">
				<ul class="nav nav-list bs-docs-sidenav">
					<li><a href="http://savior.dothome.co.kr/index.php/about-us/"><i class="icon-chevron-right"></i> Typography</a></li>
					<li><a href="#code"><i class="icon-chevron-right"></i> Code</a></li>
					<li><a href="#tables"><i class="icon-chevron-right"></i> Tables</a></li>
					<li><a href="#forms"><i class="icon-chevron-right"></i> Forms</a></li>
					<li><a href="#buttons"><i class="icon-chevron-right"></i> Buttons</a></li>
					<li><a href="#images"><i class="icon-chevron-right"></i> Images</a></li>
					<li><a href="#icons"><i class="icon-chevron-right"></i> Icons by Glyphicons</a></li>
				</ul>
			</div>
			<div class="span9">
				<section id="typography">
					<div class="page-header">

				</section>
			</div>
		</div>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>