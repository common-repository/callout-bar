<?php

function cUsSBr_renderSignupBarDemo(){
    global $current_screen;

    if ($current_screen->id == 'toplevel_page_cUs_callout_bar_plugin') {
?>

    <div class="cUs_oSbr _t0p dFt oSans jbar" data-init="jbar" data-jbar='{ "message" : "", "state" : "open" }'>
        <div class="_xt"><p>Love our website? Signup to our list to keep current on the awesome stuff we’re doing.</p></div>
    </div>

<?php
    }

}

if (is_admin()) {

    add_action('in_admin_footer', 'cUsSBr_renderSignupBarDemo'); // ADD JS BEFORE BODY TAG

}

function cUsSBr_renderSignupBar( $form_key, $form_id = 0 ){

    if (!is_admin() ) {

        $xHtml = "";
        $mobSet = 0;

        $aryBar = get_option('cUsSBr_settings_BAR_'.$form_key );

        if ( wp_is_mobile() ) {
            $aryBar = get_option('cUsSBr_settings_MOBILE_BAR_'.$form_key );
            $mobSet = 1;
            if( !is_array($aryBar) && empty( $aryBar ) ){
                $aryBar = get_option('cUsSBr_settings_BAR_'.$form_key );
                $mobSet = 0;
            }
            //print_r($aryBar);
        }

        $aryBarActions = get_option('cUsSBr_settings_BAR_ACTIONS_'.$form_key );

        //print_r($aryBar);
        //print_r($aryBarActions);

        update_option('cUsSBr_settings_CURRENTKEY', $form_key);

        $form_id = ( is_array($aryBar) && !empty( $aryBar['form_id'] ) ) ? $aryBar['form_id'] : $form_id;
        $form_id = ( empty( $form_id ) && !empty( $aryBarActions['form_id'] )) ? $aryBarActions['form_id'] : $form_id;

        //IF BAR IS ENABLED TO SHOW // SHOW BY DEFAULT
        $barVis = ( is_array($aryBar) ) ? $aryBar['bar-show-'.$form_id] : 1;
        if ( wp_is_mobile() && $mobSet ) {
            $barVis = ( is_array($aryBar) ) ? $aryBar['mob_bar-show-'.$form_id] : 1;
        }

        if( $barVis ){

            $fontF = ( is_array($aryBar) && !empty( $aryBar['font'] ) ) ? $aryBar['font'] : 'oSans';
            $fontZ = ( is_array($aryBar) && !empty( $aryBar['font_size'] ) ) ? $aryBar['font_size'] : '13';
            $fontZ = "font-size:".$fontZ."px;";
            $fontB = ( is_array($aryBar) && !empty( $aryBar['font_bold'] ) ) ? 'bold' : '';
            $fontC = ( is_array($aryBar) && !empty( $aryBar['font_color'] ) ) ? $aryBar['font_color'] : cUsSBr_DFT_TXC;
            $fontC = "color:$fontC;";
            $fontI = ( is_array($aryBar) && !empty( $aryBar['font_ita'] ) ) ? 'ita' : '';

            $barPos = ( is_array($aryBar) && !empty( $aryBar['position_'.$form_id] ) ) ? $aryBar['position_'.$form_id] : '_t0p';
            if ( wp_is_mobile() && $mobSet ) {
                $barPos = ( is_array($aryBar) && !empty( $aryBar['mob_position_'.$form_id] ) ) ? $aryBar['mob_position_'.$form_id] : '_t0p';
            }

            $barBak = ( is_array($aryBar) && !empty( $aryBar['bar_color'] ) ) ? $aryBar['bar_color'] : cUsSBr_DFT_BKG;
            $barBak = "background:$barBak;";
            $barSha = ( is_array($aryBar) && !empty( $aryBar['bar-shadow-'.$form_id] ) ) ? '_shadow' : '';
            if ( wp_is_mobile() && $mobSet ) {
                $barSha = ( is_array($aryBar) && !empty( $aryBar['mob_bar-shadow-'.$form_id] ) ) ? '_shadow' : '';
            }
            
                       
            
            
            /* Disabled Mobile SETTINGS
            
            if ( wp_is_mobile() && $mobSet ) {
                $barTpo = "top:$barTpo_"."px;";
            }
          
            $barTpo_ = ( is_array($aryBar) && !empty( $aryBar['tXt_pos'] ) ) ? $aryBar['tXt_pos'] : '25';
            $barTpo = "top:$barTpo_"."%;";

            $barHgt = ( is_array($aryBar) && !empty( $aryBar['bar_height'] )) ? $aryBar['bar_height'] : "38"; 
            $barHgt = "height:$barHgt"."px;";

            
            */
            $barTxt = ( is_array($aryBar) && !empty( $aryBar['bar_txt'] ) ) ? stripslashes($aryBar['bar_txt']) : cUsSBr_DFT_TXT;
            $barMtp = ( is_array($aryBar) && !empty( $aryBar['bar_margin'] ) ) ? $aryBar['bar_margin'] : '0';

            $strBarCSS = 'style="' . $barBak . $barHgt . '"';
            $strTxtCSS = 'style="' . $fontZ . $fontC . '"';
            $strTxtWprCSS = 'style="' . $barTpo . '"';

            $tabStyle = "\n<style type='text/css'>\n";

            if($barPos == '_b0t'){
                $tabStyle .= "\n.jbar-down-toggle { $barBak bottom:0; border-radius:4px 4px 0 0 ;}\n";
            }else{
                if(is_user_logged_in()){
                    $tabStyle .= "\n.jbar-down-toggle { $barBak top:32px; border-radius:0 0 4px 4px;}\n";
                }else{
                    $tabStyle .= "\n.jbar-down-toggle { $barBak top:0; border-radius:0 0 4px 4px;}\n";
                }

            }

            if(is_user_logged_in()){
                $barMtp = ( is_array($aryBar) && !empty( $aryBar['bar_margin'] ) ) ? $aryBar['bar_margin'].'px' : '32px';
                $tabStyle .= "\ndiv.cUs_oSbr._t0p{top:$barMtp !important;z-index:99998;}\n";
            }else{
                $barMtp = ( is_array($aryBar) && !empty( $aryBar['bar_margin'] ) ) ? $aryBar['bar_margin'].'px' : '0';
                if ( wp_is_mobile() )
                    $barMtp = '0';
                $tabStyle .= "\ndiv.cUs_oSbr._t0p{top:$barMtp !important;}\n";
            }

            $tabStyle .= "\n</style>\n";

            //BAR ACTION SETTINGS
            $barAction = ( is_array($aryBarActions) && !empty( $aryBarActions['action_'.$form_id] ) ) ? $aryBarActions['action_'.$form_id] : 'popup';
            $barActionLINK = ( is_array($aryBarActions) && !empty( $aryBarActions['linkurl'] ) ) ? $aryBarActions['linkurl'] : '';

            $xHtml = "\n<!-- ContactUs.com Callout Bar -->\n";
            $xHtml .= '<div class="cUs_oSbr ' . $barPos . ' ' . $fontF . ' ' . $barSha . ' ' . $fontB . ' ' . $fontI . ' jbar" data-init="jbar" ' . $strBarCSS . ' data-jbar=\'{ "message" : "", "state" : "open" }\' >';
                $xHtml .= '<div class="_xt" '. $strTxtWprCSS .' ';

                switch($barAction){
                    case 'link':
                        $xHtml .= "onclick=\"location.href='$barActionLINK';\" ";
                        break;
                    case 'popup':
                    $xHtml .= "onclick=\"contactusOpenByFormKey('$form_key');\" ";
                        break;
                }

                $xHtml .= " >";
            $xHtml .= '<p ' . $strTxtCSS . ' >' . $barTxt . '</p></div>';
            $xHtml .= '</div>';
            $xHtml .= $tabStyle;
            $xHtml .= "\n<!-- ContactUs.com Callout Bar -->\n";

            do_action('wp_footer', $form_key);
            add_action('wp_footer', 'cUsSBr_renderSignupBar_JS'); // ADD JS BEFORE BODY TAG

        }

        return $xHtml;
    }
}

function cUsSBr_renderSignupBar_JS(){
    if (!is_admin()) {
        $form_key = get_option('cUsSBr_settings_CURRENTKEY' );
        $xHtml = "\n<!-- ContactUs.com Callout Bar -->\n";
        $xHtml .= '<script type="text/javascript" src="' . cUsSBr_ENV_URL . $form_key . '/contactus.js"></script>';
        $xHtml .= "\n<!-- ContactUs.com Callout Bar -->\n";

        echo $xHtml;
    }
}