<?php
/**
 * Description : Main Home
 * First Maker : Park Kyungdoo
 * Editted By  : Lee Jonghwi
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header();
?>

        <div class="container main1">
            <div class="row">
                <div class="span4 wall">
                    <p class="mainpa">MAVEN 리뉴얼중입니다.<span id="moremore"><a href="http://mismaven.kr/?page_id=48"><i class="fa fa-plus"></i></a></span></p>                 
                </div>

                <div class="span4 wall">
                    <p class="mainpa">공지사항<span id="moremore"><a href="http://mismaven.kr/?page_id=36"><i class="fa fa-plus"></i></a></span></p>
                    <?php echo do_shortcode('[kboard_latestview id=2]'); ?>                      
                </div>

                    <?php get_sidebar('blog2'); ?>
        		</div>
				</div>
                <div class="container">
                <div class="row">
                    <div class="span8 wall">
                        <?php 
                            echo do_shortcode("[metaslider id=92]"); 
                        ?>
                </div>
                 <?php get_sidebar('blog'); ?>
        </div>
            </div> 
<!--
        <div class="container">
            <div class="row">
                <div class="span4 wall">

                    </div>

                <div class="span4 wall">

                        <?php query_posts( array ( 'category_name' => 'insideact2', 'posts_per_page' => 1 ) ); ?>
                            <?php
                            $term_description = term_description();
                                if ( ! empty( $term_description ) ) :
                                    printf( '<div class="desc">%s</div>', $term_description );
                                endif;
                            ?>
                              <?php while ( have_posts() ) : the_post(); ?>
                                <div class="recommend">
                                    <?php // Post thumbnail conditional display.
                                    if ( bootstrapwp_autoset_featured_img() !== false ) : ?>
                                        
                                                <?php echo bootstrapwp_autoset_featured_img(); ?>
                                                <div class="text"><?php the_title();?></div>
                                           
                                        </div>
                                    <?php else : ?>

                                    <?php endif; ?>

                              <?php endwhile; ?>

                        <?php wp_reset_query(); ?>
                </div>
                 <?php get_sidebar('blog'); ?>
                </div>


            </div>
        </div>
    -->
        <div class="container" id="mainmargin">
            <h3 class="memberline">고려대학교 경영정보학과 개발소모임 MAVEN</h3>
        </div>

        <div class="container">
            <div class="row-fluid">
                <div class="span3 img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/main1.PNG" alt="main1">
                </div>
                <div class="span3 img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/main2.PNG" alt="main2">
                </div>
                <div class="span3 img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/main3.PNG" alt="main3">
                </div>
                <div class="span3 img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/main4.PNG" alt="main4">
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

<script>
(function($) {

  $.fn.menumaker = function(options) {
      
      var cssmenu = $(this), settings = $.extend({
        title: "Menu",
        format: "dropdown",
        sticky: false
      }, options);

      return this.each(function() {
        cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
        $(this).find("#menu-button").on('click', function(){
          $(this).toggleClass('menu-opened');
          var mainmenu = $(this).next('ul');
          if (mainmenu.hasClass('open')) { 
            mainmenu.hide().removeClass('open');
          }
          else {
            mainmenu.show().addClass('open');
            if (settings.format === "dropdown") {
              mainmenu.find('ul').show();
            }
          }
        });

        cssmenu.find('li ul').parent().addClass('has-sub');

        multiTg = function() {
          cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
          cssmenu.find('.submenu-button').on('click', function() {
            $(this).toggleClass('submenu-opened');
            if ($(this).siblings('ul').hasClass('open')) {
              $(this).siblings('ul').removeClass('open').hide();
            }
            else {
              $(this).siblings('ul').addClass('open').show();
            }
          });
        };

        if (settings.format === 'multitoggle') multiTg();
        else cssmenu.addClass('dropdown');

        if (settings.sticky === true) cssmenu.css('position', 'fixed');

        resizeFix = function() {
          if ($( window ).width() > 768) {
            cssmenu.find('ul').show();
          }

          if ($(window).width() <= 768) {
            cssmenu.find('ul').hide().removeClass('open');
          }
        };
        resizeFix();
        return $(window).on('resize', resizeFix);

      });
  };
})(jQuery);

(function($){
jQuery(document).ready(function(){

$("#cssmenu").menumaker({
   title: "Menu",
   format: "multitoggle"
});

});
})(jQuery);

   </script>
    <?php get_footer(); ?>