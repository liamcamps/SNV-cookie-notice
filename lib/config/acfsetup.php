<?php
// add acf options page
$args = array(
    'page_title' => 'Cookie notice instellingen',
    'parent_slug' => 'options-general.php',
);
acf_add_options_page($args);

// add the field groups
include_once( 'addoptionfields.php' );