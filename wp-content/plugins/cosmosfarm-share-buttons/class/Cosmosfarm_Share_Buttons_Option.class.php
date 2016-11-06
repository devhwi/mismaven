<?php
/**
 * 옵션 데이터
 * @link http://www.cosmosfarm.com/
 * @copyright Copyright 2016 Cosmosfarm. All rights reserved.
 */
class Cosmosfarm_Share_Buttons_Option {
	
	var $sns;
	
	var $post_display;
	var $post_align;
	
	var $page_display;
	var $page_align;
	
	var $excerpt_display;
	var $excerpt_align;
	
	var $kboard_display;
	var $kboard_align;
	
	var $active;
	var $kakao_sdk_key;
	
	public function __construct(){
		$this->sns = array(
				'naver' => __('Naver', 'cosmosfarm-share-buttons'),
				'facebook' => __('Facebook', 'cosmosfarm-share-buttons'),
				'twitter' => __('Twitter', 'cosmosfarm-share-buttons'),
				'band' => __('Band', 'cosmosfarm-share-buttons'),
				'kakaostory' => __('KakaoStory', 'cosmosfarm-share-buttons'),
				'kakaotalk' => __('KakaoTalk', 'cosmosfarm-share-buttons'),
				'google' => __('Google+', 'cosmosfarm-share-buttons'),
		);
		$this->init();
	}
	
	public function init(){
		$this->post_display = get_site_option('cosmosfarm_share_post_display', '');
		$this->post_align = get_site_option('cosmosfarm_share_post_align', '');
		
		$this->page_display = get_site_option('cosmosfarm_share_page_display', '');
		$this->page_align = get_site_option('cosmosfarm_share_page_align', '');
		
		$this->excerpt_display = get_site_option('cosmosfarm_share_excerpt_display', '');
		$this->excerpt_align = get_site_option('cosmosfarm_share_excerpt_align', '');
		
		$this->kboard_display = get_site_option('cosmosfarm_share_kboard_display', '');
		$this->kboard_align = get_site_option('cosmosfarm_share_kboard_align', '');
		
		$this->active = get_site_option('cosmosfarm_share_active', array());
		$this->kakao_sdk_key = get_site_option('cosmosfarm_share_kakao_sdk_key', '');
	}
	
	public function update($option_name){
		$option_name = "cosmosfarm_share_{$option_name}";
		$new_value = isset($_POST[$option_name])?$_POST[$option_name]:'';
		if(!$new_value){
			delete_site_option($option_name);
		}
		else{
			if(get_site_option($option_name) !== false) update_site_option($option_name, $new_value);
			else add_site_option($option_name, $new_value, '', 'yes');
		}
	}
	
	public function truncate(){
		delete_site_option('cosmosfarm_share_post_display');
		delete_site_option('cosmosfarm_share_post_align');
		
		delete_site_option('cosmosfarm_share_page_display');
		delete_site_option('cosmosfarm_share_page_align');
		
		delete_site_option('cosmosfarm_share_excerpt_display');
		delete_site_option('cosmosfarm_share_excerpt_align');
		
		delete_site_option('cosmosfarm_share_kboard_display');
		delete_site_option('cosmosfarm_share_kboard_align');
		
		delete_site_option('cosmosfarm_share_active');
		delete_site_option('cosmosfarm_share_kakao_sdk_key');
	}
}
?>