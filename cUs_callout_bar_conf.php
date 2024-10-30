<?php
/**
 * 
 * CALLOUT BAR BY CONTACTUS.COM
 * 
 * Initialization Config File
 * @since 1.0 First time this was introduced into plugin.
 * @author ContactUs.com <support@contactus.com>
 * @copyright 2014 ContactUs.com Inc.
 * Company      : contactus.com
 * Updated  	: 20140328
 **/

//PLUGIN NAME
$cUs_plug_name = 'Callout Bar';

//DEBUG MODE OFF
error_reporting(0);
error_reporting(E_ERROR);

$cus_dirbase = trailingslashit(basename(dirname(__FILE__)));
$cus_dir = trailingslashit(WP_PLUGIN_DIR) . $cus_dirbase;
$cus_url = trailingslashit(WP_PLUGIN_URL) . $cus_dirbase;

//LIVE ENVIROMENT
$cus_env_url = '//cdn.contactus.com/cdn/forms/';
$cus_par_url = 'https://admin.contactus.com/partners';
$cus_api_enviroment = 'https://api.contactus.com/api2.php';

//WP KEYS
$cus_api_ApiAccountKey = 'AC132f1ca7ff5040732b787564996a02b46cc4b58d';
$cus_api_ApiKey = 'cd690cf4f450950e857b417710b656923cf4b579';

//DEFAULT BAR SETTINGS
$DFT_TXT = 'Love our website? Signup to our list to keep current on the awesome stuff we’re doing.';
$DFT_BKG = '#002968';
$DFT_TXC = '#fff';

//DEFINE GLOBAL ENVIROMENT VARS
define('cUsSBr_DIR', $cus_dir);
define('cUsSBr_URL', $cus_url);
define('cUsSBr_ENV_URL', $cus_env_url);
define('cUsSBr_PARTNER_URL', $cus_par_url);
define('cUsSBr_API_ENV', $cus_api_enviroment);
define('cUsSBr_API_ACC', $cus_api_ApiAccountKey);
define('cUsSBr_API_AKY', $cus_api_ApiKey);
define('cUsSBr_PLUGINNAME', $cUs_plug_name);
define('cUsSBr_DFT_TXT', $DFT_TXT);
define('cUsSBr_DFT_BKG', $DFT_BKG);
define('cUsSBr_DFT_TXC', $DFT_TXC);