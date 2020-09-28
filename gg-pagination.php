<?php
/*
 * Plugin Name: Pagination Ajax
 * Description: Phân trang cho Wordpress bằng Ajax
 * Plugin URI: https://greenglobal.vn/en/
 * Author: ThanhVV
 * Author URI: https://greenglobal.vn/en/
 * Version: 1.0
 * License: GPL2
 */

// Load the plugin's text domain
function pagination_ajax_init() {
	load_plugin_textdomain('pagination_ajax', false, dirname(plugin_basename(__FILE__)) . '/translation');
}
add_action('plugins_loaded', 'pagination_ajax_init');

// Files
require_once ('files/shortcode.php');
require_once ('files/admin.php');
require_once ('files/functions.php');
// CSS file
$options = get_option( 'pagination_settings' );

if ( 1 == ! isset($options['pagination_checkbx_css'] )) {
	add_action('wp_enqueue_scripts', 'pagination_ajax_plugin_styles');
    function pagination_ajax_plugin_styles() {
    	wp_register_style('pagination', plugins_url('gg-ajaxpagination/css/pagination.css'));
    	wp_enqueue_style('pagination');
    }
}

// Shotcode in widget
add_filter('widget_text', 'do_shortcode');
