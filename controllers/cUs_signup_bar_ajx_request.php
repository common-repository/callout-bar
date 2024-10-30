<?php

/*
 * Method in charge to save bar settings via ajax post request vars
 * @since 1.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_saveBarSettings', 'cUsSBr_saveBarSettings_callback');
function cUsSBr_saveBarSettings_callback() {
    unset($_REQUEST['action']);
    $form_key = $_REQUEST['bar_formkey'];
    update_option('cUsSBr_settings_BAR_'.$form_key, $_REQUEST );//UPDATE FORM SETTINGS

    echo 1;
    die();
}

/*
 * Method in charge to save bar settings via ajax post request vars
 * @since 1.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_saveBarMobileSettings', 'cUsSBr_saveBarMobileSettings_callback');
function cUsSBr_saveBarMobileSettings_callback() {
    unset($_REQUEST['action']);
    $form_key = $_REQUEST['bar_formkey'];
    update_option('cUsSBr_settings_MOBILE_BAR_'.$form_key, $_REQUEST );//UPDATE FORM SETTINGS

    echo 1;
    die();
}

/*
 * Method in charge to save bar settings via ajax post request vars
 * @since 1.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_saveBarActions', 'cUsSBr_saveBarActions_callback');
function cUsSBr_saveBarActions_callback() {
    unset($_REQUEST['action']);
    $form_key = $_REQUEST['bar_formkey'];
    update_option('cUsSBr_settings_BAR_ACTIONS_'.$form_key, $_REQUEST );//UPDATE BAR ACTIONS

    echo 1;
    die();
}

/*
 * Method in charge to save bar settings via ajax post request vars
 * @since 1.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_getBarSettings', 'cUsSBr_getBarSettings_callback');
function cUsSBr_getBarSettings_callback() {
    unset($_REQUEST['action']);
    $form_key = $_REQUEST['form_key'];
    $aryOptions = get_option('cUsSBr_settings_BAR_'.$form_key );//GET BAR SETTINGS
    foreach ($aryOptions as $key=>$value) {
        $aryOptions[$key] = stripslashes($value);
    }
    echo json_encode($aryOptions);
    die();
}

// loginAlreadyUser handler function...
/*
 * Method in charge to login user via ajax post request vars
 * @since 2.0
 * @return array jSon encoded array
 */
