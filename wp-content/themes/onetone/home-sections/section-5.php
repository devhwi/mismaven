<?php
global $onetone_animated;
 $i                   = 4 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_'.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );

 $content_model       = onetone_option( 'section_content_model_'.$i,1);
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );
 $color               = onetone_option( 'section_color_'.$i );
 $columns             = absint(onetone_option('section_team_columns',4));
 $columns             = 6;
 $col                 = $columns>0?12/$columns:3;
 $col                 = 2;


  if( !isset($section_content) || $section_content=="" )
  $section_content = onetone_option( 'sction_content_'.$i );

  $section_id      = sanitize_title( onetone_option( 'menu_slug_'.$i ,'section-'.($i+1) ) );
  if( $section_id == '' )
  $section_id      = 'section-'.($i+1);

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
	 $team_item = '';
	 $team_str  = '';
	 for( $j=0; $j<12; $j++ ){

	  $avatar      =  esc_url(onetone_option('section_avatar_'.$i.'_'.$j));
	  $link        =  esc_url(onetone_option('section_link_'.$i.'_'.$j));
	  $name        =  esc_attr(onetone_option('section_name_'.$i.'_'.$j));
	  $byline      =  esc_attr(onetone_option('section_byline_'.$i.'_'.$j));
	  $description = onetone_option('section_desc_'.$i.'_'.$j);


	  if( $avatar != '' ):
      if( $link!='' )
    	  $image = '<a href="'.$link.'" target="_blank"><img src="'.$avatar.'" alt="'.$name.'" style="border-radius: 0; display: inline-block;border-style: solid;" />
            <div class="img-overlay primary">
              <div class="img-overlay-container">
                <div class="img-overlay-content"><i class="fa fa-link"></i></div>
              </div>
            </div>
            </a>';
		else
		$image = '<img src="'.$avatar.'" alt="" />';
	  $icons = '';
	for( $k=0;$k<4;$k++){
		$icon = str_replace('fa-','',esc_attr(onetone_option('section_icon_'.$i.'_'.$j.'_'.$k)));
		$link = esc_url(onetone_option('section_icon_link_'.$i.'_'.$j.'_'.$k));

		if( $icon != '' ){
		    $icons .= '<li><a href="'.$link.'"><i class="fa fa-'.$icon.'"></i></a></li>';
		}
	}

	  $team_item .= '<div class="col-md-'.$col.'">
	  <div class="'.$onetone_animated.'" data-animationduration="0.9" data-animationtype="fadeInDown" data-imageanimation="no">
						<div class="magee-person-box" id="">
						  <div class="person-img-box">
							<div class="img-box figcaption-middle text-center fade-in">'.$image.'</div>
						  </div>
						  <div class="person-vcard text-center">
							<h3 class="person-name" style="text-transform: uppercase;">'.$name.'</h3>
							<h4 class="person-title" style="text-transform: uppercase;">'.$byline.'</h4>
							<p class="person-desc">'.do_shortcode($description).'</p>
							<ul class="person-social">
							 '.$icons.'
							</ul>
						  </div>
						</div>
						</div>
					  </div>';
	  $m = $j+1;
	  if( $m % $columns == 0 ){
	        $team_str .= '<div class="row">'.$team_item.'</div>';
	        $team_item = '';
	   }
	   endif;

	 }
	 if( $team_item != '' ){
		    $team_str .= '<div class="row">'.$team_item.'</div>';

		   }

	 echo $team_str;
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
