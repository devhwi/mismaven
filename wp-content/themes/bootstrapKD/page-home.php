<?php
/**
 * Template Name: Page - Home Hero
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); 
?>
<header class="jumbotron subhead" id="overview">
    <div class="container">
        <h1>
            <?php the_title(); ?></h1>
    </div>
</header>

<div class="containerfluid">
   <div class="row-fluid">
        <div class="span2" id="widgetright">
            <?php
            if (function_exists('dynamic_sidebar')) {
                dynamic_sidebar("home-left");
            } ?>
        </div>

        <div class="span7">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <h1><?php the_title();?></h1>
                <?php the_content(); ?>


    <?php endwhile; endif; ?>
        </div>

        <div class="span3" id="pagebox">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/customer.PNG" alt="customer">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/admin.PNG" alt="admin">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact_us.PNG" alt="contact">
        </div>

    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>