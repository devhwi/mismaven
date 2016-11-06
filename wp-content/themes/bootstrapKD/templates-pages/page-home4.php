
<?php
/**
 * Template Name: Page - Home Hero4
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>




<div class="container-fluid">
   <div class="row-fluid">
    <header>
  <div class='container'>
    <h1>MAVEN 멤버</h1>
    <p>MAVEN 멤버소개</p>
  </div>
</header>
<div class="container">
  <div class="row">
        <div class="span8" id="pageboxline">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <br>
                <?php the_content(); ?>
    <?php endwhile; endif; ?>
        </div>

</div>
</div>


    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>