<?php
global $onetone_animated;
 $i                   = 3 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );

 $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $color               = onetone_option( 'section_color_'.$i );

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

		 <?php
		$items = '';
		$item  = '';
		for($c=0;$c<6;$c++){
		 $image  = esc_url(onetone_option( "section_image_".$i."_".$c ));
		 $desc   = onetone_option( "section_desc_".$i."_".$c );
		 $link   =  esc_url(onetone_option("section_link_".$i."_".$c));
	     $target =  esc_attr(onetone_option("section_target_".$i."_".$c));
		 $animationtype = array('fadeInLeft','fadeInDown','fadeInRight','fadeInLeft','fadeInUp','fadeInRight','fadeInDown','fadeInDown');
		 if( $link == "" )
	     $img_wrap = '<a href="'.$image.'" rel="portfolio-image"><img src="'.$image.'" alt="" class="feature-img "></a>';
	     else
	     $img_wrap = '<a href="'.$link.'" target="'.$target.'"><img src="'.$image.'" alt="" class="feature-img "><div class="img-overlay dark">
																			<div class="img-overlay-container">
																				<div class="img-overlay-content">
																					<i class="fa fa-link"></i>
																				</div>
																			</div>
																		</div></a>';



	$item .= '<div class="col-md-4">
	<div class="'.$onetone_animated.'" data-animationduration="0.9" data-animationtype="'.$animationtype[$c].'" data-imageanimation="no" id="">
  <div class="magee-feature-box style1" id="" data-os-animation="fadeOut">
    <div class="img-frame rounded"><div class="img-box figcaption-middle text-center fade-in">'.$img_wrap.'</div></div>
</div></div></div>';
     if( ($c+1) % 3 == 0){
		 $items .= '<div class="row no-padding no-margin">'.$item.'</div>';
		 $item = '';
		 }
		}
		if( $item != '' ){ $items .= '<div class="row no-padding no-margin">'.$item.'</div>';}
		echo $items;
		?>
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
