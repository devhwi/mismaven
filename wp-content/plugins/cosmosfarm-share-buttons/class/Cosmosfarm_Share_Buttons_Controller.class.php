<?php
/**
 * 코스모스팜 공유하기 버튼 컨트롤러
 * @link http://www.cosmosfarm.com/
 * @copyright Copyright 2016 Cosmosfarm. All rights reserved.
 */
final class Cosmosfarm_Share_Buttons_Controller {
	
	public function __construct(){
		$action = isset($_POST['action'])?$_POST['action']:'';
		if($action == 'cosmosfarm_share_buttons_save'){
			$this->save();
		}
	}
	
	private function save(){
		if(isset($_POST['cosmosfarm-share-buttons-save-nonce']) && wp_verify_nonce($_POST['cosmosfarm-share-buttons-save-nonce'], 'cosmosfarm-share-buttons-save')){
			$option = new Cosmosfarm_Share_Buttons_Option();
			
			$option->update('post_display');
			$option->update('post_align');
			
			$option->update('page_display');
			$option->update('page_align');
			
			$option->update('excerpt_display');
			$option->update('excerpt_align');
			
			$option->update('kboard_display');
			$option->update('kboard_align');
			
			$option->update('active');
			$option->update('kakao_sdk_key');
		}
	}
}
?>