add_action('wp_ajax_cUsSBr_loginAlreadyUser', 'cUsSBr_loginAlreadyUser_callback');
function cUsSBr_loginAlreadyUser_callback() {
    
    $cUsSBr_api = new cUsComAPI_SBr();
    $cUs_email = $_REQUEST['email'];
    $cUs_pass = $_REQUEST['pass'];
    
    //API CALL TO getAPICredentials
    $cUsSBr_API_credentials = $cUsSBr_api->getAPICredentials($cUs_email, $cUs_pass); //api hook;
    
    if($cUsSBr_API_credentials){
        $cUs_json = json_decode($cUsSBr_API_credentials);
        
        //SWITCH API STATUS RESPONSE
        switch ( $cUs_json->status  ) {
            case 'success':
                
                $cUs_API_Account    = $cUs_json->api_account;
                $cUs_API_Key        = $cUs_json->api_key;
                
                if(strlen(trim($cUs_API_Account)) && strlen(trim($cUs_API_Key))){
                    
                    $aryUserCredentials = array(
                        'API_Account' => $cUs_API_Account,
                        'API_Key'     => $cUs_API_Key
                    );
                    update_option('cUsSBr_settings_userCredentials', $aryUserCredentials);
                    
                    $cUsSBr_API_getKeysResult = $cUsSBr_api->getFormKeysData($cUs_API_Account, $cUs_API_Key); //api hook;
                    
                    $cUs_jsonKeys = json_decode($cUsSBr_API_getKeysResult);
                
                    if($cUs_jsonKeys->status == 'success' ){
                        
                        $postData = array( 'email' => $cUs_email, 'credential'    => $cUs_pass);
                        update_option('cUsSBr_settings_userData', $postData);
                        
                        $cUsSBr_deeplinkview = $cUsSBr_api->get_deeplink( $cUs_jsonKeys->data );
                        
                        // get a default deeplink
                        update_option('cUsSBr_settings_default_deep_link_view', $cUsSBr_deeplinkview ); // DEFAULT FORM KEYS
                        
                        foreach ($cUs_jsonKeys->data as $oForms => $oForm) {
                            if ($oForm->default == 1){ //GET DEFAULT CONTACT FORM KEY
                               $defaultFormKey = $oForm->form_key;
                               $deeplinkview   = $oForm->deep_link_view;
                               $defaultFormId  = $oForm->form_id;
                               break;
                            }
                        } 
                            
                        if(empty($defaultFormKey)){
                                //echo 2; //NO ONE CONTACT FORM 
                                
                                $aryResponse = array(
                                    'status' => 2,
                                    'cUs_API_Account' 	=> $cUs_API_Account,
                                    'cUs_API_Key' 	=> $cUs_API_Key,
                                    'deep_link_view'	=> $cUsSBr_deeplinkview
                                );
                                
                               
                        }else{
                            
                            $aryFormOptions = array('tab_user' => 1,'cus_version' => 'tab'); //DEFAULT SETTINGS / FIRST TIME
                            
                            update_option('cUsSBr_settings_FORM', $aryFormOptions );//UPDATE FORM SETTINGS
                            update_option('cUsSBr_settings_form_key', $defaultFormKey);//DEFAULT FORM KEYS
                            update_option('cUsSBr_settings_form_keys', $cUs_jsonKeys); // ALL FORM KEYS
                            update_option('cUsSBr_settings_form_id', $defaultFormId); // DEFAULT FORM KEYS
                            update_option('cUsSBr_settings_default_deep_link_view', $deeplinkview); // DEFAULT FORM KEYS
                            
                            $aryResponse = array('status' => 1);
                            
                        }
                        
                    }else{
                        $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                    } 
                    
                }else{
                    $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                }
                
                break;

            case 'error':
                $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                break;
        }
    }

    echo json_encode($aryResponse);
    
    die();
}


