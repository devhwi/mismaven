<?php
/**
 * 소셜 공유 버튼 By 코스모스팜
 * @link http://www.cosmosfarm.com/
 * @copyright Copyright 2016 Cosmosfarm. All rights reserved.
 */
final class Cosmosfarm_Share_Buttons {
	
	var $option;
	private $kboard_content_uid = 0;
	
	public function __construct(){
		new Cosmosfarm_Share_Buttons_Controller();
		$this->option = new Cosmosfarm_Share_Buttons_Option();
		
		if($this->option->active){
			add_filter('the_content', array($this, 'content_add_share_buttons'), 10, 1);
			add_filter('the_excerpt', array($this, 'excerpt_add_share_buttons'), 10, 1);
			
			if(defined('KBOARD_VERSION')){
				add_filter('kboard_content', array($this, 'kboard_add_share_buttons'), 10, 2);
			}
		}
		
		add_shortcode('cosmosfarm_share_buttons', array($this, 'shortcode'));
	}
	
	public function add_admin_menu(){
		add_options_page('소셜 공유 버튼 By 코스모스팜', '소셜 공유 버튼 By 코스모스팜', 'administrator', 'cosmosfarm-share-buttons', array($this, 'setting'));
	}
	
	public function setting(){
		$option = new Cosmosfarm_Share_Buttons_Option();
		include COSMOSFARM_SHARE_BUTTONS_DIR_PATH . '/admin/settings.php';
	}
	
	public function shortcode($args){
		extract(shortcode_atts(array('url'=>'', 'title'=>'', 'align'=>'left'), $args));
		$args['align'] = explode('|', $args['align']);
		$args['align'] = reset($args['align']);
		return $this->get_share_buttons($args['align'], $args['url'], $args['title']);
	}
	
	public function content_add_share_buttons($content){
		$option = $this->option;
		
		if($option->post_display && is_single()){
			$buttons = $this->get_share_buttons($option->post_align);
			
			if($option->post_display == 'top'){
				$content = $buttons . $content;
			}
			else{
				$content = $content . $buttons;
			}
		}
		else if($option->page_display && is_page()){
			$buttons = $this->get_share_buttons($option->page_align);
			
			if($option->page_display == 'top'){
				$content = $buttons . $content;
			}
			else{
				$content = $content . $buttons;
			}
		}
		
		return $content;
	}
	
	public function excerpt_add_share_buttons($content){
		$option = $this->option;
		
		if($option->excerpt_display){
			$buttons = $this->get_share_buttons($option->excerpt_align);
				
			if($option->excerpt_display == 'top'){
				$content = $buttons . $content;
			}
			else{
				$content = $content . $buttons;
			}
		}
		
		return $content;
	}
	
	public function kboard_add_share_buttons($content, $content_uid){
		$option = $this->option;
		
		$this->kboard_content_uid = intval($content_uid);
		
		if($option->kboard_display){
			$buttons = $this->get_share_buttons($option->kboard_align);
			
			if($option->kboard_display == 'top'){
				$content = $buttons . $content;
			}
			else{
				$content = $content . $buttons;
			}
		}
		
		$this->kboard_content_uid = 0;
		
		return $content;
	}
	
	public function get_share_buttons($align='left', $url='', $title=''){
		$option = $this->option;
		
		if(!$url){
			$url = $this->get_share_url();
		}
		if(!$title){
			$title = $this->get_share_title();
		}
		
		ob_start();
		include COSMOSFARM_SHARE_BUTTONS_DIR_PATH . '/layout/default/layout.php';
		$buttons = ob_get_clean();
		
		return $buttons;
	}
	
	public function get_share_url(){
		global $post;
		
		if($this->kboard_content_uid){
			$url = new KBUrl();
			$share_url = $url->getDocumentRedirect($this->kboard_content_uid);
		}
		else{
			$share_url = get_permalink($post->ID);
		}
		
		return addslashes($share_url);
	}
	
	public function get_share_title(){
		global $post;
		
		if($this->kboard_content_uid){
			$content = new KBContent();
			$content->initWithUID($this->kboard_content_uid);
			$share_title = $content->title;
		}
		else{
			$share_title = $post->post_title;
		}
		
		return htmlspecialchars($share_title);
	}
}
?>