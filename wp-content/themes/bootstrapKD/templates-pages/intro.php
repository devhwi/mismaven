<?php
/**
 * Template Name: Page - intro
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>



<div class="container-fluid">
   <div class="row-fluid">

<?php 
    echo do_shortcode("[metaslider id=314]"); 
?>


    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>