// cUsSBr_verifyCustomerEmail handler function...
/*
 * Method in charge to verify if the email exist via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_verifyCustomerEmail', 'cUsSBr_verifyCustomerEmail_callback');
function cUsSBr_verifyCustomerEmail_callback() {
    
    if      ( !strlen(filter_input(INPUT_POST, 'fName',FILTER_SANITIZE_STRING)) ){      echo 'Missing First Name, is required field';      die();
    }elseif  ( !strlen(filter_input(INPUT_POST, 'lName',FILTER_SANITIZE_STRING)) ){      echo 'Missing Last Name, is required field';       die();
    }elseif  ( !strlen(filter_input(INPUT_POST, 'Email',FILTER_VALIDATE_EMAIL)) ){      echo 'Missing/Invalid Email, is required field';   die();
    }elseif  ( !strlen(filter_input(INPUT_POST, 'website')) ){    echo 'Missing Website, is required field';         die();
    }else{
        
        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API

        switch(filter_input(INPUT_POST, 'formOption')){
            case 'email_list':
                $Template_Desktop_Form = 'newsletterTemplate18';
                $Template_Desktop_Tab = 'invisibleTab';
                break;
            case 'sales_leads':
            case 'contact_inquires':
                $Template_Desktop_Form = 'genericTemplate1';
                $Template_Desktop_Tab = 'invisibleTab';
                break;
        }

        $postData = array(
            'fname' => filter_input(INPUT_POST, 'fName',FILTER_SANITIZE_STRING),
            'lname' => filter_input(INPUT_POST, 'lName',FILTER_SANITIZE_STRING),
            'email' => filter_input(INPUT_POST, 'Email',FILTER_VALIDATE_EMAIL),
            'phone' => filter_input(INPUT_POST, 'Phone', FILTER_SANITIZE_NUMBER_INT),
            'Template_Desktop_Form' => $Template_Desktop_Form,
            'Template_Desktop_Tab' => $Template_Desktop_Tab,
            'credential' => filter_input(INPUT_POST, 'credential'),
            'website' => filter_input(INPUT_POST, 'website')
        );

        $cUsSBr_API_EmailResult = $cUsSBr_api->verifyCustomerEmail(filter_input(INPUT_POST, 'Email',FILTER_VALIDATE_EMAIL)); //EMAIL VERIFICATION
        if($cUsSBr_API_EmailResult) {
            $cUsSBr_jsonEmail = json_decode($cUsSBr_API_EmailResult);
            
            switch ($cUsSBr_jsonEmail->result){
                case 0 :
                    //echo 'No Existe';
                    $aryResponse = array('status' => 1, 'message' => $cUsSBr_jsonEmail->message);
                    //echo 1;
                    update_option('cUsSBr_settings_userData', $postData);
                    break;
                case 1 :
                    //echo 'Existe';
                    $aryResponse = array('status' => 2, 'message' => $cUsSBr_jsonEmail->message);
                    //echo 2;//ALREDY CUS USER
                    delete_option('cUsSBr_settings_userData');
                    break;
            }
            
        }else{
            $aryResponse = array('status' => 3, 'message' => 'Unfortunately there has being an error during the application, please try again' );
        }
         
    }

    echo json_encode($aryResponse);

    die();
}


// cUsSBr_createCustomer handler function...
/*
 * Method in charge to create a contactus.com user via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_createCustomer', 'cUsSBr_createCustomer_callback');
function cUsSBr_createCustomer_callback() {
    
    $cUsSBr_userData = get_option('cUsSBr_settings_userData'); //get the saved user data
    
    if      ( !strlen($cUsSBr_userData['fname']) ){      echo 'Missing First Name, is required field';      die();
    }elseif  ( !strlen($cUsSBr_userData['lname']) ){      echo 'Missing Last Name, is required field';       die();
    }elseif  ( !strlen($cUsSBr_userData['email']) ){      echo 'Missing/Invalid Email, is required field';   die();
    }elseif  ( !strlen($cUsSBr_userData['website']) ){    echo 'Missing Website, is required field';         die();
    }elseif  ( !strlen($cUsSBr_userData['Template_Desktop_Form']) ){    echo 'Missing Form Template';         die();
    }elseif  ( !strlen($cUsSBr_userData['Template_Desktop_Tab']) ){    echo 'Missing Tab Template';         die();
    }else{
        
        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API
        
        $postData = array(
            'fname' => $cUsSBr_userData['fname'],
            'lname' => $cUsSBr_userData['lname'],
            'email' => $cUsSBr_userData['email'],
            'website' => $cUsSBr_userData['website'],
            'phone' => preg_replace('/[^0-9]+/i', '', $cUsSBr_userData['phone']),
            'Template_Desktop_Form' => $cUsSBr_userData['Template_Desktop_Form'],
            'Template_Desktop_Tab' => $cUsSBr_userData['Template_Desktop_Tab'],
            'Main_Category' => filter_input(INPUT_POST, 'CU_category',FILTER_SANITIZE_STRING),
            'Sub_Category' => filter_input(INPUT_POST, 'CU_subcategory',FILTER_SANITIZE_STRING),
            'Goals' => filter_input(INPUT_POST, 'CU_goals',FILTER_SANITIZE_STRING)
        );
        
        $cUsSBr_API_result = $cUsSBr_api->createCustomer($postData, $cUsSBr_userData['credential']);
        if($cUsSBr_API_result) {

            $cUs_json = json_decode($cUsSBr_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    
                    //echo 1;//GREAT
                    $aryResponse = array('status' => 1, 'message' => $cUs_json->message);
                    update_option('cUsSBr_settings_form_key', $cUs_json->form_key ); //finally get form key form contactus.com // SESSION IN
                    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
                        'tab_user'          => 1,
                        'cus_version'       => 'tab'
                    ); 
                    update_option('cUsSBr_settings_FORM', $aryFormOptions );//UPDATE FORM SETTINGS
                    update_option('cUsSBr_settings_userData', $postData);
                    
                    $cUs_API_Account    = $cUs_json->api_account;
                    $cUs_API_Key        = $cUs_json->api_key;
                    
                    $aryUserCredentials = array(
                        'API_Account' => $cUs_API_Account,
                        'API_Key'     => $cUs_API_Key
                    );
                    update_option('cUsSBr_settings_userCredentials', $aryUserCredentials);
                    
                    // ********************************
                    // get here the default deeplink after creating customer
                    $cUsSBr_API_getKeysResult = $cUsSBr_api->getFormKeysData($cUs_API_Account, $cUs_API_Key); //api hook;
                    
                    $cUs_jsonKeys = json_decode( $cUsSBr_API_getKeysResult );
                    $cUsSBr_deeplinkview = $cUsSBr_api->get_deeplink( $cUs_jsonKeys->data );
                    // get the default contact form deeplink
                    if( strlen( $cUsSBr_deeplinkview ) ){
                        update_option('cUsSBr_settings_default_deep_link_view', $cUsSBr_deeplinkview ); // DEFAULT FORM KEYS
                    }
                    // save the form id for this donation new user
                    update_option( 'cUsSBr_settings_form_id', $cUs_jsonKeys->data[0]->form_id );

                break;

                case 'error':

                    if($cUs_json->error == 'Email exists'){
                        //echo 2;//ALREDY CUS USER
                        $aryResponse = array('status' => 2, 'message' => $cUs_json->message);
                        //$cUsSBr_api->resetData(); //RESET DATA
                    }else{
                        //ANY ERROR
                        //echo $cUs_json->error;
                        $aryResponse = array('status' => 3, 'message' => $cUs_json->message);
                        //$cUsSBr_api->resetData(); //RESET DATA
                    }
                    
                break;


            }
            
        }else{
             //echo 3;//API ERROR
            //echo $cUs_json->error;
            $aryResponse = array('status' => 3, 'message' => $cUs_json->message);
             // $cUsSBr_api->resetData(); //RESET DATA
        }
        
         
    }

    echo json_encode($aryResponse);
    
    die();
}


// LoadDefaultKey handler function...
/*
 * Method in charge to set default form key by user via ajax post request vars
 * @since 2.0
 * @return array jSon encoded array
 */
