<?php
/**
 * Template Name: Front Page
 *
 * @package Onetone
 * @since Onetone 2.3.5
 */
 ?>
<?php

get_header('home');

?>
<script>
  alert("메이븐 웹사이트 리뉴얼중입니다."); // 작업 완료시 삭제
</script>
<div class="post-wrap">
  <div class="container-fullwidth">
    <div class="page-inner row no-aside" style="padding-top: 0; padding-bottom: 0;">
      <div class="col-main">
        <section class="post-main" role="main" id="content">
          <article class="page type-page homepage" id="" role="article">
            <?php
			// global $onetone_options,$onetone_new_version,$onetone_homepage_sections ;
			// $detect = new Mobile_Detect;
			// $video_background_section  = onetone_option( 'video_background_section' );
			// $video_background_type     = onetone_option( 'video_background_type' );
            // $video_background_type     = $video_background_type == ""?"youtube":$video_background_type;
			// $section_1_content         = onetone_option( 'section_1_content' );
			// $animated                  = onetone_option( 'home_animated');
			// $section_1_content   = $section_1_content=='slider'?1:$section_1_content;
			// if( $animated == '1' )
			// $onetone_animated = 'onetone-animated';
            //
			// $sections_num = 15 ;
            //
            // $new_homepage_section = array();
			// for($i=0;$i<$sections_num;$i++){
			// $section = onetone_option('section_order_'.$i);
			// if( is_numeric($section ) )
			// $new_homepage_section[] = $section;
			// else
			// $new_homepage_section[] = $i;
			// }
			// $i = 0 ;
			// foreach( $new_homepage_section as $section_part ):
			// $hide_section  = onetone_option( 'section_hide_'.($section_part-1) );
            //
			// if( $hide_section != '1' ){
			// if( $section_part == 1 && $section_1_content == '1'){
			// 	get_template_part('home-sections/section','slider');
			// 	}else{
			// //if( $video_background_section == $section_part && !$detect->isMobile() && !$detect->isTablet() )
			// if( $video_background_section == $section_part  )
			// get_template_part('home-sections/section',$video_background_type.'-video');
			// else
			// get_template_part('home-sections/section',$section_part);
			// }
            //
			// }
			// $i++;
			// endforeach;
			?>
            <div class="clear"></div>
          </article>
        </section>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>
