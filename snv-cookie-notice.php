<?php
/*
Plugin Name:        Stijl & vorm Cookie notice
Plugin URI:         https://stijlenvorm.nl
Description:        A plug-in to add a cookie notice to the front-end of the site and make it possible to load scripts after notice is accepted
Version:            1.1
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
/**
 * Configuration assistant for updating from private repositories.
 * Do not include this in your plugin once you get your access token.
 *
 * @see /wp-admin/plugins.php?page=github-updater
 */
class WPGitHubUpdaterSetup {
    /**
     * Full file system path to the main plugin file
     *
     * @var string
     */
    var $plugin_file;
    /**
     * Path to the main plugin file relative to WP_CONTENT_DIR/plugins
     *
     * @var string
     */
    var $plugin_basename;
    /**
     * Name of options page hook
     *
     * @var string
     */
    var $options_page_hookname;
    function __construct() {
        // Full path and plugin basename of the main plugin file
        $this->plugin_file = __FILE__;
        $this->plugin_basename = plugin_basename( $this->plugin_file );
        add_action( 'admin_init', array( $this, 'settings_fields' ) );
        add_action( 'admin_menu', array( $this, 'add_page' ) );
        add_action( 'network_admin_menu', array( $this, 'add_page' ) );
        add_action( 'wp_ajax_set_github_oauth_key', array( $this, 'ajax_set_github_oauth_key' ) );
    }
    /**
     * Add the options page
     *
     * @return none
     */
    function add_page() {
        if ( current_user_can ( 'manage_options' ) ) {
            $this->options_page_hookname = add_plugins_page ( __( 'GitHub Updates', 'github_plugin_updater' ), __( 'GitHub Updates', 'github_plugin_updater' ), 'manage_options', 'github-updater', array( $this, 'admin_page' ) );
            add_filter( "network_admin_plugin_action_links_{$this->plugin_basename}", array( $this, 'filter_plugin_actions' ) );
            add_filter( "plugin_action_links_{$this->plugin_basename}", array( $this, 'filter_plugin_actions' ) );
        }
    }
    /**
     * Add fields and groups to the settings page
     *
     * @return none
     */
    public function settings_fields() {
        register_setting( 'ghupdate', 'ghupdate', array( $this, 'settings_validate' ) );
        // Sections: ID, Label, Description callback, Page ID
        add_settings_section( 'ghupdate_private', 'Private Repositories', array( $this, 'private_description' ), 'github-updater' );
        // Private Repo Fields: ID, Label, Display callback, Menu page slug, Form section, callback arguements
        add_settings_field(
            'client_id', 'Client ID', array( $this, 'input_field' ), 'github-updater', 'ghupdate_private',
            array(
                'id' => 'client_id',
                'type' => 'text',
                'description' => '',
            )
        );
        add_settings_field(
            'client_secret', 'Client Secret', array( $this, 'input_field' ), 'github-updater', 'ghupdate_private',
            array(
                'id' => 'client_secret',
                'type' => 'text',
                'description' => '',
            )
        );
        add_settings_field(
            'access_token', 'Access Token', array( $this, 'token_field' ), 'github-updater', 'ghupdate_private',
            array(
                'id' => 'access_token',
            )
        );
        add_settings_field(
            'gh_authorize', '<p class="submit"><input class="button-primary" type="submit" value="'.__( 'Authorize with GitHub', 'github_plugin_updater' ).'" /></p>', null, 'github-updater', 'ghupdate_private', null
        );
    }
    public function private_description() {
?>
        <p>Updating from private repositories requires a one-time application setup and authorization. These steps will not need to be repeated for other sites once you receive your access token.</p>
        <p>Follow these steps:</p>
        <ol>
            <li><a href="https://github.com/settings/applications/new" target="_blank">Create an application</a> with the <strong>Main URL</strong> and <strong>Callback URL</strong> both set to <code><?php echo bloginfo( 'url' ) ?></code></li>
            <li>Copy the <strong>Client ID</strong> and <strong>Client Secret</strong> from your <a href="https://github.com/settings/applications" target="_blank">application details</a> into the fields below.</li>
            <li><a href="javascript:document.forms['ghupdate'].submit();">Authorize with GitHub</a>.</li>
        </ol>
        <?php
    }
    public function input_field( $args ) {
        extract( $args );
        $gh = get_option( 'ghupdate' );
        $value = $gh[$id];
?>
        <input value="<?php esc_attr_e( $value )?>" name="<?php esc_attr_e( $id ) ?>" id="<?php esc_attr_e( $id ) ?>" type="text" class="regular-text" />
        <?php echo $description ?>
        <?php
    }
    public function token_field( $args ) {
        extract( $args );
        $gh = get_option( 'ghupdate' );
        $value = $gh[$id];
        if ( empty( $value ) ) {
?>
            <p>Input Client ID and Client Secret, then <a href="javascript:document.forms['ghupdate'].submit();">Authorize with GitHub</a>.</p>
            <input value="<?php esc_attr_e( $value )?>" name="<?php esc_attr_e( $id ) ?>" id="<?php esc_attr_e( $id ) ?>" type="hidden" />
            <?php
        }else {
?>
            <input value="<?php esc_attr_e( $value )?>" name="<?php esc_attr_e( $id ) ?>" id="<?php esc_attr_e( $id ) ?>" type="text" class="regular-text" />
            <p>Add to the <strong>$config</strong> array: <code>'access_token' => '<?php echo $value ?>',</code>
            <?php
        }
?>
        <?php
    }
    public function settings_validate( $input ) {
        if ( empty( $input ) ) {
            $input = $_POST;
        }
        if ( !is_array( $input ) ) {
            return false;
        }
        $gh = get_option( 'ghupdate' );
        $valid = array();
        $valid['client_id']     = strip_tags( $input['client_id'] );
        $valid['client_secret'] = strip_tags( $input['client_secret'] );
        $valid['access_token']  = strip_tags( $input['access_token'] );
        if ( empty( $valid['client_id'] ) ) {
            add_settings_error( 'client_id', 'no-client-id', __( 'Please input a Client ID before authorizing.', 'github_plugin_updater' ), 'error' );
        }
        if ( empty( $valid['client_secret'] ) ) {
            add_settings_error( 'client_secret', 'no-client-secret', __( 'Please input a Client Secret before authorizing.', 'github_plugin_updater' ), 'error' );
        }
        return $valid;
    }
    /**
     * Add a settings link to the plugin actions
     *
     * @param array   $links Array of the plugin action links
     * @return array
     */
    function filter_plugin_actions( $links ) {
        $settings_link = '<a href="plugins.php?page=github-updater">' . __( 'Setup', 'github_plugin_updater' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }
    /**
     * Output the setup page
     *
     * @return none
     */
    function admin_page() {
        $this->maybe_authorize();
?>
        <div class="wrap ghupdate-admin">

            <div class="head-wrap">
                <?php screen_icon( 'plugins' ); ?>
                <h2><?php _e( 'Setup GitHub Updates' , 'github_plugin_updater' ); ?></h2>
            </div>

            <div class="postbox-container primary">
                <form method="post" id="ghupdate" action="options.php">
                    <?php
        settings_errors();
        settings_fields( 'ghupdate' ); // includes nonce
        do_settings_sections( 'github-updater' );
?>
                </form>
            </div>

        </div>
        <?php
    }
    public function maybe_authorize() {
        $gh = get_option( 'ghupdate' );
        if ( 'false' == $_GET['authorize'] || 'true' != $_GET['settings-updated'] || empty( $gh['client_id'] ) || empty( $gh['client_secret'] ) ) {
            return;
        }
        $redirect_uri = urlencode( admin_url( 'admin-ajax.php?action=set_github_oauth_key' ) );
        // Send user to GitHub for account authorization
        $query = 'https://github.com/login/oauth/authorize';
        $query_args = array(
            'scope' => 'repo',
            'client_id' => $gh['client_id'],
            'redirect_uri' => $redirect_uri,
        );
        $query = add_query_arg( $query_args, $query );
        wp_redirect( $query );
        exit;
    }
    public function ajax_set_github_oauth_key() {
        $gh = get_option( 'ghupdate' );
        $query = admin_url( 'plugins.php' );
        $query = add_query_arg( array( 'page' => 'github-updater' ), $query );
        if ( isset( $_GET['code'] ) ) {
            // Receive authorized token
            $query = 'https://github.com/login/oauth/access_token';
            $query_args = array(
                'client_id' => $gh['client_id'],
                'client_secret' => $gh['client_secret'],
                'code' => $_GET['code'],
            );
            $query = add_query_arg( $query_args, $query );
            $response = wp_remote_get( $query, array( 'sslverify' => false ) );
            parse_str( $response['body'] ); // populates $access_token, $token_type
            if ( !empty( $access_token ) ) {
                $gh['access_token'] = $access_token;
                update_option( 'ghupdate', $gh );
            }
            wp_redirect( admin_url( 'plugins.php?page=github-updater' ) );
            exit;
        }else {
            $query = add_query_arg( array( 'authorize'=>'false' ), $query );
            wp_redirect( $query );
            exit;
        }
    }
}
add_action( 'init', create_function( '', 'global $WPGitHubUpdaterSetup; $WPGitHubUpdaterSetup = new WPGitHubUpdaterSetup();' ) );

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