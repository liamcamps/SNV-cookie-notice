<?php
/*
Plugin Name:        Stijl & vorm Cookie notice
Plugin URI:         https://stijlenvorm.nl
Description:        A plug-in to add a cookie notice to the front-end of the site and make it possible to load scripts after notice is accepted
Version:            1.2.1
Author:             Liam Camps
Author URI:         https://liamcamps.nl
*/

add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {
    include_once 'lib/updater.php';
    define( 'WP_GITHUB_FORCE_UPDATE', true );
    if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
        $config = array(
            'slug' => plugin_basename( __FILE__ ),
            'proper_folder_name' => 'snv-cookie-notice', // this is the name of the folder your plugin lives in
            'api_url' => 'https://api.github.com/repos/liamcamps/SNV-cookie-notice', // the GitHub API url of your GitHub repo
            'raw_url' => 'https://raw.github.com/liamcamps/SNV-cookie-notice/master',
            'github_url' => 'https://github.com/liamcamps/SNV-cookie-notice', // the GitHub url of your GitHub repo
            'zip_url' => 'https://github.com/liamcamps/SNV-cookie-notice/archive/master.zip', // the zip url of the GitHub repo
            'sslverify' => true,
            'requires' => '3.0',
            'tested' => '3.3',
            'readme' => 'README.md',
            'access_token' => '',
        );
        new WP_GitHub_Updater( $config );
    }
}
// Add function to check for active plugin
include_once( 'lib/ispluginactive.php' );

stijlenvorm_is_this_plugin_active( __FILE__, 'Cookie notice', 'Advanced Custom Fields PRO', 'advanced-custom-fields-pro/acf.php');

if (function_exists('acf_add_options_page')) {
	// include hex to RGBA library
	include_once( 'lib/functions/hex2rgba.php' );

	// the html for the main notice
	include_once( 'lib/notice/cookienoticehtml.php' );

	// add cookie notice form function
	include_once( 'lib/notice/cookieform.php' );

	// the html for the main notice
	include_once( 'lib/functions/cookieshortcode.php' );

	// the html for the main notice
	include_once( 'lib/config/acfsetup.php' );

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
}