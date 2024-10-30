<?php

/**
 * 
 * CALLOUT BAR BY CONTACTUS.COM
 * 
 * Initialization Functions
 * @since 3.1 First time this was introduced into plugin.
 * @author ContactUs.com <support@contactus.com>
 * @copyright 2014 ContactUs.com Inc.
 * Company      : contactus.com
 * Updated  	: 20140328
 **/

$cus_dirbase = trailingslashit(basename(dirname(__FILE__)));
$cus_dir = trailingslashit(WP_PLUGIN_DIR) . $cus_dirbase;
$cus_url = trailingslashit(WP_PLUGIN_URL) . $cus_dirbase;

//CONFIG VARS
require_once( $cus_dir . 'cUs_callout_bar_conf.php');

//CUS API OBJECT
if (!class_exists('cUsComAPI_SBr')) {
    require_once( cUsSBr_DIR . 'libs/cusAPI.class.php');
}
//AJAX REQUEST HOOKS
require_once( cUsSBr_DIR . 'controllers/cUs_signup_bar_ajx_request.php');

include_once cUsSBr_DIR . 'views/cUs_signup_bar_render.php';

/* -----------------------CONTACTUS.COM--------------------------- */

if (!function_exists('cUsSBr_admin_header')) {
   /*
    * Method in charge to render plugin js libraries and css
    * @since 1.0
    * @return string Return Html into wp admin header
    */
    function cUsSBr_admin_header() {
        
        global $current_screen;

        if ($current_screen->id == 'toplevel_page_cUs_callout_bar_plugin') {
            
            wp_enqueue_style( 'cUsSBr_Styles', plugins_url('assets/style/cUsSBr_style.css', __FILE__), false, '1' );
            wp_enqueue_style( 'colorbox', plugins_url('assets/scripts/colorbox/colorbox.css', __FILE__), false, '1' );

            wp_enqueue_style( 'bxslider', plugins_url('assets/scripts/bxslider/jquery.bxslider.css', __FILE__), false, '1' );
            wp_enqueue_style( 'wp-jquery-ui-dialog' );
            wp_enqueue_style( 'cUsSBr_style_front', plugins_url('assets/style/cUsSbr_frontEnd.css', __FILE__), false, '1' );

            wp_register_script( 'cUsSBr_Scripts', plugins_url('assets/scripts/cUsSBr_scripts.js?pluginurl=' . dirname(__FILE__), __FILE__), array('jquery'), '4.0', true);
            wp_localize_script( 'cUsSBr_Scripts', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
            wp_register_script( 'cUsSBr_cats_module', plugins_url('assets/scripts/cUsSBr_cats_module.js?pluginurl=' . dirname(__FILE__), __FILE__), array('jquery'), '1.0', true);
            wp_register_script( 'colorbox', plugins_url('assets/scripts/colorbox/jquery.colorbox-min.js', __FILE__), array('jquery'), '1.4.33', true);
            wp_register_script( 'bxslider', plugins_url('assets/scripts/bxslider/jquery.bxslider.js', __FILE__), array('jquery'), '4.1.1', true);

            wp_enqueue_script( 'jquery' ); //JQUERY WP CORE
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-accordion' );
            wp_enqueue_script( 'jquery-ui-tabs' );
            wp_enqueue_script( 'jquery-ui-button' );
            wp_enqueue_script( 'jquery-ui-selectable' );
            wp_enqueue_script( 'jquery-ui-dialog' );
            wp_enqueue_script( 'jquery-ui-tooltip' );
            wp_enqueue_script( 'jquery-ui-slider' );

            wp_enqueue_style( 'farbtastic' );
            wp_enqueue_script( 'farbtastic' );

            wp_enqueue_script( 'colorbox' );
            wp_enqueue_script( 'bxslider' );
            wp_enqueue_script( 'cUsSBr_Scripts' );
            wp_enqueue_script( 'cUsSBr_cats_module' );
            
            //CONTACT FORM SUPPORT CHAT
            //wp_register_script( 'cUsSBr_support_chat', '//cdn.contactus.com/cdn/forms/NTU3NGQ4ZjFkMQ,,/contactus.js', array(), '2.7', true);
            //wp_enqueue_script( 'cUsSBr_support_chat' );
            
        }
        
    }

} 
add_action('admin_enqueue_scripts', 'cUsSBr_admin_header'); // cUsSBr_admin_header hook
//END CONTACTUS.COM PLUGIN STYLES CSS

function cUsSBr_FrontScripts(){

    if (!is_admin()) {
        wp_enqueue_style('cUsSBr_style_front', plugins_url('assets/style/cUsSbr_frontEnd.css', __FILE__), false, '1');

        wp_register_script( 'jbar', plugins_url('assets/scripts/jbar/js/jbar.js', __FILE__), array('jquery'), '1.0', true);
        wp_register_script( 'callout', plugins_url('assets/scripts/cUsSbr_callout.js', __FILE__), array('jquery'), '1.0', true);
        wp_enqueue_script('callout');
        wp_enqueue_script('jbar');
    }

}
add_action( 'wp_enqueue_scripts', 'cUsSBr_FrontScripts' );

//CONTACTUS.COM ADD FORM TO PLUGIN PAGE

// Add option page in admin menu
if (!function_exists('cUsSBr_admin_menu')) {

    function cUsSBr_admin_menu() {
        add_menu_page('Callout Bar by ContactUs.com ', 'Callout Bar', 'edit_themes', 'cUs_callout_bar_plugin', 'cUsSBr_menu_render', plugins_url("assets/style/images/favicon.gif", __FILE__));
    }

}
add_action('admin_menu', 'cUsSBr_admin_menu'); // cUsSBr_admin_menu hook

/*
* Method in charge to render link to Help Center into wp plugins manager page
* @since 1.0
* @return string Return Html plugins manager page
*/
function cUsSBr_plugin_links($links, $file) {
    $plugin_file = 'signup-bar/cUs_signup_bar.php';
    if ($file == $plugin_file) {
        $links[] = '<a target="_blank" style="color: #42a851; font-weight: bold;" href="http://help.contactus.com/">' . __("Get Support", "cus_plugin") . '</a>';
    }
    return $links;
} 
add_filter('plugin_row_meta', 'cUsSBr_plugin_links', 10, 2);


/*
* Method in charge to create the setting button in plugins manager page
* @since 3.0
* @return string Return Html plugins manager page
*/
function cUsSBr_action_links($links, $file) {
    $plugin_file = 'signup-bar/cUs_signup_bar.php';
    //make sure it is our plugin we are modifying
    if ($file == $plugin_file) {
        $settings_link = '<a href="' . admin_url('admin.php?page=cUs_callout_bar_plugin') . '">' . __('Settings', 'cus_plugin') . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
} 
add_filter("plugin_action_links", 'cUsSBr_action_links', 10, 4);

//Display the validation errors and update messages

/*
 * Admin notices
 */

function cUsSBr_admin_notices() {
    settings_errors();
} 
add_action('admin_notices', 'cUsSBr_admin_notices');

/*
 * Method in charge to validate allowed form types
 * @since 1.0
 * @param string $form_type Form type to validate
 * @return boolean
 */
function cUsSBr_allowedFormType($form_type){
    $aryAllowedFormTypes = array('contact_us', 'newsletter', 'donation');
    if( in_array($form_type, $aryAllowedFormTypes) ){
        return TRUE;
    }else{
        return FALSE;
    }
}

/*
 * Method in charge to update default form key
 * @since 4.01
 * @param string $form_key Form Key to validate
 * @return null
 */
function cUsSBr_updateDefaultFormKey($form_key) {
    $default_form_key = get_option('cUsSBr_settings_form_key');
    if ($default_form_key != $form_key) {
        update_option('cUsSBr_settings_form_key', $form_key);
    }
    $form_key = get_option('cUsSBr_settings_form_key');
    
    return $form_key;
}

/*
 * IMPORTANT
* Method in charge to render the contactus.com javascript snippet into the default wp theme
* @since 1.0
* @return string Return Html javascript snippet
*/
function cUsSBr_render() {
    if (!is_admin()) {
        
        $pageID = get_the_ID(); //GET THE CURRENT PAGE ID
        $pageSettings = get_post_meta( $pageID, 'cUsSBr_FormByPage_settings', false ); //current page settings
        $getTabPages    = get_option('cUsSBr_settings_tabpages');

        $formOptions    = get_option('cUsSBr_settings_FORM');//GET THE NEW FORM OPTIONS

        //print_r($formOptions);

        $barVersion     = $formOptions['cus_version'];
        
        if(is_array($pageSettings) && !empty($pageSettings)){
            
            $form_key        = $pageSettings[0]['form_key'];
            $form_id        = $pageSettings[0]['form_id'];

            echo cUsSBr_renderSignupBar($form_key, $form_id);

        }else if($barVersion == 'tab'){

            $form_key  = get_option('cUsSBr_settings_form_key'); // DEFAULT FORM KEY
            $form_id  = get_option('cUsSBr_settings_form_id'); // DEFAULT FORM KEY

            echo cUsSBr_renderSignupBar($form_key, $form_id);

        }elseif($barVersion == 'selectable'){
            if(!empty($getTabPages) && in_array('home', $getTabPages) && is_home() ){
                $getHomePage        = get_option('cUsSBr_HOME_settings');
                $form_key            = $getHomePage['form_key'];

                echo cUsSBr_renderSignupBar($form_key, $form_id);
            }

        }

    }
}
add_action('wp_head', 'cUsSBr_render'); // ADD JS BEFORE BODY TAG

//SHORTCODE MANAGMENT ROUTINES
/*
 * IMPORTANT
* Method in charge to read wp shortcode and render the javascript snippet into the default wp theme
* @since 1.0
* @return string Return Html javascript snippet
*/
function cUsSBr_shortcode_handler($aryFormParemeters) {
    
    $cUsSBr_credentials = get_option('cUsSBr_settings_userCredentials'); //GET USERS CREDENTIALS V3.0 API 1.9
    
    if(!empty($cUsSBr_credentials)){

        if(is_array($aryFormParemeters)){

            $form_key = $aryFormParemeters['formkey'];
            update_option('cUsSBr_settings_FormKey_SC', $form_key);

            return cUsSBr_renderSignupBar($form_key);

        }else{
            $form_key  = get_option('cUsSBr_settings_form_key'); // DEFAULT FORM KEY
            $form_id  = get_option('cUsSBr_settings_form_id'); // DEFAULT FORM KEY

            echo cUsSBr_renderSignupBar($form_key, $form_id);
        }

    }else{
        
        return '<p>Callout Bar by ContactUs.com user Credentials Missing . . . <br/>Please Login Again <a href="'.get_admin_url().'admin.php?page=cUs_callout_bar_plugin" target="_blank">here</a>, Thank You.</p>';
        
    }
}
add_shortcode("show-callout-bar", "cUsSBr_shortcode_handler"); //[show-callout-bar]


/*
 * Method in charge to add the shortcode into the page content by page ID
 * @since 1.0
 * @param int $inline_req_page_id WP Page ID
 * @return array
 */
function cUsSBr_inline_shortcode_add($inline_req_page_id) {
    
    if($inline_req_page_id != 'home'){
        $oPage = get_page($inline_req_page_id);
        $pageContent = $oPage->post_content;
        $pageContent = $pageContent . "\n[show-callout-bar]";
        $aryPage = array();
        $aryPage['ID'] = $inline_req_page_id;
        $aryPage['post_content'] = $pageContent;
        return wp_update_post($aryPage);
    }
}

/*
 * Method in charge to remove page setting to all wp pages content by page ID
 * @since 1.0
 * @return null
 */
function cUsSBr_page_settings_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        delete_post_meta($oPage->ID, 'cUsSBr_FormByPage_settings');//reset values
        cUsSBr_inline_shortcode_cleaner_by_ID($oPage->ID); //RESET SC
    }
}
/*
 * Method in charge to remove the shortcode into the all wp pages content by page ID
 * @since 1.0
 * @return null
 */
