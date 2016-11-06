<?php
/**
 * Template Name: Page - Home Hero Blank
 * Description: Template for MavHub
 * Writer: Jonghwi, Lee
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="<?php echo get_stylesheet_directory_uri();?>/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="<?php echo get_stylesheet_directory_uri();?>/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="<?php echo get_stylesheet_directory_uri();?>/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed"
          href="<?php echo get_stylesheet_directory_uri();?>/assets/ico/apple-touch-icon-57-precomposed.png">
    <?php wp_head(); ?>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="/assets/js/slick.css"/>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
</head>
<div class="span8" id="pageboxline">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <br>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div>