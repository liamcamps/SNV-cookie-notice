<?php
/*
Plugin Name:        Stijl & vorm Cookie notice
Plugin URI:         https://stijlenvorm.nl
Description:        A plug-in to add a cookie notice to the front-end of the site and make it possible to load scripts after notice is accepted
Version:            1.0.0
Author:             Liam Camps
Author URI:         https://liamcamps.nl
*/

include_once( 'lib/ispluginactive.php' );

stijlenvorm_is_this_plugin_active('Cookie notice', 'Advanced Custom Fields PRO', 'advanced-custom-fields-pro/acf.php');

// include hex to RGBA library
include_once( 'lib/hex2rgba.php' );

// the html for the main notice
include_once( 'lib/cookienoticehtml.php' );

// add cookie notice form function
include_once( 'lib/cookieform.php' );

// the html for the main notice
include_once( 'lib/cookieshortcode.php' );

// add acf options page
$args = array(
    'page_title' => 'Cookie notice instellingen',
    'parent_slug' => 'options-general.php',
);
acf_add_options_page($args);

include_once( 'lib/addoptionfields.php' );

// adds the cookie function to the footer if not in admin
if (!is_admin()) {
    if (get_field('cookie_notice_php_js', 'option') == 'js') {
        add_action('wp_footer', 'cookie_notice_js');
    } else {
        add_action('wp_footer', 'cookie_notice_php');
    }
}

// Returns wether cookies are accepted or not
function cookies_accepted() {
    if (isset($_COOKIE['cookie_notice_accepted']) && $_COOKIE['cookie_notice_accepted'] == 1) {
        return true;
    } else {
        return false;
    }
}

// js version of the cookie notice
function cookie_notice_js() {
    cookie_notice('js');
    wp_enqueue_script('js-cookie', plugin_dir_url(__FILE__) . 'js/js-cookie.js', array('jquery'), true);
    wp_enqueue_script('cookie-notice-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery','js-cookie'), true);
    wp_enqueue_script('cookie-notice-js-mode', plugin_dir_url(__FILE__) . 'js/js-mode.js', array('jquery'), true);
}

//php version of the cookie notice
function cookie_notice_php() {
    if (!isset($_COOKIE['cookie_notice_dismissed'])) {
        wp_enqueue_script('js-cookie', plugin_dir_url(__FILE__) . 'js/js-cookie.js', array('jquery'), true);
        wp_enqueue_script('cookie-notice-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery','js-cookie'), true);
        cookie_notice('php');
    }
}

// action to add scripts and stuff if cookies are accepted and is not admin
if (!is_admin()) {
	add_action('wp_head', 'cookies_accepted_add');
}

// add scripts and stuff if cookies are accepted
function cookies_accepted_add() {
    if (cookies_accepted()) {
    	if (get_field('cookie_notice_scripts', 'option')) {
    		$scripts = get_field('cookie_notice_scripts', 'option');
    		$i = 0;
    		foreach ($scripts as $script) {
    			wp_enqueue_script('cookie_notice_add'.$i, $script['url'], array('jquery'), true);
    		$i++;}
    	}
    	if (get_field('cookie_notice_extra_js','option')) {
    		echo get_field('cookie_notice_extra_js', 'option');
    	}
    }
}