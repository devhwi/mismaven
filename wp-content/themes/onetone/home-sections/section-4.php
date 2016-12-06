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
    ?>
    <div class="row no-padding no-margin">
      <!-- 내용 -->
      <ul id="hexGrid">
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex1.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <h1>FRONTEND</h1>
                  <p style="color:#fff;">UI 개발</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex8.png" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                <h1>BACKEND</h1>
                <p style="color:#fff;">프로그래밍</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex3.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex4.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <h1>DATABASE</h1>
                  <p style="color:#fff;">DB설계와 구현</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <h1>DATA ANALYSIS</h1>
                  <p style="color:#fff;">세상 모든 데이터를 분석</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex5.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex6.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <h1>NETWORK</h1>
                  <p style="color:#fff;">망연계, 정책 관리</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex7.jpg" alt="" />
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                <h1>SECURITY</h1>
                <p style="color:#fff;">보안, 모의해킹</p>
              </a>
          </li>
          <li class="hex">
              <a class="hexIn">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/hex/hex2.jpg" alt="" />
              </a>
          </li>
      </ul>
    </div>
  <div class="clear"></div>
</section>
<?php
  endif;
?>
