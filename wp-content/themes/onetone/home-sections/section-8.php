<?php
global $onetone_animated;
 $i                   = 7 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );
 
 $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $color               = onetone_option( 'section_color_'.$i );
 $columns             = absint(onetone_option('section_testimonial_columns',3));
 $col                 = $columns>0?12/$columns:4;
	
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
	 $testimonial_item = '';
	 $testimonial_str  = '';
	 $m                = 0;
	 for( $j=0; $j<8; $j++ ){
	   
	  $avatar      =  esc_url(onetone_option('section_avatar_'.$i.'_'.$j));
	  $name        =  esc_attr(onetone_option('section_name_'.$i.'_'.$j));
	  $byline      =  esc_attr(onetone_option('section_byline_'.$i.'_'.$j));
	  $description = onetone_option('section_desc_'.$i.'_'.$j);
	 
	  
	  if( $avatar != '' )
	  $avatar = '<img src="'.esc_url($avatar).'" class="img-circle">';
    
	
	  if( $description != '' ){
	  $testimonial_item .= '<div class="col-md-'.$col.'">
	  <div class="'.$onetone_animated.'" data-animationduration="0.9" data-animationtype="fadeInUp" data-imageanimation="no">
						  <div class="magee-testimonial-box">
    <div class="testimonial-content">
      <div class="testimonial-quote">'.do_shortcode($description).'</div>
    </div>
    <div class="testimonial-vcard style1">
      <div class="testimonial-avatar">'.$avatar.'</div>
      <div class="testimonial-author">
        <h4 class="name" style="text-transform: uppercase;">'.$name.'</h4>
        <div class="title">'.$byline.'</div>
      </div>
    </div>
  </div>
						</div>
					  </div>';
	  $m++;
	  
	  if( $m % $columns == 0 && $m>0 ){
	        $testimonial_str .= '<div class="row">'.$testimonial_item.'</div>';
	        $testimonial_item = '';
	   }
	   
	  }
	   
	 }
	 if( $testimonial_item != '' ){
		    $testimonial_str .= '<div class="row">'.$testimonial_item.'</div>';
	      
		   }
		
	 echo $testimonial_str;
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