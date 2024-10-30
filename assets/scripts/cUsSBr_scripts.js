
//PLUGIN cUsSBr_myjq ENVIROMENT (cUsSBr_myjq)
var cUsSBr_myjq = jQuery.noConflict();

cUsSBr_myjq(window).error(function(e){
    e.preventDefault();
});

//ON READY DOM LOADED
cUsSBr_myjq(document).ready(function($) {
    
    try{
        
        //LOADING UI BOX
        cUsSBr_myjq( ".cUsSBr_preloadbox" ).delay(1500).fadeOut();
        
        //UI TABS
        cUsSBr_myjq( "#cUsSBr_tabs" ).tabs({active: false});//UI TABS
        cUsSBr_myjq( ".bar_settings_tabs" ).tabs({
            activate:function(event,ui){
                $.colorbox.resize();
                nTab = ui.newTab.index();
                switch(nTab){
                    case 0:
                        $('.cUs_oSbr').slideDown();
                        break;
                    case 1:
                        $('.cUs_oSbr').slideUp();
                        break;
                }
            }
        });
        
        //GO TO SHORTCODES TABS LINK
        cUsSBr_myjq( ".goto_shortcodes" ).click(function(){
            cUsSBr_myjq( "#cUsSBr_tabs" ).tabs({ active: 2 });
        });

        cUsSBr_myjq('.colorpicker').hide();
        cUsSBr_myjq('.colorpicker').mouseleave(function() {
            var display = $(this).css('display');
            if ( display == 'block' )
                $(this).fadeOut();
        });
        
        //UNBIND UI TABS LINK ON CLICK
        cUsSBr_myjq("li.gotohelp a").unbind('click');
        
        //FORMS AND TABS TEMPLATE SELECTION SLIDER
        cUsSBr_myjq('.selectable_cf, .selectable_tabs_cf').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            //captions:true,
            pager:true,
            slideMargin: 5
        });
        
        //PAGES FORM SELECTION SLIDER
        cUsSBr_myjq('.template_slider').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            preloadImages:'all',    
            //captions:true,
            pager:true,
            slideMargin: 5
        });
        
        //colorbox window
        cUsSBr_myjq(".tooltip_formsett").colorbox({iframe:true, innerWidth:'75%', innerHeight:'80%'});
        
        //TEMPLATE SELECTION
        cUsSBr_myjq( '.options' ).buttonset();
        cUsSBr_myjq( '.form_types' ).buttonset();
        cUsSBr_myjq( '#inlineradio' ).buttonset();
        
        cUsSBr_myjq( '.bx-loading' ).hide(); //DOM BUG FIX
        
        //SELECTED CONTACT FORM TEMPLATE
        cUsSBr_myjq(".selectable_cf, .selectable_news").selectable({
            selected: function(event, ui) {
                var idEl = cUsSBr_myjq(ui.selected).attr('id');
                cUsSBr_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
                cUsSBr_myjq('#Template_Desktop_Form').val(idEl);
            }                   
        });
        
        //SELECTED FORM TAB TEMPLATE
        cUsSBr_myjq(".selectable_tabs_cf, .selectable_tabs_news").selectable({
            selected: function(event, ui) {
                var idEl = cUsSBr_myjq(ui.selected).attr('id');
                cUsSBr_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
                cUsSBr_myjq('#Template_Desktop_Tab').val(idEl);
            }                   
        });
        
        //SELECTED CONTACT FORM TEMPLATE
        cUsSBr_myjq(".selectable_ucf, .selectable_unews").selectable({
            selected: function(event, ui) {
                var idEl = cUsSBr_myjq(ui.selected).attr('id');
                cUsSBr_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
                cUsSBr_myjq('#uTemplate_Desktop_Form').val(idEl);
            }                   
        });
        
        //SELECTED FORM TAB TEMPLATE
        cUsSBr_myjq(".selectable_tabs_ucf, .selectable_tabs_unews").selectable({
            selected: function(event, ui) {
                var idEl = cUsSBr_myjq(ui.selected).attr('id');
                cUsSBr_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");
                cUsSBr_myjq('#uTemplate_Desktop_Tab').val(idEl);
            }                   
        });

        //UI ACCORDIONS
        cUsSBr_myjq( "#terminology" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: false,
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsSBr_myjq( "#user_forms" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: true,
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsSBr_myjq( ".user_templates" ).accordion({
            collapsible: true,
            active: false,
            heightStyle: "content",
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsSBr_myjq( "#form_examples, #tab_examples" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsSBr_myjq( ".form_templates_aCc" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsSBr_myjq( ".signup_templates" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
       
    }catch(err){
        cUsSBr_myjq('.advice_notice').html('Error - please update your version of WordPress to the latest version. If the problem continues, contact us at support@contactus.com.: ' + err ).slideToggle().delay(12000).fadeOut(2000);
    }
    
    //TOOLTIPS
    try{
        //JQ UI TOOLTIPS
        cUsSBr_myjq(".setLabels").tooltip();
    }catch(err){
        cUsSBr_myjq('.advice_notice').html('Error - please update your version of WordPress to the latest version. If the problem continues, contact us at support@contactus.com. ' + err ).slideToggle().delay(12000).fadeOut(2000);
    }
    
    try{
        cUsSBr_myjq('.setDefaulFormKey').change(function(){
            var sRadio = cUsSBr_myjq(this);
            var form_key = cUsSBr_myjq(this).val();
            cUsSBr_myjq('.loadingMessage.def').show();
            cUsSBr_myjq('.defaultF li .setLabel').html('<span class="ui-button-text">Set as Default</span>');
            //AJAX POST CALL setDefaulFormKey
            cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_setDefaulFormKey',formKey:form_key},
                success: function(data) {

                    switch(data){

                        default:
                            message = '<p>Form Key saved successfully . . . .</p>';
                            sRadio.next().html('<span class="ui-button-text">Default</span>');
                            cUsSBr_myjq('.notice').html(message).show().delay(1500).fadeOut();
                            break;
                    }

                    cUsSBr_myjq('.loadingMessage.def').fadeOut();

                },
                fail: function(){ //AJAX FAIL
                   message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                   cUsSBr_myjq('.advice_notice').html(message).show().delay(2000).fadeOut(2000);
                   cUsSBr_myjq('.loadingMessage.def').fadeOut();
                },
                async: false
            });
            
        });
    }catch(err){
        console.log(err);
    }
    
    
    //LOGIN ALREADY CUS OR OLD CUS USERS
    try{
        cUsSBr_myjq('.cUsSBr_LoginUser').click(function(e){
            
            e.preventDefault();
            
            var email = cUsSBr_myjq('#login_email').val();
            var pass = cUsSBr_myjq('#user_pass').val();
            cUsSBr_myjq('.loadingMessage').show();

            //LENGTH VALIDATIONS
            if(!email.length){
                cUsSBr_myjq('.advice_notice').html('User Email is a required and valid field').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#login_email').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(!pass.length){
                cUsSBr_myjq('.advice_notice').html('User password is a required field').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#user_pass').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else{
                var bValid = checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@cUsSBr_myjq.com" );
                if(!bValid){ //EMAIL VALIDATION
                    cUsSBr_myjq('.advice_notice').html('Please enter a valid User Email').slideToggle().delay(2000).fadeOut(2000);
                    cUsSBr_myjq('.loadingMessage').fadeOut();
                }else{

                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Loading . . .').attr('disabled', true);

                    //AJAX POST CALL
                    cUsSBr_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsSBr_loginAlreadyUser',email:email,pass:pass},
                        success: function(data) {

                            switch(data.status){

                                //USER CRATED SUCCESS
                                case 1:

                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Success . . .');

                                    message = '<p>Welcome to ContactUs.com</p>';

                                    setTimeout(function(){
                                        cUsSBr_myjq('#cUsSBr_loginform').slideUp().fadeOut();
                                        location.reload();
                                    },2500);

                                    cUsSBr_myjq('.notice').html(message).show().delay(3000).fadeOut();
                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);

                                break;

                                //OLD USER DON'T HAVE DEFAULT CONTACT FORM
                                case 2:

                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Error . . .');

                                    message = '<p>To continue, you will need to create a default contact form.</p>';
                                    message += '<p> This takes just a few minutes by logging in to your ContactUs.com admin panel with the credentials you used to setup the plugin. '; 
                                    message += '<a href="https://admin.contactus.com/partners/index.php?loginName='+data.cUs_API_Account;
                                    message += '&userPsswd='+data.cUs_API_Key+'&confirmed=1&redir_url='+data.deep_link_view+'?';
                                    message += encodeURIComponent('pageID=81&id=0&do=addnew&formType=contact_us');
                                    message += ' " target="_blank">Click here to continue</a></p>';
                                    message += '<p>you will be redirected to our admin login page.</p>';

                                    cUsSBr_myjq.messageDialogLogin('Default Contact Form Required');

                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);
                                    
                                    cUsSBr_myjq('#dialog-message').html(message);


                                break;

                                //API ERROR OR CONECTION ISSUES
                                case 3:
                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);
                                    message = '<p>Unfortunately, we weren’t able to log you into your ContactUs.com account.</p>';
                                    message += '<p>Please try again with the email address and password used when you created a ContactUs.com account. If you still aren’t able to log in, please submit a ticket to our support team at <a href="http://help.contactus.com" target="_blank">http://help.contactus.com.</a></p>';
                                    message += '<p>Error:  <b>' + data.message + '</b></p>';
                                    cUsSBr_myjq('.advice_notice').html(message).show();
                                break;

                                //API ERROR OR CONECTION ISSUES
                                case '':
                                default:
                                    cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);
                                    message = '<p>Unfortunately, we weren’t able to log you into your ContactUs.com account.</p>';
                                    message += '<p>Please try again with the email address and password used when you created a ContactUs.com account. If you still aren’t able to log in, please submit a ticket to our support team at <a href="http://help.contactus.com" target="_blank">http://help.contactus.com.</a></p>';
                                    message += '<p>Error:  <b>' + data.message + '</b></p>';
                                    cUsSBr_myjq('.advice_notice').html(message).show();
                                    break;
                            }

                            cUsSBr_myjq('.loadingMessage').fadeOut();


                        },
                        fail: function(){ //AJAX FAIL
                           message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                           cUsSBr_myjq('.advice_notice').html(message).show();
                           cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);
                        },
                        async: false
                    });
                }
            }
        });
    
    }catch(err){
        message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
        cUsSBr_myjq('.advice_notice').html(message).show();
        cUsSBr_myjq('.cUsSBr_LoginUser').val('Login').attr('disabled', false);
    };
    
    //jQ UI ALERTS & MESSAGE DIALOGS
    cUsSBr_myjq.messageDialogLogin = function(title){
        try{
            cUsSBr_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
    };
    
    //JUI CUSTOM ALERTS AND MESSAGE DIALOGS
    cUsSBr_myjq.messageDialog = function(title, msg){
        try{
            cUsSBr_myjq( "#dialog-message" ).html(msg);
            cUsSBr_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
    };


    //SENT SIGNUP FORM AJAX CALL
    try{

        cUsSBr_myjq('#cUsSBr_CreateCustomer').on('click', function(e) {
            
            e.preventDefault();
            
            var postData = {};
            var oThis = cUsSBr_myjq(this);
            
            //GET ALL FORM FIELDS DATA
            var cUsSBr_option = cUsSBr_myjq('#cUsSBr_option').val();
            var cUsSBr_first_name = cUsSBr_myjq('#cUsSBr_first_name').val();
            var cUsSBr_last_name = cUsSBr_myjq('#cUsSBr_last_name').val();
            var cUsSBr_phone = cUsSBr_myjq('#cUsSBr_phone').val();
            var cUsSBr_email = cUsSBr_myjq('#cUsSBr_email').val();
            //EMAIL VALIDATION FUNCTION
            var cUsSBr_emailValid = checkRegexp( cUsSBr_email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@cUsSBr_myjq.com" );
            var cUsSBr_pass = cUsSBr_myjq('#cUsSBr_password').val();
            var cUsSBr_pass2 = cUsSBr_myjq('#cUsSBr_password_r').val();
            var cUsSBr_web = cUsSBr_myjq('#cUsSBr_web').val();
            //URL VALIDATION FUNCTION
            var cUsSBr_webValid = checkURL(cUsSBr_web);
            
           cUsSBr_myjq('.loadingMessage').show();
           
           //lenght validations
            if(!cUsSBr_email.length){
                cUsSBr_myjq('.advice_notice').html('Email is a required field').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#apikey').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(!cUsSBr_emailValid){
                cUsSBr_myjq('.advice_notice').html('Please, enter a valid Email').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#cUsSBr_email').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(!cUsSBr_pass.length){
               cUsSBr_myjq('.advice_notice').html('Password is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('#cUsSBr_password').focus();
               cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(cUsSBr_pass.length < 8){ //PASSWORD 8 CHARS VALIDATION
               cUsSBr_myjq('.advice_notice').html('Password must be 8 characters or more').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('#cUsSBr_password').focus();
               cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(cUsSBr_pass2 != cUsSBr_pass){
               cUsSBr_myjq('.advice_notice').html('Confirm Password not match').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('#cUsSBr_password_r').focus();
               cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if( !cUsSBr_first_name.length){
                cUsSBr_myjq('.advice_notice').html('Your First Name is a required field').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#cUsSBr_first_name').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if( !cUsSBr_last_name.length){
                cUsSBr_myjq('.advice_notice').html('Your Last Name is a required field').slideToggle().delay(2000).fadeOut(2000);
                cUsSBr_myjq('#cUsSBr_last_name').focus();
                cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(!cUsSBr_web.length){
               cUsSBr_myjq('.advice_notice').html('Your Website is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('#cUsSBr_web').focus();
               cUsSBr_myjq('.loadingMessage').fadeOut();
            }else if(!cUsSBr_webValid){
               cUsSBr_myjq('.advice_notice').html('Please, enter one valid website URL').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('#cUsSBr_web').focus();
               cUsSBr_myjq('.loadingMessage').fadeOut();
            }else{

                oThis.val('Loading . . .').attr('disabled', true);

                postData = {action: 'cUsSBr_verifyCustomerEmail', formOption:cUsSBr_option, fName:str_clean(cUsSBr_first_name),lName:str_clean(cUsSBr_last_name),Email:cUsSBr_email,Phone:cUsSBr_phone,credential:cUsSBr_pass,website:cUsSBr_web};

                //AJAX POST CALL
                cUsSBr_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: postData,
                    success: function(data) {
                        switch(data.status){

                            //NO USER, CONTINUE WITH NEXT STEP
                            case 1:

                                cUsSBr_myjq.colorbox({href: '#cats_selection',escKey:false,overlayClose:false,closeButton:false, inline: true, maxWidth: '100%', minHeight: '430px', scrolling: false});

                                oThis.val('Completed, continue...').attr('disabled', true);

                                break;

                            //OLD USER, LOGIN
                            case 2:
                                message = 'Seems like you already have one Contactus.com Account, Please Login below';
                                oThis.val('Create My Account').attr('disabled', false);
                                setTimeout(function(){
                                    cUsSBr_myjq('#login_email').val(cUsSBr_email).focus();
                                    cUsSBr_myjq('#cUsSBr_userdata').fadeOut();
                                    cUsSBr_myjq('#cUsSBr_settings').slideDown('slow');
                                    cUsSBr_myjq('#cUsSBr_loginform').delay(1000).fadeIn();
                                },2000);
                                cUsSBr_myjq('.advice_notice').html(message).show().delay(8000).fadeOut(2000);
                            break;

                            //API OR CONNECTION ISSUES
                            case '':
                            default:
                                message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com. <br/>Error: <b>' + data.message + '</b>.</a></p>';
                                cUsSBr_myjq('.advice_notice').html(message).show();
                                oThis.val('Create My Account').attr('disabled', false);
                            break;
                        }

                        cUsSBr_myjq('.loadingMessage').fadeOut();


                    },
                    fail: function(){ //AJAX FAIL
                       message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com.</a></p>';
                       cUsSBr_myjq('.advice_notice').html(message).show();
                       oThis.val('Create My Account').attr('disabled', false);
                    }
                });
           }
           
            
        });
    }catch(err){ //JS ISSUES
        cUsSBr_myjq('.advice_notice').html('Unfortunately there has being an error during the application. ' + err).slideToggle().delay(2000).fadeOut(2000);
        oThis.val('Create My Account').attr('disabled', false);
    }
    
    //SIGNUP TEMPLATE SELECTION
    try{

        cUsSBr_myjq('.btn-skip').click(function(e) {
           
        e.preventDefault();
        var oThis = cUsSBr_myjq(this);

        oThis.hide();
        cUsSBr_myjq('.btn-skip').hide();
        cUsSBr_myjq('.skip-button').hide();
        cUsSBr_myjq('#open-intestes').hide();
        cUsSBr_myjq('#save').hide();

           // this are optional so do not passcheck
           var CU_category 	= cUsSBr_myjq('#CU_category').val();
           var CU_subcategory 	= cUsSBr_myjq('#CU_subcategory').val();
           
            var new_goals = '';
            var CU_goals = cUsSBr_myjq('input[name="the_goals[]"]').each(function(){
                    new_goals += cUsSBr_myjq(this).val()+',';
            });

            if( cUsSBr_myjq('#other_goal').val() )
                    new_goals += cUsSBr_myjq('#other_goal').val()+',';
           
           cUsSBr_myjq(".img_loader").show();
           cUsSBr_myjq('.loadingMessage').show();
                
            cUsSBr_myjq('#cUsSBr_SendTemplates').val('Loading . . .').attr('disabled', true);
            oThis.attr('disabled', true);

            //AJAX POST CALL cUsSBr_createCustomer
            cUsSBr_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsSBr_createCustomer', CU_category:CU_category, CU_subcategory:CU_subcategory, CU_goals:new_goals },
                success: function(data) {

                    switch(data.status){

                        //USER CREATED
                        case 1:
                            message = '<p>User Profile Saved Successfully . . . .</p>';
                            message += '<p>Welcome to ContactUs.com, and thank you for your registration.</p>';
                            cUsSBr_myjq('.notice').html(message).show().delay(4900).fadeOut(800);
                            //cUsSBr_myjq("#cUsFC_SendTemplates").colorbox.close();
                            setTimeout(function(){
                                cUsSBr_myjq('.step3').slideUp().fadeOut();
                                cUsSBr_myjq('.step4').slideDown().delay(800);
                                cUsSBr_myjq('#cUsSBr_SendTemplates').val('Create My Account').attr('disabled', false);
                                location.reload();
                            },2000);
                            break;
                         //OLD USER - LOGING
                         case 2:
                            message = 'Seems like you already have one Contactus.com Account, Please Login below';
                            cUsSBr_myjq('.advice_notice').html(message).show();
                            cUsSBr_myjq('#cUsSBr_SendTemplates').val('Create My Account').attr('disabled', false);
                            cUsSBr_myjq("#cUsSBr_SendTemplates").colorbox.close();
                            cUsSBr_myjq(".img_loader").hide();
                            setTimeout(function(){
                                cUsSBr_myjq('#login_email').val(cUsSBr_email).focus();
                                cUsSBr_myjq('#cUsSBr_userdata').fadeOut();
                                cUsSBr_myjq('#cUsSBr_settings').slideDown('slow');
                                cUsSBr_myjq('#cUsSBr_loginform').delay(1000).fadeIn();
                            },2000);
                            break;
                        //API OR CONNECTION ISSUES
                        case '':
                        default:
                            message = '<p>Unfortunately there has being an error during the application. If the problem continues, contact us at support@contactus.com. <br/>Error: <b>' + data.message + '</b>.</a></p>';
                            cUsSBr_myjq('.advice_notice').html(message).show();
                            cUsSBr_myjq('#cUsSBr_CreateCustomer').val('Create My Account').attr('disabled', false);
                            cUsSBr_myjq("#cUsSBr_CreateCustomer").colorbox.close();
                            break;
                    }

                    cUsSBr_myjq('.loadingMessage').fadeOut();

                },
                async: false
            });
           
            
        });
    }catch(err){
        cUsSBr_myjq('.advice_notice').html('Unfortunately there has being an error during the application. ' + err).slideToggle().delay(9000).fadeOut(2000);
        cUsSBr_myjq('#cUsSBr_CreateCustomer').val('Create My Account').attr('disabled', false);
    }
    
    //UPDATE TEMPLATES FOR ALREADY USERS
    try{ cUsSBr_myjq('#cUsSBr_UpdateTemplates').click(function() {
           
           //GET SELECTED TEMPLATES
           var Template_Desktop_Form = cUsSBr_myjq('#uTemplate_Desktop_Form').val();
           var Template_Desktop_Tab = cUsSBr_myjq('#uTemplate_Desktop_Tab').val();
           cUsSBr_myjq('.loadingMessage').show();
           
           //VALIDATION
           if(!Template_Desktop_Form.length){
               cUsSBr_myjq('.advice_notice').html('Please select a form template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('.loadingMessage').fadeOut();
               cUsSBr_myjq( "#form_examples" ).accordion({ active: 0 });
           }else if(!Template_Desktop_Tab.length){
               cUsSBr_myjq('.advice_notice').html('Please select a tab template before continuing.').slideToggle().delay(2000).fadeOut(2000);
               cUsSBr_myjq('.loadingMessage').fadeOut();
               cUsSBr_myjq( "#form_examples" ).accordion({ active: 1 });
           }else{
                
                cUsSBr_myjq('#cUsSBr_UpdateTemplates').val('Loading . . .').attr('disabled', true);
                
                //AJAX POST CALL cUsSBr_UpdateTemplates
                cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_UpdateTemplates',Template_Desktop_Form:Template_Desktop_Form,Template_Desktop_Tab:Template_Desktop_Tab},
                    success: function(data) {

                        switch(data){
                            //SAVED
                            case '1':
                                message = '<p>Template saved successfully . . . .</p>';
                                cUsSBr_myjq('.notice').html(message).show();
                                setTimeout(function(){
                                    cUsSBr_myjq('.step3').slideUp().fadeOut();
                                    cUsSBr_myjq('.step4').slideDown().delay(800);
                                    location.reload();
                                },2000);
                                break;
                            //API OR CONNECTION ISSUES
                            default:
                                message = '<p>Unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again</a></p>';
                                cUsSBr_myjq('.advice_notice').html(message).show();
                                cUsSBr_myjq('#cUsSBr_UpdateTemplates').val('Update my template').attr('disabled', false);
                                break;
                        }
                        
                        cUsSBr_myjq('.loadingMessage').fadeOut();

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsSBr_myjq('.advice_notice').html('Unfortunately there has being an error during the application.  '+ err).slideToggle().delay(2000).fadeOut(2000);
        cUsSBr_myjq('#cUsSBr_UpdateTemplates').val('Update my template').attr('disabled', false);
    }
    
    //loading default template
    try{ cUsSBr_myjq('.load_def_formkey').click(function() {
            
        cUsSBr_myjq('.loadingMessage').show();
          
        cUsSBr_myjq('.load_def_formkey').html('Loading . . .');

        cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_LoadDefaultKey'},
            success: function(data) {

                switch(data){
                    case '1':
                        message = '<p>New form Loaded correctly. . . .</p>';
                        cUsSBr_myjq('.load_def_formkey').html('Completed . . .');
                        setTimeout(function(){
                            location.reload();
                        },2000);
                        break;
                }

                cUsSBr_myjq('.loadingMessage').fadeOut();
                cUsSBr_myjq('.advice_notice').html(message).show();
                 

            },
            async: false
        });
           
            
        });
    }catch(err){
        cUsSBr_myjq('.advice_notice').html('Unfortunately there has being an error during the application.  '+ err).slideToggle().delay(2000).fadeOut(2000);
        cUsSBr_myjq('.load_def_formkey').html('Update my template');
    }
    
    //JQ FUNCTION - CHANGE PAGE SETTINGS IN PAGE SELECTION
    cUsSBr_myjq.changePageSettings = function(pageID, cus_version, form_key) {
        
        if(!cus_version.length){
            cUsSBr_myjq('.advice_notice').html('Please select TAB or INLINE').slideToggle().delay(2000).fadeOut(2000);
        }else if(!form_key.length){
            cUsSBr_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsSBr_myjq('.save_message_'+pageID).show();
            
            //AJAX POST CALL cUsSBr_changePageSettings
            cUsSBr_myjq.ajax({type: "POST", url: ajax_object.ajax_url, dataType:'json', data: {action:'cUsSBr_changePageSettings',pageID:pageID,cus_version:cus_version, form_key:form_key },
                success: function(data) {

                    switch(data.status){
                        case 1 :
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsSBr_myjq('.save_message_'+pageID).html(message);
                            cUsSBr_myjq('.save-page-'+pageID).val('Completed . . .');

                            setTimeout(function(){
                                cUsSBr_myjq('.save_message_'+pageID).fadeOut();
                                cUsSBr_myjq('.save-page-'+pageID).val('Save');
                                cUsSBr_myjq('.form-templates-'+pageID).slideUp();
                            },2000);

                            break;
                    }

                },
                async: false
            });
        }  
            
    };
    
    //JQ FUNCTION - REMOVE PAGE SETTINGS IN PAGE SELECTION
    cUsSBr_myjq.deletePageSettings = function(pageID) {

        cUsSBr_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_deletePageSettings',pageID:pageID},
            success: function(data) {
                //console.log('Success . . .');
            },
            async: false
        });
            
    };
    
    
    //CHANGE FORM TEMPLATES
    cUsSBr_myjq.changeFormTemplate = function(formID, form_key, Template_Desktop_Form) {
        
        if(!Template_Desktop_Form.length || !form_key.length){
            cUsSBr_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsSBr_myjq('.save_message_'+formID).show();
            
            cUsSBr_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_changeFormTemplate',Template_Desktop_Form:Template_Desktop_Form, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsSBr_myjq('.save_message_'+formID).html(message);
                            cUsSBr_myjq('.form_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Form+'/scr.png');

                            setTimeout(function(){
                                cUsSBr_myjq('.save_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    };
    
    //CHANGE FORM TEMPLATES
    cUsSBr_myjq.changeTabTemplate = function(formID, form_key, Template_Desktop_Tab) { //loading default template
        
        
        if(!Template_Desktop_Tab.length || !form_key.length){
            cUsSBr_myjq('.advice_notice').html('Please select your Contact Us Tab Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsSBr_myjq('.save_tab_message_'+formID).show();
            
            cUsSBr_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_changeTabTemplate',Template_Desktop_Tab:Template_Desktop_Tab, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsSBr_myjq('.save_tab_message_'+formID).html(message);
                            cUsSBr_myjq('.tab_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Tab+'/scr.png');

                            setTimeout(function(){
                                cUsSBr_myjq('.save_tab_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    };
    
    //UNLINK ACCOUNT AND DELETE PLUGIN OPTIONS AND SETTINGS
    cUsSBr_myjq('.cUsSBr_LogoutUser').click(function(){
        
        cUsSBr_myjq( "#dialog-message" ).html('Please confirm you would like to unlink your account.');
        cUsSBr_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Close your account session?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    cUsSBr_myjq('.loadingMessage').show();
                    cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_logoutUser'},
                        success: function(data) {
                            cUsSBr_myjq('.loadingMessage').fadeOut();
                              location.reload();
                        },
                        async: false
                    });
                    
                    cUsSBr_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsSBr_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
    
    //FORM PLACEMENT SELECITION / DEFAULT FORM OR CUSTOM SETTINGS
    cUsSBr_myjq('.form_version').click(function(){
        
        var value = cUsSBr_myjq(this).val();
         
        var msg = '';
        switch(value){
            case 'select_version':
                msg = '<p>You are about to change to Custom Form Settings. You need to choose what forms go on each page or home page</p>';
                break;
            case 'tab_version':
                msg = '<p>You are about to change to Default Form Settings, only your Default form will show up in all of your site</p>';
                break;
        }
        
        cUsSBr_myjq( "#dialog-message" ).html(msg);
        cUsSBr_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Change your Form Settings?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    switch(value){
                        case 'select_version':
                            cUsSBr_myjq('.tab_button').addClass('gray').removeClass('green').attr('disabled', false);
                            cUsSBr_myjq('.custom').addClass('green').removeClass('disabled').attr('disabled', true);
                            cUsSBr_myjq('.ui-buttonset input').removeAttr('checked');
                            cUsSBr_myjq('.ui-buttonset label').removeClass('ui-state-active');

                            cUsSBr_myjq('.loadingMessage').show();
                            cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_saveCustomSettings',cus_version:'selectable',tab_user:0},
                                success: function(data) {
                                    cUsSBr_myjq('.loadingMessage').fadeOut();
                                    cUsSBr_myjq('.notice_success').html('<p>Custom settings saved . . .</p>').fadeIn().delay(2000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                        case 'tab_version':
                            cUsSBr_myjq('.custom').addClass('gray').removeClass('green').attr('disabled', false);
                            cUsSBr_myjq('.tab_button').removeClass('gray').addClass('green').attr('disabled', true);

                            cUsSBr_myjq('.loadingMessage').show();
                            cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsSBr_saveCustomSettings',cus_version:'tab',tab_user:1},
                                success: function(data) {
                                    cUsSBr_myjq('.loadingMessage').fadeOut();
                                    cUsSBr_myjq('.notice_success').html('<p>Tab settings saved . . .</p><p>Your default Form will appear in all your website.</p>').fadeIn().delay(5000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                    }

                    cUsSBr_myjq('.cus_versionform').fadeOut();
                    cUsSBr_myjq('.' + value).fadeToggle();
                    
                    cUsSBr_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsSBr_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
    
    cUsSBr_myjq('.btab_enabled').click(function(){
        var value = cUsSBr_myjq(this).val();
        cUsSBr_myjq('.tab_user').val(value);
        cUsSBr_myjq('.loadingMessage').show();
       
        setTimeout(function(){
            cUsSBr_myjq('#cUsSBr_button').submit();
        },1500);
        
    });
    
    cUsSBr_myjq('#contactus_settings_page').change(function(){
        cUsSBr_myjq('.show_preview').fadeOut();
        cUsSBr_myjq('.save_page').fadeOut( "highlight" ).fadeIn().val('>> Save your settings');
    });
    
    cUsSBr_myjq('.callout-button').click(function() {
        cUsSBr_myjq('.getting_wpr').slideToggle('slow');
    });
    
    cUsSBr_myjq('#cUsSBr_yes').click(function() {
        cUsSBr_myjq('#cUsSBr_userdata, #cUsSBr_templates').fadeOut();
        cUsSBr_myjq('#cUsSBr_settings').slideDown('slow');
        cUsSBr_myjq('#cUsSBr_loginform').delay(600).fadeIn();
    });
    cUsSBr_myjq('#cUsSBr_no, #cUsSBr_signup_cloud').click(function() {
        cUsSBr_myjq('#cUsSBr_loginform, #cUsSBr_templates').fadeOut();
        cUsSBr_myjq('#cUsSBr_settings').slideDown('slow');
        cUsSBr_myjq('#cUsSBr_userdata').delay(600).fadeIn();
    });
    
    //DOM ISSUES ON LOAD
    $('.form_template, .step2, #cUsSBr_settings').css("display","none");
    
    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o ) ) ) {
            return false;
        } else {
            return true;
        }
    }
    
    function checkURL(url) {
        return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }
    
    function str_clean(str){
           
        str = str.replace("'" , " ");
        str = str.replace("," , "");
        str = str.replace("\"" , "");
        str = str.replace("/" , "");

        return str;
    }
    
});//ON LOAD