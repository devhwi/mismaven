<?php
global $onetone_animated;
 $i                   = 8 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );

 $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $color               = onetone_option( 'section_color_'.$i );
 $btn_text            = onetone_option( 'section_btn_text_'.$i );
 $email               = onetone_option( 'section_email_'.$i );

  if( !isset($section_content) || $section_content=="" )
  $section_content = onetone_option( 'sction_content_'.$i );

  $section_id      = sanitize_title( onetone_option( 'menu_slug_'.$i ,'section-'.($i+1) ) );
  if( $section_id == '' )
   $section_id = 'section-'.($i+1);
   $section_id  = strtolower( $section_id );

  $container_class = "container";
  if( $full_width == "yes" ){
  $container_class = "";
  }

  if( $parallax_scrolling == "yes" || $parallax_scrolling == "1" ){
	 $section_css_class  .= ' onetone-parallax';
  }

?>
<section id="<?php echo $section_id; ?>" class="home-section-<?php echo ($i+1); ?> <?php echo $section_css_class;?>">
    	<div class="home-container <?php echo $container_class; ?> page_container">
		<?php
		if( $content_model == '0' ):
		?>
        <div style="color:<?php echo $color; ?>;">
         <?php if( $section_title != '' ):?>
       <?php

		   $section_title_class = '';

		   if( $section_subtitle == '' )

		   $section_title_class = 'no-subtitle';

		?>

    <h1 class="section-title <?php echo $section_title_class; ?>"><?php echo $section_title; ?></h1>
    <?php endif;?>
    <?php if( $section_subtitle != '' ):?>
    <div class="section-subtitle"><?php echo do_shortcode($section_subtitle);?></div>
    <?php endif;?>
    <div class="row">
      <!-- <div class="col-md-6" data-animationduration="0.9" data-animationtype="fadeIn" data-imageanimation="no" -->
        <!-- style="float:left;"> -->
        <div class="contact-area">
          <form class="contact-form" action="" method="post">
            <input id="name" tabindex="1" name="name" size="22" type="text" value="" placeholder="<?php _e('Name', 'onetone')?>" />
            <input id="email" tabindex="2" name="email" size="22" type="text" value="" placeholder="<?php _e('Email', 'onetone')?>" />
            <textarea id="message" tabindex="3" cols="39" name="x-message" rows="7" placeholder="<?php _e('Message', 'onetone')?>"></textarea>
            <input id="sendto" name="sendto" type="hidden" value="<?php echo $email;?>" />
            <input id="submit" name="submit" type="button" value="Send" tabindex="4" />
          </form>
        </div>
      <!-- </div> -->
      <!-- <div class="col-md-6" style=""> -->
        <!-- <p></p> -->
      <!-- </div> -->
    </div>
    <!-- END row CLASS DIV -->
  </div>
</div>
            <?php
        		else:
        		?>
            <?php if( $section_title != '' ):?>
        <div class="section-title"><?php echo do_shortcode($section_title);?></div>
        <?php endif;?>
            <div class="home-section-content">
            <?php
			if(function_exists('Form_maker_fornt_end_main'))
             {
                 $section_content = Form_maker_fornt_end_main($section_content);
              }
			 echo do_shortcode($section_content);
			?>
            </div>
       <?php
		endif;
		?>
        </div>
  <div class="clear"></div>
</section>
