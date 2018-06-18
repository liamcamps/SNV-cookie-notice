<?php
function cookie_options_shortcode() {
    wp_enqueue_script('js-cookie', plugin_dir_url(dirname(__FILE__)) . 'js/js-cookie.js', array('jquery'), true);
    wp_enqueue_script('cookie-notice-script', plugin_dir_url(dirname(__FILE__)) . 'js/script.js', array('jquery','js-cookie'), true);
    return cookie_notice_form();
}
add_shortcode('cookie_options', 'cookie_options_shortcode');
