<?php
/*
Plugin Name: Selection Sharer
Plugin URI: http://wordpress.org/extend/plugins/selection-sharer/
Description: Medium like popover menu to share on Twitter, Facebook, LinkedIn or by email any text selected on the page, based on the code of @xdamman (https://github.com/xdamman/selection-sharer)
Version: 0.4
Author: J.C. van Gent
Author URI: http://jcvangent.com/
License: GPLv2

Original JavaScript code: Xavier Damman @xdamman
Wordpress Adoptation: Hans van Gent <hans@zerocontent.nl>
*/

//add CSS and JS code to the theme
add_filter( 'wp_footer', 'enqueue_footer_scripts', 9);
add_filter( 'wp', 'enqueue_styles', 11);

// JS
function enqueue_footer_scripts() {
	wp_enqueue_script( 'selection-sharer-js', plugins_url('/js/selection-sharer.js', __FILE__), false, '0.1');
	echo "<script>jQuery(document).ready(function ($) { $('p').selectionSharer();});</script>";	
}

// CSS
function enqueue_styles() {
	wp_register_style('selection-sharer', plugins_url('/css/selection-sharer.css', __FILE__), false, '0.1');
	wp_enqueue_style('selection-sharer');
}
?>