add_action('wp_ajax_cUsSBr_LoadDefaultKey', 'cUsSBr_LoadDefaultKey_callback');
function cUsSBr_LoadDefaultKey_callback() {
    
    $cUsSBr_api = new cUsComAPI_SBr();
    $cUsSBr_userData = get_option('cUsSBr_settings_userData'); //get the saved user data
    $cUs_email = $cUsSBr_userData['email'];
    $cUs_pass = $cUsSBr_userData['credential'];
    
    $cUsSBr_API_result = $cUsSBr_api->getFormKeysData($cUs_email, $cUs_pass); //api hook;
    if($cUsSBr_API_result){
        $cUs_json = json_decode($cUsSBr_API_result);

        switch ( $cUs_json->status  ) {
            case 'success':
                
                foreach ($cUs_json->data as $oForms => $oForm) {
                    if ($oForms !='status' && $oForm->form_type == 0 && $oForm->default == 1){//GET DEFAULT CONTACT FORM KEY
                       $defaultFormKey = $oForm->form_key;
                    }
                }
                
                update_option('cUsSBr_settings_form_key', $defaultFormKey);
                
                echo 1;
                break;

            case 'error':
                echo $cUs_json->error;
                //$cUsSBr_api->resetData(); //RESET DATA
                break;
        }
    }
    
    die();
}

// cUsSBr_setDefaulFormKey handler function...
/*
 * Method in charge to set default form key in all WP environment via ajax post request vars
 * @since 4.0.1
 * @return atring Status value array
 */
add_action('wp_ajax_cUsSBr_setDefaulFormKey', 'cUsSBr_setDefaulFormKey_callback');
function cUsSBr_setDefaulFormKey_callback() {
    
    if(isset($_REQUEST['formKey'])){
       update_option('cUsSBr_settings_form_key', $_REQUEST['formKey']);
       echo 1;//GREAT
    }
    
    die();
}

