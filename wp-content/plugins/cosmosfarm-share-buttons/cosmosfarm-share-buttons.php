<?php
/*
Plugin Name: 소셜 공유 버튼 By 코스모스팜
Plugin URI: http://www.cosmosfarm.com/
Description: 국내외 SNS 공유 버튼을 제공합니다.
Version: 1.2
Author: 코스모스팜 - Cosmosfarm
Author URI: http://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

define('COSMOSFARM_SHARE_BUTTONS_VERSION', '1.2');
define('COSMOSFARM_SHARE_BUTTONS_DIR_PATH', dirname(__FILE__));
define('COSMOSFARM_SHARE_BUTTONS_URL', plugins_url('', __FILE__));

include_once 'class/Cosmosfarm_Share_Buttons.class.php';
include_once 'class/Cosmosfarm_Share_Buttons_Controller.class.php';
include_once 'class/Cosmosfarm_Share_Buttons_Option.class.php';

add_action('init', 'cosmosfarm_share_buttons_init');
function cosmosfarm_share_buttons_init(){
	$cosmosfarm_share_buttons = new Cosmosfarm_Share_Buttons();
	add_action('admin_menu', array($cosmosfarm_share_buttons, 'add_admin_menu'));
	add_action('wp_head', 'cosmosfarm_share_buttons_head');
	add_action('wp_enqueue_scripts', 'cosmosfarm_share_buttons_style');
	add_action('wp_enqueue_scripts', 'cosmosfarm_share_buttons_scripts');
	add_action('admin_enqueue_scripts', 'cosmosfarm_share_buttons_admin_scripts');
}

function cosmosfarm_share_buttons_head(){
	$option = new Cosmosfarm_Share_Buttons_Option();
	if($option->kakao_sdk_key){
		echo "<script>Kakao.init('{$option->kakao_sdk_key}')</script>\n";
	}
}

function cosmosfarm_share_buttons_style(){
	wp_enqueue_style('cosmosfarm-share-buttons', COSMOSFARM_SHARE_BUTTONS_URL . '/css/cosmosfarm-share-buttons.css', array(), COSMOSFARM_SHARE_BUTTONS_VERSION);
}

function cosmosfarm_share_buttons_scripts(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('kakao-sdk', 'https://developers.kakao.com/sdk/js/kakao.min.js', array(), COSMOSFARM_SHARE_BUTTONS_VERSION, false);
	wp_enqueue_script('cosmosfarm-share-buttons', COSMOSFARM_SHARE_BUTTONS_URL . '/js/cosmosfarm-share-buttons.js', array(), COSMOSFARM_SHARE_BUTTONS_VERSION, true);
}

function cosmosfarm_share_buttons_admin_scripts($hook){
	if($hook == 'settings_page_cosmosfarm-share-buttons'){
		wp_enqueue_script('jquery-ui-sortable');
	}
}

add_action('plugins_loaded', 'cosmosfarm_share_buttons_languages');
function cosmosfarm_share_buttons_languages(){
	load_plugin_textdomain('cosmosfarm-share-buttons', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'cosmosfarm_share_buttons_settings_link');
function cosmosfarm_share_buttons_settings_link($links){
	return array_merge($links, array('settings' => '<a href="' . admin_url('options-general.php?page=cosmosfarm-share-buttons') . '">설정</a>'));
}

register_uninstall_hook(__FILE__, 'cosmosfarm_share_buttons_uninstall');
function cosmosfarm_share_buttons_uninstall(){
	global $wpdb;
	if(function_exists('is_multisite') && is_multisite()){
		$old_blog = $wpdb->blogid;
		$blogids = $wpdb->get_col("SELECT `blog_id` FROM {$wpdb->blogs}");
		foreach($blogids as $blog_id){
			switch_to_blog($blog_id);
			cosmosfarm_share_buttons_uninstall_execute();
		}
		switch_to_blog($old_blog);
		return;
	}
	cosmosfarm_share_buttons_uninstall_execute();
}

function cosmosfarm_share_buttons_uninstall_execute(){
	$option = new Cosmosfarm_Share_Buttons_Option();
	$option->truncate();
}
?>