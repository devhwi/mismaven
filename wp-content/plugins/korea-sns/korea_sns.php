<?php
/* 
Plugin Name: Korea SNS 
Plugin URI: http://icansoft.com/?page_id=1041
Description: You can Insert share buttons for korean in contents post or page. - kakaotalk, kakaostory, naver line, naver band, naver blog, facebook, twitter, google plus ---> <a href="http://icansoft.com/?page_id=1041">Plugin Page</a> | <a href="http://facebook.com/groups/koreasns">Support</a>
Author: Jongmyoung Kim 
Version: 1.5.3
Author URI: http://icansoft.com/ 
License: GPL2
*/

/* Copyright 2014 Jongmyoung.Kim (email : kimsreal@gmail.com)
 This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

add_action('init', 'kon_tergos_init');
add_filter('the_content', 'kon_tergos_content');
add_filter('the_excerpt', 'kon_tergos_excerpt');
add_filter('plugin_action_links', 'kon_tergos_add_settings_link', 10, 2 );
add_action('admin_menu', 'kon_tergos_menu');
add_shortcode( 'korea_sns_button', 'kon_tergos_shortcode' );

function kon_tergos_init() {
	if (is_admin()) {
		return;
	}

	$option = kon_tergos_get_options_stored();

	wp_enqueue_script('jquery');
	wp_enqueue_script('kakao_sdk', 'https://developers.kakao.com/sdk/js/kakao.min.js');
	wp_enqueue_script('koreasns_js', plugins_url( 'korea_sns_153.js', __FILE__ ));
	wp_register_style( 'koreasns_css', plugins_url('korea_sns.css', __FILE__) );
	wp_enqueue_style( 'koreasns_css' );
}

function kon_tergos_menu() {
	add_options_page('Korea SNS Options', 'Korea SNS', 'manage_options', 'kon_tergos_options', 'kon_tergos_options');
}

function kon_tergos_add_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
 
	if ($file == $this_plugin){
		$settings_link = '<a href="admin.php?page=kon_tergos_options">'.__("Settings").'</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}

function kon_tergos_content ($content) {
	return kon_tergos ($content, 'the_content');
}

function kon_tergos_excerpt ($content) {
	return kon_tergos ($content, 'the_excerpt');
}

function kon_tergos ($content, $filter, $link='', $title='') {
	static $last_execution = '';
	
	if ($filter=='the_excerpt' and $last_execution=='the_content') {

		remove_filter('the_content', 'kon_tergos_content');
		$last_execution = 'the_excerpt';
		return the_excerpt();
	}
	if ($filter=='the_excerpt' and $last_execution=='the_excerpt') {

		add_filter('the_content', 'kon_tergos_content');
	}

	$custom_field_disable = get_post_custom_values('kon_tergos_disable');
	if ($custom_field_disable[0]=='yes' and $filter!='shortcode') {
		return $content;
	}
	
	$option = kon_tergos_get_options_stored();

	if ($filter!='shortcode') {
		if (is_single()) {
			if (!$option['show_in']['posts']) { return $content; }
		} else if (is_singular()) {
			if (!$option['show_in']['pages']) {
				return $content;
			}
		} else if (is_home()) {
			if (!$option['show_in']['home_page']) {	return $content; }
		} else if (is_tag()) {
			if (!$option['show_in']['tags']) { return $content; }
		} else if (is_category()) {
			if (!$option['show_in']['categories']) { return $content; }
		} else if (is_date()) {
			if (!$option['show_in']['dates']) { return $content; }
		} else if (is_author()) {
			if (!$option['show_in']['authors']) { return $content; }
		} else if (is_search()) {
			if (!$option['show_in']['search']) { return $content; }
		} else {
			return $content;
		}
	}
	
	$bMobileClient = 0;
	$arMobileAgent  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","android","sony","phone");
  for($i=0; $i<sizeof($arMobileAgent); $i++){ 
    if(preg_match("/$arMobileAgent[$i]/", strtolower($_SERVER['HTTP_USER_AGENT']))){
    	$bMobileClient = 1;
    	break;
    } 
  }
	
	if ($link=='' || $title=='') {
		$link = get_permalink();
		$title = get_the_title();
	}
	
	$title = strip_tags($title);
	$title = str_replace("\"", " ", $title);
	$title = str_replace("&#039;", "", $title);	
	
	$siteTitle = get_bloginfo('name');
	$siteTitle = strip_tags($siteTitle);
	$siteTitle = str_replace("\"", " ", $siteTitle);
	$siteTitle = str_replace("&#039;", "", $siteTitle);	
	
	$eLink = urlencode($link);
	$eTitle = urlencode($title." - ".$siteTitle);
	$eSiteTitle = urlencode($siteTitle);
	$bPosBoth = ( $option['position'] == 'both') ? 1 : 0;
	$strSocialButtons = '';
	$locKakaotalk = '';
	
	foreach($option['active_buttons'] as $snsKey => $snsOpt ){
		
		if( !$snsOpt ) continue;
		if( $snsKey == 'google1' ) continue;
	
		if( $option['mobile_only'] && !$bMobileClient &&
				($snsKey=='kakaotalk' || $snsKey=='naverline' || $snsKey=='naverband')) continue;
				
		switch( $snsKey )
		{
			case 'kakaotalk':
				$loc = '<div class="korea-sns-button korea-sns-'.$snsKey.'" id="kakao-link-btn-[_POST_ID_]" ';
				
				if( $bMobileClient )
					$loc .= ' OnClick="javascript:;" ';
				else
					$loc .= ' OnClick="alert(\'Only Moble\')" ';
				
				$loc .= ' style="background-image:url(\''.plugins_url( '/icons/'.$snsKey.'.png', __FILE__ ).'\');">';	
				$loc .= '</div>';
				
				if( !$bMobileClient ) break;
				
				$strKakaotalkMessageTitle = ( $option['kakaotalk_title_type'] == '1' ) ? $title : $title." - ".$siteTitle;
				$locKakaotalk = "<script>
			    InitKakao('".$option['kakao_app_key']."');    
			    Kakao.Link.createTalkLinkButton({
			      container: '#kakao-link-btn-[_POST_ID_]',
			      label: '".$strKakaotalkMessageTitle."', ";
			      
			  if (has_post_thumbnail()){ 	
			  	$thumbnailID = get_post_thumbnail_id();
					$arThumbnailInfo = wp_get_attachment_image_src( $thumbnailID, 'full' );
					$thumbnailURL = $arThumbnailInfo[0];
					$thumbnailWidth = $arThumbnailInfo[1];
					$thumbnailHeight = $arThumbnailInfo[2];
					
					if( $thumbnailWidth < 80 || $thumbnailHeight < 80 ){
						$thumbnailWidth = 80;
						$thumbnailHeight = 80;
					}
					
					$locKakaotalk .= "image: {src: encodeURI('".$thumbnailURL."'), width: '".$thumbnailWidth."', height: '".$thumbnailHeight."'},";
				}
				
				$strAppTitle = ( $option['kakaotalk_title_type'] == '1' ) ? $siteTitle : $option['kakaotalk_title_text'];
				if( $strAppTitle == "" ){  $strAppTitle = "Read more..."; }
					  
			  $locKakaotalk .= "webButton: {text: '".$strAppTitle."', url: '".$link."' }";
			  $locKakaotalk .= "}); </script> ";	  
				break;
			
			case 'kakaostory':
				$loc = '<div class="korea-sns-button korea-sns-'.$snsKey.'" id="kakao-story-btn-[_POST_ID_]" ';
				$loc .= ' OnClick="ShareKakaostory(\''.$option['kakao_app_key'].'\', \''.$link.'\', \''.$title.'\','.$bMobileClient.')" ';
				$loc .= ' style="background-image:url(\''.plugins_url( '/icons/'.$snsKey.'.png', __FILE__ ).'\');">';	
				$loc .= '</div>';
				break;
					
			case 'naverline':
				if( $bMobileClient )
					$call = 'document.location.href=\'http://line.naver.jp/R/msg/text/?'.$eTitle.'%0D%0A'.$eLink.'\'';
				else
					$call = 'alert(\'Only Moble\')';
					
				$loc = '<div class="korea-sns-button korea-sns-'.$snsKey.'" OnClick="'.$call.'" ';
				$loc .= ' style="background-image:url(\''.plugins_url('/icons/'.$snsKey.'.png', __FILE__ ).'\');"></div>';	
				break;
				
			default:
				$call = "SendSNS('".$snsKey."', '".$title." - ".$siteTitle."', '".$link."', '');";
				$loc = '<div class="korea-sns-button korea-sns-'.$snsKey.'" OnClick="'.$call.'" ';
				$loc .= ' style="background-image:url(\''.plugins_url('/icons/'.$snsKey.'.png', __FILE__ ).'\');"></div>';				
				break;
		}
				
		$strSocialButtons .= $loc;
	}
	
	static $nKakaotalkBtCount = 1;
	
	$strSocialButtons .= $locKakaotalk;
	$strSocialButtonsFirst = str_replace('[_POST_ID_]', get_the_ID().'-'.$nKakaotalkBtCount, $strSocialButtons);
	$nKakaotalkBtCount ++;

	$last_execution = $filter;
	if ($filter=='shortcode') return '<div class="korea-sns-shortcode">'.$strSocialButtonsFirst.'</div>';
	
	$classFloat = 'korea-sns-pos-'.$option['position_float'];
	
	$out = '<div class="korea-sns"><div class="korea-sns-post '.$classFloat.'">'.$strSocialButtonsFirst.'</div><div style="clear:both;"></div></div>';
	
	if( is_single() || is_page() ){
		switch( $option['position'] ){
			case 'both':
				$strSocialButtonsSecond = str_replace('[_POST_ID_]', get_the_ID().'-'.$nKakaotalkBtCount, $strSocialButtons);
				$nKakaotalkBtCount ++;
				$out2 = '<div class="korea-sns"><div class="korea-sns-post '.$classFloat.'">'.$strSocialButtonsSecond.'</div><div style="clear:both;"></div></div>';
				return $out.$content.$out2;
			case 'above':
				return $out.$content;
			default:
			case 'bellow':
				return $content.$out;
		}
	}
	else{	
		return $content.$out;
	}
}

function kon_tergos_options () {

	$option_name = 'kon_tergos';

	if (!current_user_can('manage_options')) {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	$active_buttons = array(
		'facebook'=>' Facebook',
		'twitter'=>'Twitter',
		'google'=>'Google',
		'kakaostory'=>'Kakao Story',
		'kakaotalk'=>'Kakaotalk Link',
		'naverline'=>'Naver Line',
		'naverband'=>'Naver Band',
		'naverblog'=>'Naver Blog'
	);	

	$show_in = array(
		'posts'=>'Single posts',
		'pages'=>'Pages',
		'home_page'=>'Home page',
		'tags'=>'Tags',
		'categories'=>'Categories',
		'dates'=>'Date based archives',
		'authors'=>'Author archives',
		'search'=>'Search results',
	);
	
	$out = '';
	
	if( isset($_POST['kon_tergos_position'])) {
		$option = array();

		foreach (array_keys($active_buttons) as $item) {
			$option['active_buttons'][$item] = (isset($_POST['kon_tergos_active_'.$item]) and $_POST['kon_tergos_active_'.$item]=='on') ? true : false;
		}
		foreach (array_keys($show_in) as $item) {
			$option['show_in'][$item] = (isset($_POST['kon_tergos_show_'.$item]) and $_POST['kon_tergos_show_'.$item]=='on') ? true : false;
		}
		$option['position'] = esc_html($_POST['kon_tergos_position']);
		$option['position_float'] = esc_html($_POST['kon_tergos_position_float']);
		$option['mobile_only'] = esc_html($_POST['kon_tergos_mobile_only']);
		$option['kakao_app_key'] = esc_html($_POST['kk_appkey']);
		$option['kakaotalk_title_type'] = esc_html($_POST['kkt_title_type']);
		$option['kakaotalk_title_text'] = esc_html($_POST['kkt_title_text']);
		
		update_option($option_name, $option);
		$out .= '<div class="updated"><p><strong>'.__('Settings saved.', 'menu-test' ).'</strong></p></div>';
	}
	
	$option = kon_tergos_get_options_stored();
	
	$sel_above = ($option['position']=='above') ? 'selected="selected"' : '';
	$sel_below = ($option['position']=='below') ? 'selected="selected"' : '';
	$sel_both  = ($option['position']=='both' ) ? 'selected="selected"' : '';
	
	$sel_float_left = ($option['position_float']=='left') ? 'selected="selected"' : '';
	$sel_float_center = ($option['position_float']=='center') ? 'selected="selected"' : '';
	$sel_float_right = ($option['position_float']=='right') ? 'selected="selected"' : '';

	$sel_like      = ($option['facebook_like_text']=='like'     ) ? 'selected="selected"' : '';
	$sel_recommend = ($option['facebook_like_text']=='recommend') ? 'selected="selected"' : '';
	
	$check_mobile_only = ($option['mobile_only']==true) ? 'checked' : '';
	
	$sel_kakaotalk_title_type_sitename = ($option['kakaotalk_title_type']=='1') ? 'selected="selected"' : '';
	$sel_kakaotalk_title_type_text = ($option['kakaotalk_title_type']=='2') ? 'selected="selected"' : '';
	$styleKakaotalkTitleText = ($option['kakaotalk_title_type']=='1') ? 'display:none;' : 'display:inline;';

	?>
	
	<style>
		#kon_tergos_form h3 { cursor: default; }
		#kon_tergos_form td { vertical-align:top; padding:10px; }
	</style>
	
	<div class="wrap">
		<div style="display:table;width:100%;">
			<h1><?php echo __( 'Korea SNS Options', 'menu-test' ); ?></h1>
		</div>
		
		<div id="poststuff" style="padding-top:10px; position:relative;">
			<div>
				<form id="kon_tergos_form" name="form1" method="post" action="">
					<p>
						<input type="submit" name="Submit" class="button-primary" value="<?php echo esc_attr('Save Changes'); ?>" />
						
						<span style="float:right;">
							<a href="http://icansoft.com/product/korea-sns-pro" target="_blank">Upgrade Korea SNS Pro</a> <b>|</b>
							<a href="http://icansoft.com/product/korea-sns" target="_blank">Go Korea SNS Homepage</a> <b>|</b>
							<a href="http://facebook.com/groups/koreasns" target="_blank">Go Support Forum</a> <b>|</b>
							<a href="http://icansoft.com/donation" target="_blank">About Donation</a>
						</span>
					</p>
								
					<div class="postbox">
						<div class="inside">
							<table width="100%">
								<tr>
									<td style="width:130px;">
										<?php echo __("Active share buttons", 'menu-test' ); ?>:
									</td>
									<td>
									
										<div style="max-width:400px;float:right;border:1px solid #ccc;padding:5px 20px;">
											<center>
												<a href="http://icansoft.com/product/korea-sns-pro/" target="_blank">
													<img src="<?php echo plugins_url( '/images/option-banner.jpg', __FILE__ ); ?>" style="max-width:300px;">
												</a>
											</center>
										</div>
			
			
										<?php 
											foreach ($active_buttons as $name => $text) {
												$checked = ($option['active_buttons'][$name]) ? 'checked="checked"' : '';
												?>
													<div style="width:250px;">
														<input type="checkbox" name="kon_tergos_active_<?php echo $name; ?>" <?php echo $checked; ?> />
														<?php echo __($text, 'menu-test' ); ?>
														&nbsp;&nbsp;</div>
												<?php
											}
										?>
									</td>
								</tr>
								<tr>
									<td><?php echo __("Show buttons in these pages", 'menu-test' ); ?>:</td>
									<td>
										<?php
											foreach ($show_in as $name => $text) {
												$checked = ($option['show_in'][$name]) ? 'checked="checked"' : '';
												?>
													<div style="width:250px;">
														<input type="checkbox" name="kon_tergos_show_<?php echo $name; ?>" <?php echo $checked; ?> />
															<?php echo __($text, 'menu-test' ); ?>
														&nbsp;&nbsp;
													</div>
												<?php
											}
										?>
				
									</td>
								</tr>
								<tr>
									<td><?php echo __("Position", 'menu-test' ); ?>:</td>
									<td>
										<select name="kon_tergos_position">
											<option value="above" <?php echo $sel_above; ?>> <?php echo __('Top', 'menu-test' ); ?></option>
											<option value="below" <?php echo $sel_below; ?>> <?php echo __('Bottom', 'menu-test' ); ?></option>
											<option value="both"  <?php echo $sel_both; ?>> <?php echo __('Both', 'menu-test' ); ?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<select name="kon_tergos_position_float">
											<option value="left" <?php echo $sel_float_left; ?>> <?php echo __('left', 'menu-test' ); ?></option>
											<option value="center" <?php echo $sel_float_center; ?>> <?php echo __('center', 'menu-test' ); ?></option>
											<option value="right" <?php echo $sel_float_right; ?>> <?php echo __('right', 'menu-test' ); ?></option>
										</select>
								</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										<input type="checkbox" name="kon_tergos_mobile_only" <?php echo $check_mobile_only; ?>/> Hide mobile-click on the desktop (Kakaotalk, Naver Line, Naver Band)
									</td>
								</tr>
								<tr>
									<td><?php echo __("Your Kakao App Key", 'menu-test' ); ?>:</td>
									<td>
										<input type="text" name="kk_appkey" size="40" value="<?php echo $option['kakao_app_key']; ?>">
										<br/>
										Since December 2014 the key to get the app can send Kakaotalk, Kakaostory message.<br>
										 example : aab99ce45b777d799f2c1af7e5e37660 (32 Characters)<br/>
										<a href="http://icansoft.com/?p=1143" target="_blank">
											Getting apps key from Kakao Developers
										</a>
									</td>
								</tr>
								<tr>
									<td><?php echo __("Kakaotalk Icon Title", 'menu-test' ); ?>:</td>
									<td>
										<select name="kkt_title_type" id="kakaotalk_title_type_select">
										<option value="1" <?php echo $sel_kakaotalk_title_type_sitename; ?>><?php echo __('Your Site Name', 'menu-test' ); ?></option><br>
										<option value="2" <?php echo $sel_kakaotalk_title_type_text; ?>><?php echo __('Direct Input', 'menu-test' ); ?></option><br>
										</select>
										<input type="text" id="kakaotalk_title_text" name="kkt_title_text" id="kakaotalk_title_text" size="50"
											value="<?php echo $option['kakaotalk_title_text'] ?>" style="<?php echo $styleKakaotalkTitleText; ?>" />
										<br/>
										Set the right character of apps icons.
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>
										App icon image can be changed.<br/>
										<a href="http://icansoft.com/?p=1258" target="_blank">
											How to change the app icon image
										</a>
									</td>
								</tr>				
							</table>
						</div>
					</div>
		
					<input type="submit" name="Submit" class="button-primary" value="<?php echo esc_attr('Save Changes'); ?>" />
				</form>
	
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {			
			$("#kakaotalk_title_type_select").change(function(){
				if( $("#kakaotalk_title_type_select option:selected").val() == "1" ){
					$("#kakaotalk_title_text").css("display", "none");
				}
				else{
					$("#kakaotalk_title_text").css("display", "inline");
					
					if( $("#kakaotalk_title_text").val() == "" ){
						$("#kakaotalk_title_text").val("Read more...");
					}
				}
			});
		});
	</script>
	<?php
}

function kon_tergos_shortcode ($atts) {
	return kon_tergos ('', 'shortcode');
}

function kon_tergos_publish ($link='', $title='') {
	return kon_tergos ('', 'shortcode', $link, $title);
}

function kon_tergos_get_options_stored () {

	$option = get_option('kon_tergos');
	 
	if ($option===false)
	{
		$option = kon_tergos_get_options_default();
		add_option('kon_tergos', $option);
	}
	else if ($option=='above' or $option=='below')
	{
		$option = kon_tergos_get_options_default($option);
	}
	else if(!is_array($option))
	{
		$option = json_decode($option, true);
	}
	
	return $option;
}

function kon_tergos_get_options_default ($position='above') {
	$option = array();
	$option['active_buttons'] = array('facebook'=>true, 'twitter'=>true, 'google'=>true, 'kakaostory'=>true, 'kakaotalk'=>true, 'naverline'=>true, 'naverband'=>true, 'naverblog'=>true);
	$option['position'] = $position;
	$option['position_float'] = 'left';
	$option['mobile_only'] = true;
	$option['show_in'] = array('posts'=>true, 'pages'=>true, 'home_page'=>false, 'tags'=>true, 'categories'=>true, 'dates'=>true, 'authors'=>true, 'search'=>true);
	$option['kakao_app_key'] = '';
	$option['kakaotalk_title_type'] = '1';
	$option['kakaotalk_title_text'] = 'Read Post';
	
	return $option;
}