function cUsSBr_inline_shortcode_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        $pageContent = $oPage->post_content;
        $pageContent = str_replace('[show-callout-bar]', '', $pageContent);
        $aryPage = array();
        $aryPage['ID'] = $oPage->ID;
        $aryPage['post_content'] = $pageContent;
        wp_update_post($aryPage);
    }
}
/*
 * Method in charge to remove the shortcode into the wp page content by page ID
 * @since 1.0
 * @return null
 */
function cUsSBr_inline_shortcode_cleaner_by_ID($inline_req_page_id) {
    $oPage = get_page( $inline_req_page_id );
    
    $pageContent = $oPage->post_content;
    $pageContent = str_replace('[show-callout-bar]', '', $pageContent);
    $aryPage = array();
    $aryPage['ID'] = $oPage->ID;
    $aryPage['post_content'] = $pageContent;
    
    wp_update_post($aryPage);
    
}

//SHORTCODES

/*
 *  UPDATE NOTICES
 * 
 * Method in charge to display update notice into wp admin header
 * @since 1.0
 * @return string Html
 */
/* Display a notice that can be dismissed */
add_action('admin_notices', 'cUsSBr_update_admin_notice');
function cUsSBr_update_admin_notice() {
	
        global $current_user ;
        $user_id = $current_user->ID;
        
        $aryUserCredentials = get_option('cUsSBr_settings_userCredentials');
        $form_key           = get_option('cUsSBr_settings_form_key');
        $cUs_API_Account    = $aryUserCredentials['API_Account'];
        $cUs_API_Key        = $aryUserCredentials['API_Key'];
        
	if ( ! get_user_meta($user_id, 'cUsSBr_ignore_notice') && !strlen($cUs_API_Account) && !strlen($cUs_API_Key) && strlen($form_key)) {
            echo '<div class="updated"><p>';
            printf(__('Contact Form has been updated!. Please take time to activate your new features <a href="%1$s">here</a>. | <a href="%2$s">Hide Notice</a>'), 'admin.php?page=cUs_callout_bar_plugin', '?cUsSBr_ignore_notice=0');
            echo "</p></div>";
	}
        
}
add_action('admin_init', 'cUsSBr_nag_ignore');
function cUsSBr_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cUsSBr_ignore_notice']) && '0' == $_GET['cUsSBr_ignore_notice'] ) {
             add_user_meta($user_id, 'cUsSBr_ignore_notice', 'true', true);
	}
}

/*
 * Method in charge to return if is mobile
 * @since 1.1
 * @return true/false
 */
function cUsSBr_is_mobile(){
    if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
        return true;

    else
        return false;
}

/*
 * --------------------------------------------------------------
 * 
 * UNISTALL ROUTINES
 * 
 * Method in charge to remove all plugin options and settings
 * @since 1.0
 * @return null
 */
if (!function_exists('cUsSBr_plugin_db_uninstall')) {

    function cUsSBr_plugin_db_uninstall() {

        $cUsSBr_api = new cUsComAPI_SBr();
        $cUsSBr_api->resetData(); //RESET DATA
        
        cUsSBr_page_settings_cleaner();
        
    }
    
}
register_uninstall_hook(__FILE__, 'cUsSBr_plugin_db_uninstall');