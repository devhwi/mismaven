<?php
/*
Plugin Name: KBoard 게시판 설치도구
Plugin URI: http://www.cosmosfarm.com/products/kboard
Description: 워드프레스 KBoard 게시판 설치도구입니다.
Version: 1.3
Author: 코스모스팜 - Cosmosfarm
Author URI: http://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

define('KBOARD_DOWNLOADER_VERSION', '1.3');
define('KBOARD_DOWNLOADER_DIR_PATH', dirname(__FILE__));
define('KBOARD_DOWNLOADER_URL', plugins_url('', __FILE__));

include_once 'class/KDCore.class.php';
include_once 'class/KDFilesystem.class.php';

add_action('init', 'kboard_downloader_init');
function kboard_downloader_init(){
	$core = new KDCore();
	$core->start();
}
?>