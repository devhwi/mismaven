<?php
/**
 * KBoard 게시판 설치도구 파일 관리
 * @link http://www.cosmosfarm.com/
 * @copyright Copyright 2015 Cosmosfarm. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl.html
 */
final class KDFilesystem {
	
	static private $instance;
	private $server = 'http://www.cosmosfarm.com/wpstore/kboard';
	
	private function __construct(){
		
	}
	
	/**
	 * 인스턴스를 반환한다.
	 * @return KDFilesystem
	 */
	static public function getInstance(){
		if(!self::$instance) self::$instance = new KDFilesystem();
		return self::$instance;
	}
	
	/**
	 * 패키지 파일의 압축을 풀고 설치한다.
	 * @param string $package
	 * @param string $version
	 * @param string $plugins_dir
	 * @return boolean
	 */
	public function install($package, $version, $plugins_dir){
		$download_file = download_url("{$this->server}/download-{$package}?version={$version}");
		if(is_wp_error($download_file)){
			unlink($download_file);
			echo '<script>alert("다운로드에 실패 했습니다. 다시 시도해 주세요.");</script>';
			return false;
		}
		
		// See #15789 - PclZip uses string functions on binary data, If it's overloaded with Multibyte safe functions the results are incorrect.
		if(ini_get('mbstring.func_overload') && function_exists('mb_internal_encoding')){
			$previous_encoding = mb_internal_encoding();
			mb_internal_encoding('ISO-8859-1');
		}
		require_once ABSPATH . 'wp-admin/includes/class-pclzip.php';
		
		$archive = new PclZip($download_file);
		$archive_files = $archive->extract(PCLZIP_OPT_EXTRACT_AS_STRING);
		
		unlink($download_file);
		
		if($archive_files){
			if(is_writable($plugins_dir)){
				foreach($archive_files as $file){
				if($file['folder']){
						$extract_result = wp_mkdir_p($plugins_dir . '/' . $file['filename']);
					}
					else{
						$extract_result = file_put_contents($plugins_dir . '/' . $file['filename'], $file['content']);
					}
					if(!$extract_result) break;
				}
				if(!$extract_result){
					echo '<script>alert("FTP로 파일 쓰기에 실패했습니다. 서버 관리자에게 문의하시기 바랍니다.");</script>';
					return false;
				}
			}
			else{
				global $wp_filesystem;
				$target_dir = trailingslashit($wp_filesystem->find_folder($plugins_dir));
				foreach($archive_files as $file){
					if($file['folder']){
						if($wp_filesystem->is_dir($target_dir . $file['filename'])) continue;
						else $extract_result = $wp_filesystem->mkdir($target_dir . $file['filename'], FS_CHMOD_DIR);
					}
					else{
						$extract_result = $wp_filesystem->put_contents($target_dir . $file['filename'], $file['content'], FS_CHMOD_FILE);
					}
					if(!$extract_result) break;
				}
				if(!$extract_result){
					echo '<script>alert("FTP로 파일 쓰기에 실패했습니다. 서버 관리자에게 문의하시기 바랍니다.");</script>';
					return false;
				}
			}
		}
		
		return true;
	}
	
	/**
	 * 워드프레스 Filesystem을 초기화 한다.
	 * @param string $form_url
	 * @param string $path
	 * @param string $method
	 * @param string $fields
	 * @return boolean
	 */
	function credentials($form_url, $path, $method='', $fields=null){
		global $wp_filesystem;
		
		if(is_writable($path)){
			return true;
		}
		if(false === ($creds = request_filesystem_credentials($form_url, $method, false, $path, $fields))){
			return false;
		}
		if(!WP_Filesystem($creds)){
			request_filesystem_credentials($form_url, $method, true, $path);
			return false;
		}
		return true;
	}
}
?>