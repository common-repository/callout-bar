<?php
/*
  Plugin Name: Callout Bar by ContactUs
  Version: 1.2.3
  Plugin URI:  http://help.contactus.com/hc/en-us/sections/200389888-Callout-Bar-Plugin-for-Wordpress
  Description: Awesome Callout Bar by ContactUs Plugin for WordPress.
  Author: contactus.com
  Author URI: http://www.contactus.com/
  License: GPLv2 or later

  Copyright 2014  ContactUs.com  ( email: support@contactuscom.zendesk.com )
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

//INCLUDE WP HOOKS ACTIONS & FUNCTIONS
require_once( dirname(__FILE__) . '/cUs_callout_bar_functions.php');

/*
 * Method in charge to render plugin layout
 * @since 1.0
 * @return string Render HTML layout into WP admin
 */
if (!function_exists('cUsSBr_menu_render')) {
    function cUsSBr_menu_render() {
        
        $cUsSBr_api          = new cUsComAPI_SBr(); //CONTACTUS.COM API
        $aryUserCredentials = get_option('cUsSBr_settings_userCredentials'); //get the values, wont work the first time
        $options            = get_option('cUsSBr_settings_userData'); //get the values, wont work the first time
        $formOptions        = get_option('cUsSBr_settings_FORM');//GET THE NEW FORM OPTIONS
        $form_key           = get_option('cUsSBr_settings_form_key');
        $default_deep_link  = get_option('cUsSBr_settings_default_deep_link_view');
        $cus_version        = $formOptions['cus_version'];
        $boolTab            = $formOptions['tab_user'];
        $cUs_API_Account    = $aryUserCredentials['API_Account'];
        $cUs_API_Key        = $aryUserCredentials['API_Key'];
        
        ?>

        <div id="dialog-message"></div>
        <div class="plugin_wrap">
            
            <div class="cUsSBr_header">
                
                <h2><?php echo cUsSBr_PLUGINNAME; ?> <span> by</span><a href="http://www.contactus.com/" target="_blank"><img src="<?php echo plugins_url('assets/style/images/header-logo.png', __FILE__) ;  ?>"/></a> </h2>
                
                <div class="social_shares">
                    <a class="setLabels" href="https://www.facebook.com/ContactUscom" target="_blank" title="Follow Us on Facebook for new product updates"><img src="<?php echo plugins_url('assets/style/images/cu-facebook-m.png', __FILE__) ;  ?> " alt="Follow Us on Facebook for new product updates"/></a>
                    <a class="setLabels" href="https://plus.google.com/117416697174145120376" target="_blank" title="Follow Us on Google+"><img src="<?php echo plugins_url('assets/style/images/cu-googleplus-m.png', __FILE__) ;  ?> " /></a>
                    <a class="setLabels" href="http://www.linkedin.com/company/2882043" target="_blank" title="Follow Us on LinkedIn"><img src="<?php echo plugins_url('assets/style/images/cu-linkedin-m.png', __FILE__) ;  ?> " /></a>
                    <a class="setLabels" href="https://twitter.com/ContactUsCom" target="_blank" title="Follow Us on Twitter"><img src="<?php echo plugins_url('assets/style/images/cu-twitter-m.png', __FILE__) ;  ?> " /></a>
                    <a class="setLabels" href="http://www.youtube.com/user/ContactUsCom" target="_blank" title="Find tutorials on our Youtube channel"><img src="<?php echo plugins_url('assets/style/images/cu-youtube-m.png', __FILE__) ;  ?> " alt="Find tutorials on our Youtube channel" /></a>
                </div>
            </div>
            
            <div class="cUsSBr_formset">
                <div class="cUsSBr_preloadbox"><div class="cUsSBr_loadmessage"><span class="loading"></span></div></div>
                <div id="cUsSBr_tabs">
                    <ul>
                        <?php
                        /*
                        * CHECK USER LOGIN STATUS strlen($cUs_API_Account)
                        * @since 1.0
                        */  
                        ?>
                        
                        <?php if ( !strlen($form_key) ){ ?><li><a href="#tabs-1">Callout Bar</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-1">Bar Settings</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-2">Bar Placement</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-3">Shortcodes</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li class="gotohelp"><a href="http://help.contactus.com/hc/en-us/sections/200389888-Callout-Bar-Plugin-for-Wordpress" target="_blank">Documentation</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-4">Account</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li class="gotohelp"><a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo $cUs_API_Key; ?>&confirmed=1" target="_blank" rel="toDash" class="goToDashTab">Form Control Panel</a></li><?php } ?>
                    </ul>

                    <?php
                    /*
                    * USER LOGIN STATUS : NOT LOGGED
                    * SHOW LOGIN OR SIGNUP BUTTONS 
                    * @since 1.0
                    */
                    if (!strlen($form_key)){
                        
                        global $current_user;
                        get_currentuserinfo();
                        
                        ?>
                        <div id="tabs-1">
                            
                            <div class="left-content">
                                
                                <div class="first_step">
                                    <h2>Are You Already a ContactUs.com User?</h2>
                                    <button id="cUsSBr_yes" class="btn" type="button" ><span>Yes</span>Set Up My Callout Bar</button>
                                    <button id="cUsSBr_no" class="btn mc_lnk"><span>No</span>Signup Free Now</button>
                                    <p>If you’re an existing ContactUs.com user, we can easily connect the Callout Bar to your ContactUs.com account in order to use the bar as a call-to-action for your forms.  If you’re not already a ContactUs.com, you can easily create a free account to install the Callout Bar and also benefit from ContactUs.com’s form builder and other customer acquisition features.</p>                                    </p>
                                </div>
                                
                                <div id="cUsSBr_settings">

                                    <div class="loadingMessage"></div><div class="advice_notice">Advices....</div><div class="notice">Ok....</div>

                                    <?php
                                    
                                        if( !$cUsSBr_api->_isCurl() ){ ?>
                                            <div class="advice_notice_curl">
                                                <p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>
                                                <p>Error: cURL is NOT installed on this server.</a></p>
                                            </div>
                                        <?php }
                                        
                                    ?>
                                    
                                    <?php
                                    /*
                                    * LOGIN FORM
                                    * @since 1.0
                                    */
                                        if( $cUsSBr_api->_isCurl() )
                                           require_once( cUsSBr_DIR . 'views/cUs_signup_bar_login_form.php');
                                    ?>
                                    
                                    <?php
                                    /*
                                    * SINGUP FORM - SIGNUP WIZARD
                                    * @since 1.0
                                    */
                                        if( $cUsSBr_api->_isCurl() )
                                            require_once( cUsSBr_DIR . 'views/cUs_signup_bar_signup_form.php');
                                    ?>

                                </div>
                                <div class="contaus_features">
                                    <?php
                                    /*
                                    * WYGWCA
                                    * @since 1.0
                                    */
                                    if( $cUsSBr_api->_isCurl() )
                                        require_once( cUsSBr_DIR . 'views/cUs_signup_bar_home_features.php');
                                    ?>
                                </div>
                                
                            </div><!-- // TAB LEFT -->

                            <div class="right-content">
                                <div class="premium_chat">
                                    <a href="http://www.contactus.com/contactus-chat/" target="_blank">
                                        <img src="<?php echo plugins_url('assets/style/images/upgrade-banner-admin.png', __FILE__); ?>" width="100%" height="auto" alt="Upgrade for Awesome Chat Features"  />
                                    </a>
                                </div>
                                <div id="plugin-banner">
                                    <h2 class="plugin-banner-title">ContactUs.com</h2>
                                    <h3 class="plugin-banner-subtitle"> offers so much more than what we could fit into this plugin. </h3>
                                    <a href="http://www.contactus.com/product-tour/" target="_blank" class="btnpb-green btnpb">Tour Our Product</a>
                                    <p class="plugin-banner-content">ContactUs.com builds customer acquisition software to make your website work better for your business. We  provide lots of free tools, and valuable premium tools, to help you grow and manage online customers.</p>
                                </div>
                                <div class="video">
                                    <h2>Plugin Overview</h2>
                                    <iframe width="100%" height="auto" src="//www.youtube.com/embed/9Jsy3bOAE0c" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                </div>
                            </div><!-- // TAB RIGHT -->

                        </div> <!-- // TAB 1 -->
                        
                    <?php }else{
                        
                        global $current_user;
                        get_currentuserinfo();
                        /*
                         * UPDATE OLD USERS
                         * MIGRATION PROCESS
                         * If current logged user don't have api credentials
                         */                              

                        //API CREDENTIALAS STORED
                        if (strlen($cUs_API_Account)) {
                            
                            /*
                            * Get Forms Data // all FORM TYPES
                            */
                            $cUsSBr_API_getFormKeys = $cUsSBr_api->getFormKeysData($cUs_API_Account, $cUs_API_Key); //api hook;
                            
                            $default_deep_link = $cUsSBr_api->parse_deeplink ( $default_deep_link );
                            if( !strlen($default_deep_link) ){
                                $default_deep_link = $cUsSBr_api->getDefaultDeepLink( $cUs_API_Account, $cUs_API_Key ); // get a default deeplink
                                update_option('cUsSBr_settings_default_deep_link_view', $default_deep_link );
                            }
                            
                            $acount = $default_deep_link.'?pageID=7';
                            $reports = $default_deep_link.'?pageID=12';
                            $upgrade = $default_deep_link.'?pageID=82';
                            $createform = $default_deep_link.'?pageID=81&id=0&do=addnew&formType=';
                            
                    ?>

                        <div id="tabs-1">

                                <div class="left-content">
                                    <h2>Configure Your Bar Settings</h2>

                                    <div class="versions_options versions_options_fs">

                                        <p>Manage Callout Bars here. Bars can be paired with Newsletter, Contact Forms and Donation Forms.</p>

                                        <div class="advice_notice">Advices....</div>

                                        <?php
                                        /*
                                        * FORM TYPES RENDER
                                        * @since 1.0
                                        */
                                           require_once( cUsSBr_DIR . 'views/cUs_signup_bar_formsettings_forms.php');
                                        ?>

                                        <!-- NEWSLETTER FORMS-->
                                        <div class="gray_box">
                                            <h3 class="form_title">Newsletter Bar &nbsp;<a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($createform)); ?>newsletter" target="_blank">Add a New Newsletter Bar <span>+</span></a></h3>

                                                <?php
                                                /*
                                                 * Get Forms Data // newsletter FORM TYPES
                                                 */

                                                echo cUsSBr_renderFormType('newsletter', $cUsSBr_API_getFormKeys, $createform);

                                                ?>
                                        </div>
                                        <!-- NEWSLETTER FORMS-->

                                        <!-- CONTACT FORMS -->
                                        <div class="gray_box">
                                            <h3 class="form_title">Contact Bar  &nbsp;<a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($createform)); ?>contact_us" target="_blank">Add a New Contact Bar <span>+</span></a></h3>

                                            <?php
                                            /*
                                             * Get Forms Data // contactus FORM TYPES
                                             */

                                            echo cUsSBr_renderFormType('contact_us', $cUsSBr_API_getFormKeys, $createform);

                                            ?>
                                        </div>
                                        <!-- CONTACT FORMS -->

                                        <!-- DONATION FORMS-->
                                        <div class="gray_box">
                                            <h3 class="form_title">Donation Forms <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($createform)); ?>donation" target="_blank">Add a New Donation Form <span>+</span></a></h3>
                                            <?php
                                            /*
                                             * Get Forms Data // donation FORM TYPES
                                             */
                                            echo cUsSBr_renderFormType('donation', $cUsSBr_API_getFormKeys, $createform);
                                            ?>
                                        </div>
                                        <!-- DONATION FORMS-->

                                    </div>
                                </div>

                                <div class="right-content">
                                    <?php
                                    /*
                                     * SIDEBAR
                                     * @since 1.0
                                     */
                                        include( cUsSBr_DIR . 'views/cUs_signup_bar_sidebar_video.php');
                                    ?>
                                </div><!-- // TAB RIGHT -->


                        </div>

                        <div id="tabs-2">

                                <div class="left-content">
                                    <h2>Callout Bar Placement</h2>

                                    <div class="versions_options">

                                        <div class="button_set_tabs_fp">
                                            <button class="form_version btn_tab tab_button setlabel <?php echo ( $cus_version == 'tab' )?'green':'gray'; ?>" value="tab_version" <?php echo ( $cus_version == 'tab' )?'disabled="disabled"':''; ?> title="Places Default Bar on all pages">Place Across Your Site</button>
                                            <button class="form_version btn_tab custom setLabel <?php echo ( $cus_version == 'selectable' )?'green':'gray'; ?>" value="select_version" <?php echo ( $cus_version == 'selectable' )?'disabled="disabled"':''; ?> title="Lets You Choose Different Forms for Each Page">Choose Pages</button>
                                            <span class="sc_message">Do you want use Shortcodes? <br/>Go to <a href="#tabs-3" class="goto_shortcodes">Shortcode Instructions</a></span>
                                        </div>

                                    </div>

                                    <div id="message" class="updated fade notice_success"></div><div class="advice_notice"></div><div class="loadingMessage"></div>

                                    <div>
                                        <p>To place the Callout Bar on every page of your website, choose “Place Across Your Site”, which is the easiest way to get started.  </p>
                                        <p>The second option, “Choose Pages”, will provide flexibility if you want to choose which pages will get the Callout Bar.</p>

                                    </div>

                                    <div class="cUsSBr_DefatulFP">
                                        <?php
                                        /*
                                         * FORM PLACEMENT DEFAULT
                                         * @since 1.0
                                         */
                                        require_once( cUsSBr_DIR . 'views/cUs_signup_bar_formplace_default.php');
                                        ?>
                                    </div>

                                    <div class="cUsSBr_CustomFP">
                                        <?php
                                        /*
                                         * FORM PLACEMENT DEFAULT
                                         * @since 1.0
                                         */
                                        require_once( cUsSBr_DIR . 'views/cUs_signup_bar_formplace_custom.php');
                                        ?>
                                    </div>

                                </div><!-- // TAB LEFT -->

                                <div class="right-content">
                                    <?php
                                    /*
                                     * SIDEBAR VIDEO & SUPPORT
                                     * @since 1.0
                                     */
                                    include( cUsSBr_DIR . 'views/cUs_signup_bar_sidebar_video.php');
                                    ?>
                                </div><!-- // TAB RIGHT -->

                            </div>
                        
                        <div id="tabs-3">
                            <div class="left-content">
                                
                                <h2>WordPress Shortcodes and Snippets</h2>
                                <div>
                                    <div class="terminology_c">
                                        <h4>Copy this code into your template, post, page to place the bar wherever you want it.</h4>
                                        <h4>Note: You can find the Form Key alongside form thumbnails in the bar settings tab.</h4>
                                        <hr/>
                                        <ul class="hints">
                                            <li><b>Default Bar Shortcode</b>
                                                <br/>WP Shortcode:<br/> <code> [show-callout-bar] </code>
                                                <br/>Php Snippet:<br/> <code>&#60;&#63;php echo do_shortcode('[show-callout-bar]'); &#63;&#62;</code>
                                            </li>

                                            <li><b>Custom Bar Shortcode</b>
                                                <br/>WP Shortcode:<br/> <code> [show-callout-bar formkey="FORM KEY HERE"] </code>
                                                <br/>Php Snippet:<br/> <code>&#60;&#63;php echo do_shortcode('[show-callout-bar formkey="FORM KEY HERE"]'); &#63;&#62;</code>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="right-content">
                                <?php
                                /*
                                 * SIDEBAR SOCIAL & SHARE
                                 * @since 1.0
                                 */
                                    include( cUsSBr_DIR . 'views/cUs_signup_bar_sidebar_video.php');
                                ?>
                            </div><!-- // TAB RIGHT -->
                            
                        </div>
                        
                        <div id="tabs-4">
                            
                            <div class="left-content">
                                <h2>Your ContactUs.com Account</h2>
                                
                                <div class="button_set_tabs">
                                    <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($reports)); ?>" target="_blank" class="deep_link_action_tab rep">Contact Management</a>
                                    <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($acount)); ?>" target="_blank" class="deep_link_action_tab ac">Account Information</a>
                                    <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($upgrade)); ?>" target="_blank" class="deep_link_action_tab ac">Upgrade Account</a>
                                </div>
                                
                                <div class="iRecomend">
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsSBr_data" name="cUsSBr_sendkey" class="steps" onsubmit="return false;">
                                        
                                        <table class="form-table">
                                            
                                            <?php if( @strlen($options['fname']) || @strlen($options['lname']) || @strlen($current_user->first_name) ) { ?>
                                            <tr>
                                                <td><label class="labelform">Name</label>
                                                    <span class="cus_names">
                                                        <?php echo ( @strlen($options['fname']) || @strlen($options['lname']) ) ? @$options['fname'] . " " . $options['lname'] : $current_user->first_name . " " . $current_user->last_name ; ?>
                                                    </span>
                                                </td><td></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                    <label class="labelform">Email</label>
                                                    <span class="cus_email"><?php echo @$options['email'];?></span>
                                                </td><td></td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <hr/>
                                                    <input id="logoutbtn" class="btn orange cUsSBr_LogoutUser" value="Unlink Account" type="button">
                                                </td><td></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                                
                            </div>
                            
                            <div class="right-content">
                                <?php
                                    /*
                                     * SIDEBAR SOCIAL & SHARE
                                     * @since 1.0
                                     */
                                        include( cUsSBr_DIR . 'views/cUs_signup_bar_sidebar_video.php');
                                    ?>
                            </div><!-- // TAB RIGHT -->
                            
                        </div>
                        <?php }
                        
                        } ?>
            </div>
        </div>

        <?php
    } //END IF

} // END IF FUNCTION RENDER