// cUsSBr_createCustomer handler function...
/*
 * Method in charge to update user form templates via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_UpdateTemplates', 'cUsSBr_UpdateTemplates_callback');
function cUsSBr_UpdateTemplates_callback() {
    
    $cUsSBr_userData = get_option('cUsSBr_settings_userData'); //get the saved user data
    
    if      ( !strlen($cUsSBr_userData['email']) ){      echo 'Missing/Invalid Email, is required field';   die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Form']) ){    echo 'Missing Form Template';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Tab']) ){    echo 'Missing Tab Template';         die();
    }else{
        
        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API
        $form_key       = get_option('cUsSBr_settings_form_key');
        $postData = array(
            'email' => $cUsSBr_userData['email'],
            'credential' => $cUsSBr_userData['credential'],
            'Template_Desktop_Form' => $_REQUEST['Template_Desktop_Form'],
            'Template_Desktop_Tab' => $_REQUEST['Template_Desktop_Tab']
        );
        
        $cUsSBr_API_result = $cUsSBr_api->updateFormSettings($postData, $form_key);
        if($cUsSBr_API_result) {

            $cUs_json = json_decode($cUsSBr_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT

                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsSBr_api->resetData(); //RESET DATA
                break;


            }
            
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsSBr_api->resetData(); //RESET DATA
        }
         
    }
    
    die();
}

/*
 * Method in charge to chage user form templates via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_changeFormTemplate', 'cUsSBr_changeFormTemplate_callback');
function cUsSBr_changeFormTemplate_callback() {
    
    $cUsSBr_userData = get_option('cUsSBr_settings_userCredentials'); //get the saved user data
   
    if      ( !strlen($cUsSBr_userData['API_Account']) ){     echo 'Missing API Account';   die();
    }elseif  ( !strlen($cUsSBr_userData['API_Key']) ){         echo 'Missing Form Key';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Form']) ){    echo 'Missing Form Template';         die();
    }elseif  ( !strlen($_REQUEST['form_key']) ){    echo 'Missing Form Key';         die();
    }else{
        
        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API
        $form_key = $_REQUEST['form_key'];
        
        $postData = array(
            'API_Account'       => $cUsSBr_userData['API_Account'],
            'API_Key'           => $cUsSBr_userData['API_Key'],
            'Template_Desktop_Form' => $_REQUEST['Template_Desktop_Form']
        );
        
        $cUsSBr_API_result = $cUsSBr_api->updateFormSettings($postData, $form_key);
        if($cUsSBr_API_result) {

            $cUs_json = json_decode($cUsSBr_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT

                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsSBr_api->resetData(); //RESET DATA
                break;


            } 
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsSBr_api->resetData(); //RESET DATA
        } 
        
         
    } 
    
    die();
}

/*
 * Method in charge to update user tab templates via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_changeTabTemplate', 'cUsSBr_changeTabTemplate_callback');
function cUsSBr_changeTabTemplate_callback() {
    
    $cUsSBr_userData = get_option('cUsSBr_settings_userCredentials'); //get the saved user data
   
    if       ( !strlen($cUsSBr_userData['API_Account']) ){       echo 'Missing API Account';   die();
    }elseif  ( !strlen($cUsSBr_userData['API_Key']) ){           echo 'Missing Form Key';      die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Tab']) ){    echo 'Missing Tab Template';  die();
    }elseif  ( !strlen($_REQUEST['form_key']) ){                echo 'Missing Form Key';      die();
    }else{
        
        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API
        $form_key = $_REQUEST['form_key'];
        
        $postData = array(
            'API_Account'       => $cUsSBr_userData['API_Account'],
            'API_Key'           => $cUsSBr_userData['API_Key'],
            'Template_Desktop_Tab' => $_REQUEST['Template_Desktop_Tab']
        );
        
        $cUsSBr_API_result = $cUsSBr_api->updateFormSettings($postData, $form_key);
        if($cUsSBr_API_result) {

            $cUs_json = json_decode($cUsSBr_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT

                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsSBr_api->resetData(); //RESET DATA
                break;


            } 
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsSBr_api->resetData(); //RESET DATA
        } 
        
         
    }
    
    die();
}



// save custom selected pages handler function...
/*
 * Method in charge to save form settings via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_saveCustomSettings', 'cUsSBr_saveCustomSettings_callback');
function cUsSBr_saveCustomSettings_callback() {
    
    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
        'tab_user'          => $_REQUEST['tab_user'],
        'cus_version'       => $_REQUEST['cus_version']
    ); 
    update_option('cUsSBr_settings_FORM', $aryFormOptions );//UPDATE FORM SETTINGS
    
    cUsSBr_page_settings_cleaner();
    
    delete_option( 'cUsSBr_settings_inlinepages' );
    delete_option( 'cUsSBr_settings_tabpages' );
   
    
    die();
}

// save custom selected pages handler function...
/*
 * Method in charge to remove page settings via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_deletePageSettings', 'cUsSBr_deletePageSettings_callback');
function cUsSBr_deletePageSettings_callback() {
    
    $pageID = $_REQUEST['pageID'];
    
    delete_post_meta($pageID, 'cUsSBr_FormByPage_settings');//reset values
    cUsSBr_inline_shortcode_cleaner_by_ID($pageID); //RESET SC
    
    $aryTabPages = get_option('cUsSBr_settings_tabpages');
    $aryTabPages = cUsSBr_removePage($pageID,$aryTabPages);
    update_option( 'cUsSBr_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            
    $aryInlinePages = get_option('cUsSBr_settings_inlinepages');
    $aryInlinePages = cUsSBr_removePage($pageID,$aryInlinePages);
    update_option( 'cUsSBr_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
    
    die();
}

// save custom selected pages handler function...
/*
 * Method in charge to update user page settings from page selection via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_changePageSettings', 'cUsSBr_changePageSettings_callback');
function cUsSBr_changePageSettings_callback() {
    
    $pageID = $_REQUEST['pageID'];
    delete_post_meta($pageID, 'cUsSBr_FormByPage_settings');//reset values
    cUsSBr_inline_shortcode_cleaner_by_ID($pageID); //RESET SC
    $aryTabPages = get_option('cUsSBr_settings_tabpages');
    $aryInlinePages = get_option('cUsSBr_settings_inlinepages');
    
    switch ($_REQUEST['cus_version']){
        case 'tab':
            
            $tabUser = 1;
            
            $aryTabPages[] = $pageID;
            $aryTabPages = array_unique($aryTabPages);
            update_option('cUsSBr_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            
            if(!empty($aryInlinePages)){
                $aryInlinePages = cUsSBr_removePage($pageID,$aryInlinePages);
                update_option( 'cUsSBr_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
            }

            $aryResponse = array('status' => 1);
            
            break;
        case 'inline':
            
            $tabUser = 0;
            
            $aryInlinePages[] = $pageID;
            $aryInlinePages = array_unique($aryInlinePages);
            update_option( 'cUsSBr_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
            
            if(!empty($aryTabPages)){
                $aryTabPages = cUsSBr_removePage($pageID,$aryTabPages);
                update_option( 'cUsSBr_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            }
            
            cUsSBr_inline_shortcode_add($pageID); //ADDING SHORTCODE FOR INLINE PAGES

            $aryResponse = array('status' => 1);
            
            break;
    } 
    
    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
        'tab_user'          => $tabUser,
        'form_key'          => $_REQUEST['form_key'],   
        'cus_version'       => $_REQUEST['cus_version']
    );
    
    if($pageID != 'home'){
        update_post_meta($pageID, 'cUsSBr_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
    }else{
       update_option('cUsSBr_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS
    }

    echo json_encode($aryResponse);
    
    die();
}

/*
 * Method in charge to remove page settings via ajax post request vars
 * @since 2.0
 * @return string Value status to switch
 */
function cUsSBr_removePage($valueToSearch, $arrayToSearch){
    $key = array_search($valueToSearch,$arrayToSearch);
    if($key!==false){
        unset($arrayToSearch[$key]);
    }
    return $arrayToSearch;
}

// logoutUser handler function...
/*
 * Method in charge to remove wp options saved with this plugin via ajax post request vars
 * @since 1.0
 * @return string Value status to switch
 */
add_action('wp_ajax_cUsSBr_logoutUser', 'cUsSBr_logoutUser_callback');
function cUsSBr_logoutUser_callback() {
    
    $cUsSBr_api = new cUsComAPI_SBr();
    $cUsSBr_api->resetData(); //RESET DATA
    
    delete_option( 'cUsSBr_settings_api_key' );
    delete_option( 'cUsSBr_settings_form_key' );
    delete_option( 'cUsSBr_settings_list_Name' );
    delete_option( 'cUsSBr_settings_list_ID' );
    
    echo 'Deleted.... User data'; //none list
    
    die();
}