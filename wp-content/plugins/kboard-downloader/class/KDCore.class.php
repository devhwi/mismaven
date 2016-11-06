<?php
/**
 * KBoard 게시판 설치도구
 * @link http://www.cosmosfarm.com/
 * @copyright Copyright 2015 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
final class KDCore {
	
	public function start(){
		add_action('admin_menu', array($this, 'addAdminMenu'));
	}
	
	public function addAdminMenu(){
		$position = 12345;
		add_menu_page('KBoard 게시판 설치도구', 'KBoard 설치도구', 'administrator', 'kboard_downloader_main', array($this, 'screenMain'), plugins_url('kboard-downloader/images/icon.png'), $position);
		add_submenu_page('kboard_downloader_main', 'KBoard 게시판 설치도구', '설치도구', 'administrator', 'kboard_downloader_main');
	}
	
	public function screenMain(){
		$action = isset($_GET['action'])?$_GET['action']:'';
		if($action == 'kboard_downloader_execute'){
			$this->pluginDownload();
		}
		
		$verstion = $this->getVerstion();
		include KBOARD_DOWNLOADER_DIR_PATH . '/admin/main-screen.php';
	}
	
	public function pluginDownload(){
		if(!current_user_can('activate_plugins')){
			echo '<script>alert("설치 권한이 없습니다.");</script>';
		}
		else{
			$file = KDFilesystem::getInstance();
			$install_dir = WP_CONTENT_DIR.'/plugins';
			
			$package = $_GET['package']=='kboard'?'kboard':'comments';
			$version = $_GET['version'];
			
			$form_url = wp_nonce_url(admin_url("/admin.php?page=kboard_downloader_main&action=kboard_downloader_execute&package={$package}&version={$version}"), 'kboard_downloader_execute');
			if(!$file->credentials($form_url, $install_dir)) exit;
			
			$result = $file->install($package, $version, $install_dir);
			
			if($result){
				echo '<script>alert("성공적으로 설치되었습니다. 플러그인을 활성화 해주세요.");</script>';
			}
			else{
				echo '<script>alert("설치에 실패 했습니다.");</script>';
			}
		}
	}
	
	public function getVerstion(){
		$host = 'www.cosmosfarm.com';
		$url = '/wpstore/kboard/version';
		$fp = @fsockopen($host, 80, $errno, $errstr, 3);
		if($fp){
			$output = '';
			fwrite($fp, "GET {$url} HTTP/1.0\r\n"."Host: {$host}\r\n"."Referer: {$_SERVER['HTTP_HOST']}\r\n"."\r\n");
			while(!feof($fp)){
				$output .= fgets($fp, 1024);
			}
			fclose($fp);
			$data = @explode("\r\n\r\n", $output);
			$data = @end($data);
			return json_decode($data);
		}
		else{
			$version = new stdClass();
			$version->kboard = '';
			$version->comments = '';
			return $version;
		}
	}
}
?>