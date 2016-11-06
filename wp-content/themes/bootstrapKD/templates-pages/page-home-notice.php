<?php
/**
 * Template Name: Page - Home Hero Notice
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
?>
<style>
.box2 {
    height: 100%;
    width:90%;
    background-color:#f4f4f4;
}
    .box4 {
        display:table;
        margin-top:10px;
        margin-left:15px;
        float:left;
        height:70px;
        width:35%;
        background-color: #887a65;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;   
    }
    .box5 {
        display:table;
        margin-top:10px;
        float:left;
        height:70px;
        width:55%;
        background-color: #dedede;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
    }
    .box6 {
        display:table;
        margin-top:10px;
        margin-left:15px;
        float:left;
        height:70px;
        width:35%;
        background-color: #ad9370;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;   
    }
    .box3:after {
        content: "";
        display: table;
        clear: both;
    }
    .box4 p {
        font-size:12px;
        color: white;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
    .box5 p {
        font-size: 16px;
        color: black;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
    .box6 p {
        font-size:12px;
        color: white;
        display:table-cell; 
        text-align:center; 
        vertical-align:middle;
    }
</style>


<div class="container">
    <div class="row-fluid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <br>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div><!--/.row -->
</div><!--/.container -->

<?php get_footer(); ?>