<?php
/**
 * Template Name: Page - Full-width
 * Description: Displays a page title and content without displaying a sidebar.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="container">
        <div class="row">
            <div class="span12">
                <?php if (function_exists('bootstrapwp_breadcrumbs')) {
                bootstrapwp_breadcrumbs();
                } ?>
            </div><!--/.span12 -->
        </div><!--/.row -->

        <div class="row-fluid">

            <?php the_content(); ?>
            <?php endwhile; // end of the loop. ?>

        </div>
    </div>

    </div><!--/.container -->

<?php get_footer(); ?>