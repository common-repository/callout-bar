<?php
/**
 *
 * CALLOUT BAR BY CONTACTUS.COM
 *
 * Initialization Custom Form Placement View
 * @since 1.0 First time this was introduced into plugin.
 * @author ContactUs.com <support@contactus.com>
 * @copyright 2014 ContactUs.com Inc.
 * Company      : contactus.com
 * Updated  	: 20140127
 * */
?>

<?php

function my_editor_buttons( $buttons, $editor_id ) {
    return array( 'formatselect', 'bold', 'italic' );
}

if (!function_exists('cUsSBr_renderFormType')) {
    /*
     * Method in charge to render form types
     * @param string $form_type Form type to validate
     * @since 1.0
     * @return string Return Html into wp admin header
     */

    function cUsSBr_renderFormType($form_Type, $cUsSBr_API_getFormKeys, $createform) {

        $cUsSBr_api = new cUsComAPI_SBr(); //CONTACTUS.COM API
        $aryUserCredentials = get_option('cUsSBr_settings_userCredentials'); //get the values, wont work the first time
        $cUs_API_Account = $aryUserCredentials['API_Account'];
        $cUs_API_Key = $aryUserCredentials['API_Key'];

        if ($cUsSBr_API_getFormKeys) {

            //$form_Type = 'contact_us';

            $cUs_json = json_decode($cUsSBr_API_getFormKeys);
            switch ($cUs_json->status) {
                case 'success':
                    ?>
                    <div class="user_form_templates">
                    <?php
                    $nCF = 1;
                    foreach ($cUs_json->data as $oForms => $oForm) {

                        if (cUsSBr_allowedFormType($oForm->form_type) && $oForm->form_type == $form_Type) {
                            $formID = $oForms;
                            ?>

                            <div class="form_templates_box">
                                <h3><?php echo $oForm->form_name ?></h3>

                                <div class="form_zoom setLabels" data-id="<?php echo $oForm->form_id; ?>" data-key="<?php echo $oForm->form_key; ?>" title="Configure Callout Bar Actions, Position, Text, Fonts and Colors">Callout Bar Settings</div>
                                <div class="form_bar_set unselectable setLabels" data-id="<?php echo $oForm->form_id; ?>" title="Manage Form Settings">Form Settings</div>

                                <div class="template-thumb">
                                    <span class="thumb"><img src="<?php echo $oForm->template_desktop_form_thumbnail ?>" class="form_thumb_<?php echo $formID; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" width="130" /></span>
                                    <!-- span class="tab_thumb"><img src="<?php echo $oForm->template_desktop_tab_thumbnail ?>" class="tab_thumb_<?php echo $formID; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" /></span -->
                                </div>

                                <div class="form_key"><b>FORM KEY:</b> <?php echo $oForm->form_key ?></div>

                            </div>

                            <div class="bar_settings hidden" id="bar_settings_<?php echo $oForm->form_id; ?>">

                            <div class="bar_settings_tabs">

                            <div class="bar_settings_steps">
                                <div class="step st0"><span><p>Best way to setup your Callout Bar</p></span></div>
                                <div class="step st1"><span class="no">1</span><span class="txt">Edit Bar Settings, then save</span></div>
                                <div class="step st2"><span class="no">2</span><span class="txt">Edit Mobile Settings, then save Mobile Settings</span></div>
                                <div class="step st3"><span class="no">3</span><span class="txt">Edit Callout Bar Actions, then save</span></div>
                            </div>

                            <ul>
                                <li><a href="#bAcc1">Bar Settings</a></li>
                                <li><a href="#bAcc2">Mobile Bar Settings</a></li>
                                <li><a href="#bAcc3">Callout Bar Actions</a></li>
                            </ul>

                            <div id="bAcc1">

                            <?php
                            $aryBarSet = get_option('cUsSBr_settings_BAR_'.$oForm->form_key );
                            ?>
                            <div class="note">
                                <h4>When customizing your Bar Settings and Callout Bar Actions, please save each tab. There is an orange save button at the bottom of each tab.</h4>
                            </div>

                            <div class="loadingMessage def"></div><div class="advice_notice">Advice ....</div><div class="notice">Messages....</div>
                            <form id="bar_settings_frm_<?php echo $oForm->form_id; ?>" onsubmit="return false;">
                            <input type="hidden" name="bar_formkey" value="<?php echo $oForm->form_key ?>">
                            <input type="hidden" name="action" value="cUsSBr_saveBarSettings">
                            <input type="hidden" name="form_id" value="<?php echo $oForm->form_id; ?>">
                            <h3>Font Settings</h3>
                            <table class="form-table table_<?php echo $oForm->form_id; ?>" width="45%">
                                <tr>
                                    <td colspan="2">
                                        <div class="options wysiwyg">
                                            <select name="font" id="font_fam_<?php echo $oForm->form_id; ?>">
                                                <option value="oSans">Open Sans</option>
                                                <option value="oSwald">Oswald</option>
                                                <option value="DroidSerif">Droid Serif</option>
                                                <option value="Playfair">Playfair Display</option>
                                                <option value="Arial">Arial</option>
                                                <option value="Helvetica">Helvetica</option>
                                                <option value="Verdana">Verdana</option>
                                                <option value="Times">Times New Roman</option>
                                                <option value="Tahoma">Tahoma</option>
                                            </select>
                                            <select name="font_size" id="font_size_<?php echo $oForm->form_id; ?>">
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="18">18</option>
                                                <option value="21">21</option>
                                                <option value="23">23</option>
                                                <option value="25">25</option>
                                                <option value="28">28</option>
                                                <option value="32">32</option>
                                            </select>
                                            <label for="font_bold_<?php echo $oForm->form_id; ?>"><b>B</b></label>
                                            <input type="checkbox" id="font_bold_<?php echo $oForm->form_id; ?>" name="font_bold" <?php echo($aryBarSet['font_bold'] == 'on') ? 'checked' : ''; ?> >

                                            <label for="font_ita_<?php echo $oForm->form_id; ?>"><i>i</i></label>
                                            <input type="checkbox" id="font_ita_<?php echo $oForm->form_id; ?>" name="font_ita" <?php echo($aryBarSet['font_ita'] == 'on') ? 'checked' : ''; ?> >

                                            <input type="button" name="font_color_buton" value="Color" id="font_color_<?php echo $oForm->form_id; ?>">
                                            <input type="hidden" name="font_color" id="h_font_color_<?php echo $oForm->form_id; ?>" value="<?php echo $aryBarSet['font_color']; ?>">

                                            <div class="cPikr_wpr">
                                                <div class="colorpicker" id="font_colorpicker_<?php echo $oForm->form_id; ?>"></div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">

                                        <?php
                                        $barTxt = ( strlen($aryBarSet['bar_txt']) && !empty($aryBarSet['bar_txt']) )?$aryBarSet['bar_txt'] :cUsSBr_DFT_TXT ;
                                        ?>
                                        <label>Bar Content</label>
                                        <textarea name="bar_txt" id="bar_txt_<?php echo $oForm->form_id; ?>"><?php echo stripslashes($barTxt);?></textarea>
                                        <p style="font-size: 10px;text-align: right;">HTML friendly</p>
                                    </td>
                                </tr>
                                <?php
                                /*
                                
                                <tr>
                                    <th width="25%" ><label class="labelform" for="cUsSBr_option">Text Position <br/>(Vertical Alignment)</label></th>
                                    <td>
                                        <div class="slideFP" id="fontpos_<?php echo $oForm->form_id; ?>"></div>
                                        <input type="text" name="tXt_pos" id="tXt_pos_<?php echo $oForm->form_id; ?>" maxlength="3" size="3" value="<?php echo (!empty($aryBarSet['tXt_pos']))? $aryBarSet['tXt_pos']:'25';?>" readonly > %
                                    </td>
                                </tr>
                                 
                                */

                                ?>
                                    <script>

                                        jQuery(document).ready(function($) {

                                            try{

                                                //FONT FAMILY
                                                var font_fam_<?php echo $oForm->form_id; ?> = $('#font_fam_<?php echo $oForm->form_id; ?>');
                                                font_fam_<?php echo $oForm->form_id; ?>.change(function(){
                                                    var fFam = $(this).val();
                                                    $('.cUs_oSbr').removeClass("oSans oSwald DroidSerif Playfair Arial Helvetica Verdana Tahoma Times");
                                                    $('.cUs_oSbr').addClass(fFam);
                                                })
                                                font_fam_<?php echo $oForm->form_id; ?>.val('<?php echo (!empty( $aryBarSet['font'] ))? $aryBarSet['font']:'oSans';?>');

                                                //FONT SIZE
                                                var font_size_<?php echo $oForm->form_id; ?> = $('#font_size_<?php echo $oForm->form_id; ?>');
                                                font_size_<?php echo $oForm->form_id; ?>.change(function(){
                                                    var fSz = $(this).val();
                                                    $('.cUs_oSbr ._xt p').css({'font-size':fSz + 'px'});
                                                });
                                                font_size_<?php echo $oForm->form_id; ?>.val(<?php echo (!empty($aryBarSet['font_size']))?$aryBarSet['font_size']:'11';?>);

                                                //FONT COLOR
                                                var font_color_<?php echo $oForm->form_id; ?> = $('#font_color_<?php echo $oForm->form_id; ?>');
                                                $('#font_colorpicker_<?php echo $oForm->form_id; ?>').farbtastic(function(color){
                                                    $('.cUs_oSbr ._xt p').css({'color':color});
                                                    $('#h_font_color_<?php echo $oForm->form_id; ?>').val(color);
                                                });
                                                font_color_<?php echo $oForm->form_id; ?>.click(function() {
                                                    $('#font_colorpicker_<?php echo $oForm->form_id; ?>').fadeIn();
                                                }).mouseleave(function(){
                                                    $(this).val('Color');
                                                });

                                                //BOLD FONT
                                                var font_bold_<?php echo $oForm->form_id; ?> = $('#font_bold_<?php echo $oForm->form_id; ?>');
                                                font_bold_<?php echo $oForm->form_id; ?>.click(function(){
                                                    var tXt = bar_txt_<?php echo $oForm->form_id; ?>.val();
                                                    if($(this).is(':checked')){
                                                        tXt = "<b>" + tXt + "</b>";
                                                    }else{
                                                        tXt = tXt.replace("<b>","").replace("</b>","");
                                                    }
                                                    $('.cUs_oSbr ._xt p').html(tXt);
                                                    bar_txt_<?php echo $oForm->form_id; ?>.val(tXt);
                                                });

                                                //ITALIC FONT
                                                var font_ita_<?php echo $oForm->form_id; ?> = $('#font_ita_<?php echo $oForm->form_id; ?>');
                                                font_ita_<?php echo $oForm->form_id; ?>.click(function(){
                                                    var tXt = bar_txt_<?php echo $oForm->form_id; ?>.val();
                                                    if($(this).is(':checked')){
                                                        tXt = "<i>" + tXt + "</i>";
                                                    }else{
                                                        tXt = tXt.replace("<i>","").replace("</i>","");
                                                    }
                                                    $('.cUs_oSbr ._xt p').html(tXt);
                                                    bar_txt_<?php echo $oForm->form_id; ?>.val(tXt);
                                                });

                                                //BAR TEXT
                                                var bar_txt_<?php echo $oForm->form_id; ?> = $('#bar_txt_<?php echo $oForm->form_id; ?>');
                                                bar_txt_<?php echo $oForm->form_id; ?>.on("change keyup paste", function() {
                                                    var tXt = $(this).val();
                                                    $('.cUs_oSbr ._xt p').html(tXt);
                                                });


                                                //TEXT POSITION VERICAL
                                                $( "#fontpos_<?php echo $oForm->form_id; ?>" ).slider({
                                                    range: "min",
                                                    value: <?php echo (!empty($aryBarSet['tXt_pos']))?$aryBarSet['tXt_pos']:'5';?>,
                                                    min: 5,
                                                    max: 60,
                                                    slide: function( event, ui ) {
                                                        $( "#tXt_pos_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                                        $('.cUs_oSbr ._xt').css({ top:ui.value + '%' });
                                                    }
                                                });


                                            }catch(err){
                                                console.log(err);
                                            }

                                        });

                                    </script>
                            </table>

                            <h3>Bar Design</h3>
                            <div class="col">

                                <table class="form-table table_<?php echo $oForm->form_id; ?>">
                                    <tr>
                                        <th width="25%" ><label class="labelform" for="cUsSBr_option">Background Color</label></th>
                                        <td>
                                            <div class="cPikr_wpr">
                                                <div class="colorpicker bg" id="colorpicker_<?php echo $oForm->form_id; ?>"></div>
                                                <input type="text" name="bar_color" id="color_<?php echo $oForm->form_id; ?>" value="<?php echo (!empty($aryBarSet['bar_color']))?$aryBarSet['bar_color']:cUsSBr_DFT_BKG;?>" style="background: <?php echo (!empty($aryBarSet['bar_color']))?$aryBarSet['bar_color']:cUsSBr_DFT_BKG;?>;" maxlength="7">
                                            </div>
                                        </td>
                                    </tr>
    <?php /* 
    
                                    <tr>
                                        <th width="25%" ><label class="labelform" for="cUsSBr_option">Bar Height</label></th>
                                        <td>
                                            <div class="slideH" id="barheight_<?php echo $oForm->form_id; ?>"></div>
                                            <input type="text" name="bar_height" id="bar_height_<?php echo $oForm->form_id; ?>" maxlength="3" size="3" value="<?php echo (!empty($aryBarSet['bar_height']))? $aryBarSet['bar_height']:'20';?>" readonly > pixels
                                            <!-- input type="hidden" name="tXt_pos" id="tXt_pos_<?php //echo $oForm->form_id; ?>" value="<?php //echo $aryBarSet['tXt_pos'];?>" -->
                                        </td>
                                    </tr>
    
    */ ?>
                                    <tr>
                                        <th><label class="labelform" for="cUsSBr_option">Bar Shadow</label></th>
                                        <td>
                                            <div class="options">
                                                <label for="bar-shadow-y-<?php echo $oForm->form_id; ?>">Yes</label> <input type="radio" id="bar-shadow-y-<?php echo $oForm->form_id; ?>" name="bar-shadow-<?php echo $oForm->form_id; ?>" value="1" <?php echo($aryBarSet['bar-shadow-'.$oForm->form_id] == 1) ? 'checked' : ''; ?> >
                                                <label for="bar-shadow-n-<?php echo $oForm->form_id; ?>">No</label> <input type="radio" id="bar-shadow-n-<?php echo $oForm->form_id; ?>" name="bar-shadow-<?php echo $oForm->form_id; ?>" value="0" <?php echo($aryBarSet['bar-shadow-'.$oForm->form_id] == 0) ? 'checked' : ''; ?>  <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?>>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- tr>
                                                        <th width="25%" ><label class="labelform" for="cUsSBr_option">Top Position</label></th>
                                                        <td>
                                                            <div class="slideH" id="barmargin_<?php echo $oForm->form_id; ?>"></div>
                                                            <input type="text" name="bar_margin" id="bar_margin_<?php echo $oForm->form_id; ?>" maxlength="3" size="3" value="<?php echo (!empty($aryBarSet['bar_margin']))? $aryBarSet['bar_margin']:'0';?>" readonly > pixels
                                                        </td>
                                                    </tr -->
                                </table>

                            </div>
                            <div class="col right">
                                <table class="form-table table_<?php echo $oForm->form_id; ?>">
                                    <tr>
                                        <th><label class="labelform" for="cUsSBr_option">Bar Position</label></th>
                                        <td>
                                            <div class="options">
                                                <label for="top-position_<?php echo $oForm->form_id; ?>">Top</label> <input type="radio" id="top-position_<?php echo $oForm->form_id; ?>" name="position_<?php echo $oForm->form_id; ?>" value="_t0p" <?php echo($aryBarSet['position_'.$oForm->form_id] == '_t0p') ? 'checked' : ''; ?>  <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?> >
                                                <label for="bottom-position_<?php echo $oForm->form_id; ?>">Bottom</label><input type="radio" id="bottom-position_<?php echo $oForm->form_id; ?>" name="position_<?php echo $oForm->form_id; ?>" <?php echo($aryBarSet['position_'.$oForm->form_id] == '_b0t') ? 'checked' : ''; ?> value="_b0t" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="circle yellow">!</span>
                                            <strong>If you have a fixed menu on the top of your site: </strong> Switch this option to bottom so that the callout bar and the fixed menu don’t compete for the same fixed position.
                                        </td>
                                    </tr>

                                    <tr>
                                        <th><label class="labelform" for="cUsSBr_option">Bar Visibility</label></th>
                                        <td>
                                            <div class="options">
                                                <label for="bar-show-y-<?php echo $oForm->form_id; ?>">Show</label> <input type="radio" id="bar-show-y-<?php echo $oForm->form_id; ?>" name="bar-show-<?php echo $oForm->form_id; ?>" value="1" <?php echo($aryBarSet['bar-show-'.$oForm->form_id] == 1) ? 'checked' : ''; ?> <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?> >
                                                <label for="bar-show-n-<?php echo $oForm->form_id; ?>">Hidden</label> <input type="radio" id="bar-show-n-<?php echo $oForm->form_id; ?>" name="bar-show-<?php echo $oForm->form_id; ?>" value="0" <?php echo( is_array($aryBarSet) && $aryBarSet['bar-show-'.$oForm->form_id] == 0) ? 'checked' : ''; ?> >
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <button class="m1 btn orange large save_tab" data-formid="<?php echo $oForm->form_id; ?>" type="button">Save Bar Settings</button>

                            <script>

                                jQuery(document).ready(function($) {

                                    try{

                                        //BAR COLOR
                                        var eL_<?php echo $oForm->form_id; ?> = $('#color_<?php echo $oForm->form_id; ?>');
                                        $('#colorpicker_<?php echo $oForm->form_id; ?>').farbtastic('#color_<?php echo $oForm->form_id; ?>, .cUs_oSbr');

                                        eL_<?php echo $oForm->form_id; ?>.focusin(function() {
                                            //$(this).val('#002968');
                                            $('#colorpicker_<?php echo $oForm->form_id; ?>').fadeIn();
                                        }).focusout(function(){
                                            $('#colorpicker_<?php echo $oForm->form_id; ?>').fadeOut();
                                        }).keypress(function(){
                                            $('.cUs_oSbr').css({background:$(this).val()});
                                        });

                                        $( "#barheight_<?php echo $oForm->form_id; ?>" ).slider({
                                            range: "min",
                                            value: <?php echo (!empty($aryBarSet['bar_height']))?$aryBarSet['bar_height']:'20';?>,
                                            min: 18,
                                            max: 300,
                                            slide: function( event, ui ) {
                                                $( "#bar_height_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                                $('.cUs_oSbr').css({height:ui.value});
                                                if( ui.value <= 50 ){
                                                    $('.cUs_oSbr > ._xt').css({top:"25%"});
                                                    $('#tXt_pos_<?php echo $oForm->form_id; ?>').val(25);
                                                }else if(ui.value > 50 && ui.value < 80){
                                                    $('.cUs_oSbr > ._xt').css({top:"35%"});
                                                    $('#tXt_pos_<?php echo $oForm->form_id; ?>').val(35);
                                                }else if(ui.value > 80){
                                                    $('.cUs_oSbr > ._xt').css({top:"40%"});
                                                    $('#tXt_pos_<?php echo $oForm->form_id; ?>').val(40);
                                                }
                                            }
                                        });

                                        $( "#barmargin_<?php echo $oForm->form_id; ?>" ).slider({
                                            range: "min",
                                            value: <?php echo (!empty($aryBarSet['bar_margin']))?$aryBarSet['bar_margin']:'0';?>,
                                            min: 0,
                                            max: 99,
                                            slide: function( event, ui ) {
                                                $('.cUs_oSbr').css({top:ui.value+"px"});
                                                $( "#bar_margin_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                            }
                                        });

                                        //BAR POSITION
                                        $('input[type=radio][name=position_<?php echo $oForm->form_id; ?>]').change(function() {
                                            if (this.value == '_t0p') {
                                                $('.cUs_oSbr').removeClass('_b0t').addClass(this.value);
                                            }else if (this.value == '_b0t') {
                                                $('.cUs_oSbr').removeClass('_t0p').addClass(this.value);
                                            }
                                        });

                                        //BAR SHADOW
                                        $('input[type=radio][name=bar-shadow-<?php echo $oForm->form_id; ?>]').change(function() {
                                            if (this.value == 1) {
                                                $('.cUs_oSbr').addClass('_shadow');
                                            }else{
                                                $('.cUs_oSbr').removeClass('_shadow');
                                            }
                                        });


                                    }catch(err){
                                        console.log(err);
                                    }

                                });

                            </script>

                            </form>
                            </div>

                            <div id="bAcc2">

                                <?php
                                $aryBarSet = get_option('cUsSBr_settings_MOBILE_BAR_'.$oForm->form_key );
                                ?>
                                <div class="note">
                                    <h4>When customizing your Bar Settings and Callout Bar Actions, please save each tab. There is an orange save button at the bottom of each tab.</h4>
                                </div>

                                <div class="loadingMessage def"></div><div class="advice_notice">Advice ....</div><div class="notice">Messages....</div>
                                <form id="bar_settings_mob_frm_<?php echo $oForm->form_id; ?>" onsubmit="return false;">
                                    <input type="hidden" name="bar_formkey" value="<?php echo $oForm->form_key ?>">
                                    <input type="hidden" name="action" value="cUsSBr_saveBarMobileSettings">
                                    <input type="hidden" name="form_id" value="<?php echo $oForm->form_id; ?>">
                                    <!-- h2>Bar Name: <?php echo $oForm->form_name ?></h2 -->
                                    <h3>Font & Text Settings</h3>
                                    <table class="form-table table_<?php echo $oForm->form_id; ?>" width="45%">
                                        <tr>
                                            <td colspan="2">
                                                <div class="options wysiwyg">
                                                    <select name="font" id="mob_font_fam_<?php echo $oForm->form_id; ?>">
                                                        <option value="oSans">Open Sans</option>
                                                        <option value="oSwald">Oswald</option>
                                                        <option value="DroidSerif">Droid Serif</option>
                                                        <option value="Playfair">Playfair Display</option>
                                                        <option value="Arial">Arial</option>
                                                        <option value="Helvetica">Helvetica</option>
                                                        <option value="Verdana">Verdana</option>
                                                        <option value="Times">Times New Roman</option>
                                                        <option value="Tahoma">Tahoma</option>
                                                    </select>
                                                    <select name="font_size" id="mob_font_size_<?php echo $oForm->form_id; ?>">
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="18">18</option>
                                                        <option value="21">21</option>
                                                        <option value="23">23</option>
                                                        <option value="25">25</option>
                                                        <option value="28">28</option>
                                                        <option value="32">32</option>
                                                    </select>
                                                    <label for="mob_font_bold_<?php echo $oForm->form_id; ?>"><b>B</b></label>
                                                    <input type="checkbox" id="mob_font_bold_<?php echo $oForm->form_id; ?>" name="font_bold" <?php echo($aryBarSet['font_bold'] == 'on') ? 'checked' : ''; ?> >

                                                    <label for="mob_font_ita_<?php echo $oForm->form_id; ?>"><i>i</i></label>
                                                    <input type="checkbox" id="mob_font_ita_<?php echo $oForm->form_id; ?>" name="font_ita" <?php echo($aryBarSet['font_ita'] == 'on') ? 'checked' : ''; ?> >

                                                    <input type="button" name="font_color_buton" value="Color" id="mob_font_color_<?php echo $oForm->form_id; ?>">
                                                    <input type="hidden" name="font_color" id="mob_h_font_color_<?php echo $oForm->form_id; ?>" value="<?php echo $aryBarSet['font_color']; ?>">

                                                    <div class="cPikr_wpr">
                                                        <div class="colorpicker" id="mob_font_colorpicker_<?php echo $oForm->form_id; ?>"></div>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">

                                                <?php
                                                $barTxt = ( strlen($aryBarSet['bar_txt']) && !empty($aryBarSet['bar_txt']) )?$aryBarSet['bar_txt'] :cUsSBr_DFT_TXT ;
                                                ?>
                                                <label>Bar Content</label>
                                                <textarea name="bar_txt" id="mob_bar_txt_<?php echo $oForm->form_id; ?>"><?php echo stripslashes($barTxt);?></textarea>
                                                <p style="font-size: 10px;text-align: right;">HTML friendly</p>
                                            </td>
                                        </tr>
                                        
                                        <? /* Vertical Align Mobile 
                                        <tr>
                                            <th width="25%" ><label class="labelform" for="mob_tXt_pos_<?php echo $oForm->form_id; ?>">Text Position <br/>(Vertical Alignment)</label></th>
                                            <td>
                                                <div class="slideFP" id="mob_fontpos_<?php echo $oForm->form_id; ?>"></div>
                                                <input type="text" name="tXt_pos" id="mob_tXt_pos_<?php echo $oForm->form_id; ?>" maxlength="3" size="3" value="<?php echo (!empty($aryBarSet['tXt_pos']))? $aryBarSet['tXt_pos']:'25';?>" readonly > px
                                            </td>
                                        </tr>
                                        */?>

                                        <script>

                                            jQuery(document).ready(function($) {

                                                try{

                                                    //FONT FAMILY
                                                    var mob_font_fam_<?php echo $oForm->form_id; ?> = $('#mob_font_fam_<?php echo $oForm->form_id; ?>');
                                                    mob_font_fam_<?php echo $oForm->form_id; ?>.change(function(){
                                                        var fFam = $(this).val();
                                                        //$('.cUs_oSbr').removeClass("oSans oSwald DroidSerif Playfair Arial Helvetica Verdana Tahoma Times");
                                                        //$('.cUs_oSbr').addClass(fFam);
                                                    })
                                                    mob_font_fam_<?php echo $oForm->form_id; ?>.val('<?php echo (!empty( $aryBarSet['font'] ))? $aryBarSet['font']:'oSans';?>');

                                                    //FONT SIZE
                                                    var mob_font_size_<?php echo $oForm->form_id; ?> = $('#mob_font_size_<?php echo $oForm->form_id; ?>');
                                                    mob_font_size_<?php echo $oForm->form_id; ?>.change(function(){
                                                        var fSz = $(this).val();
                                                        //$('.cUs_oSbr ._xt p').css({'font-size':fSz + 'px'});
                                                    });
                                                    mob_font_size_<?php echo $oForm->form_id; ?>.val(<?php echo (!empty($aryBarSet['font_size']))?$aryBarSet['font_size']:'11';?>);

                                                    //FONT COLOR
                                                    var mob_font_color_<?php echo $oForm->form_id; ?> = $('#mob_font_color_<?php echo $oForm->form_id; ?>');
                                                    $('#mob_font_colorpicker_<?php echo $oForm->form_id; ?>').farbtastic(function(color){
                                                        //$('.cUs_oSbr ._xt p').css({'color':color});
                                                        $('#mob_h_font_color_<?php echo $oForm->form_id; ?>').val(color);
                                                    });
                                                    mob_font_color_<?php echo $oForm->form_id; ?>.click(function() {
                                                        $('#mob_font_colorpicker_<?php echo $oForm->form_id; ?>').fadeIn();
                                                    }).mouseleave(function(){
                                                        $(this).val('Color');
                                                    });

                                                    //BOLD FONT
                                                    var mob_font_bold_<?php echo $oForm->form_id; ?> = $('#mob_font_bold_<?php echo $oForm->form_id; ?>');
                                                    mob_font_bold_<?php echo $oForm->form_id; ?>.click(function(){
                                                        var tXt = mob_bar_txt_<?php echo $oForm->form_id; ?>.val();
                                                        if($(this).is(':checked')){
                                                            tXt = "<b>" + tXt + "</b>";
                                                        }else{
                                                            tXt = tXt.replace("<b>","").replace("</b>","");
                                                        }
                                                        //$('.cUs_oSbr ._xt p').html(tXt);
                                                        mob_bar_txt_<?php echo $oForm->form_id; ?>.val(tXt);
                                                    });

                                                    //ITALIC FONT
                                                    var mob_font_ita_<?php echo $oForm->form_id; ?> = $('#mob_font_ita_<?php echo $oForm->form_id; ?>');
                                                    mob_font_ita_<?php echo $oForm->form_id; ?>.click(function(){
                                                        var tXt = mob_bar_txt_<?php echo $oForm->form_id; ?>.val();
                                                        if($(this).is(':checked')){
                                                            tXt = "<i>" + tXt + "</i>";
                                                        }else{
                                                            tXt = tXt.replace("<i>","").replace("</i>","");
                                                        }
                                                        //$('.cUs_oSbr ._xt p').html(tXt);
                                                        mob_bar_txt_<?php echo $oForm->form_id; ?>.val(tXt);
                                                    });

                                                    //BAR TEXT
                                                    var mob_bar_txt_<?php echo $oForm->form_id; ?> = $('#mob_bar_txt_<?php echo $oForm->form_id; ?>');
                                                    mob_bar_txt_<?php echo $oForm->form_id; ?>.on("change keyup paste", function() {
                                                        var tXt = $(this).val();
                                                        //$('.cUs_oSbr ._xt p').html(tXt);
                                                    });


                                                    //TEXT POSITION VERICAL
                                                  /*  $( "#mob_fontpos_<?php echo $oForm->form_id; ?>" ).slider({
                                                        range: "min",
                                                        value: <?php echo (!empty($aryBarSet['tXt_pos']))?$aryBarSet['tXt_pos']:'5';?>,
                                                        min: 5,
                                                        max: 60,
                                                        slide: function( event, ui ) {
                                                            $( "#mob_tXt_pos_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                                            //$('.cUs_oSbr ._xt').css({ top:ui.value + '%' });
                                                        }
                                                    });
                                                    */


                                                }catch(err){
                                                    console.log(err);
                                                }

                                            });

                                        </script>

                                    </table>

                                    <h3>Bar Design</h3>
                                    <div class="col">

                                        <table class="form-table table_<?php echo $oForm->form_id; ?>">
                                            <tr>
                                                <th width="25%" ><label class="labelform" for="mob_colorpicker_<?php echo $oForm->form_id; ?>">Background Color</label></th>
                                                <td>
                                                    <div class="cPikr_wpr">
                                                        <div class="colorpicker bg" id="mob_colorpicker_<?php echo $oForm->form_id; ?>"></div>
                                                        <input type="text" name="bar_color" id="mob_color_<?php echo $oForm->form_id; ?>" value="<?php echo (!empty($aryBarSet['bar_color']))?$aryBarSet['bar_color']:cUsSBr_DFT_BKG;?>" style="background: <?php echo (!empty($aryBarSet['bar_color']))?$aryBarSet['bar_color']:cUsSBr_DFT_BKG;?>;" maxlength="7">
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                           <?php
                                           /* Mobile Options
                                           
                                            <tr>
                                                <th width="25%" ><label class="labelform" for="mob_bar_height_<?php echo $oForm->form_id; ?>">Bar Height</label></th>
                                                <td>
                                                    <div class="slideH" id="mob_barheight_<?php echo $oForm->form_id; ?>"></div>
                                                    <input type="text" name="bar_height" id="mob_bar_height_<?php echo $oForm->form_id; ?>" maxlength="3" size="3" value="<?php echo (!empty($aryBarSet['bar_height']))? $aryBarSet['bar_height']:'20';?>" readonly > pixels

                                                </td>
                                            </tr>
                                           
                                           */
                                           ?>
                                           
                                            <tr>
                                                <th><label class="labelform" for="cUsSBr_option">Bar Shadow</label></th>
                                                <td>
                                                    <div class="options">
                                                        <label for="mob_bar-shadow-y-<?php echo $oForm->form_id; ?>">Yes</label> <input type="radio" id="mob_bar-shadow-y-<?php echo $oForm->form_id; ?>" name="bar-shadow-<?php echo $oForm->form_id; ?>" value="1" <?php echo($aryBarSet['mob_bar-shadow-'.$oForm->form_id] == 1) ? 'checked' : ''; ?> >
                                                        <label for="mob_bar-shadow-n-<?php echo $oForm->form_id; ?>">No</label> <input type="radio" id="mob_bar-shadow-n-<?php echo $oForm->form_id; ?>" name="bar-shadow-<?php echo $oForm->form_id; ?>" value="0" <?php echo($aryBarSet['mob_bar-shadow-'.$oForm->form_id] == 0) ? 'checked' : ''; ?>  <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?>>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col right">
                                        <table class="form-table table_<?php echo $oForm->form_id; ?>">
                                            <tr>
                                                <th><label class="labelform" for="cUsSBr_option">Bar Position</label></th>
                                                <td>
                                                    <div class="options">
                                                        <label for="mob_top-position_<?php echo $oForm->form_id; ?>">Top</label> <input type="radio" id="mob_top-position_<?php echo $oForm->form_id; ?>" name="mob_position_<?php echo $oForm->form_id; ?>" value="_t0p" <?php echo($aryBarSet['mob_position_'.$oForm->form_id] == '_t0p') ? 'checked' : ''; ?>  <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?> >
                                                        <label for="mob_bottom-position_<?php echo $oForm->form_id; ?>">Bottom</label><input type="radio" id="mob_bottom-position_<?php echo $oForm->form_id; ?>" name="mob_position_<?php echo $oForm->form_id; ?>" <?php echo($aryBarSet['mob_position_'.$oForm->form_id] == '_b0t') ? 'checked' : ''; ?> value="_b0t" >
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <span class="circle yellow">!</span>
                                                    <strong>If you have a fixed menu on the top of your site: </strong> Switch this option to bottom so that the callout bar and the fixed menu don’t compete for the same fixed position.
                                                </td>
                                            </tr>

                                            <tr>
                                                <th><label class="labelform" for="cUsSBr_option">Bar Visibility</label></th>
                                                <td>
                                                    <div class="options">
                                                        <label for="mob_bar-show-y-<?php echo $oForm->form_id; ?>">Show</label> <input type="radio" id="mob_bar-show-y-<?php echo $oForm->form_id; ?>" name="mob_bar-show-<?php echo $oForm->form_id; ?>" value="1" <?php echo($aryBarSet['mob_bar-show-'.$oForm->form_id] == 1) ? 'checked' : ''; ?> <?php echo(!is_array($aryBarSet) && empty($aryBarSet))?'checked':'';?> >
                                                        <label for="mob_bar-show-n-<?php echo $oForm->form_id; ?>">Hidden</label> <input type="radio" id="mob_bar-show-n-<?php echo $oForm->form_id; ?>" name="mob_bar-show-<?php echo $oForm->form_id; ?>" value="0" <?php echo( is_array($aryBarSet) && $aryBarSet['mob_bar-show-'.$oForm->form_id] == 0) ? 'checked' : ''; ?> >
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>

                                    <button class="m1 btn orange large save_tab_mob" data-formid="<?php echo $oForm->form_id; ?>" type="button">Save Mobile Settings</button>

                                    <script>

                                        jQuery(document).ready(function($) {

                                            try{

                                                //BAR COLOR
                                                var mob_eL_<?php echo $oForm->form_id; ?> = $('#mob_color_<?php echo $oForm->form_id; ?>');
                                                $('#mob_colorpicker_<?php echo $oForm->form_id; ?>').farbtastic('#mob_color_<?php echo $oForm->form_id; ?>, .cUs_oSbr');

                                                mob_eL_<?php echo $oForm->form_id; ?>.focusin(function() {
                                                    //$(this).val('#002968');
                                                    $('#mob_colorpicker_<?php echo $oForm->form_id; ?>').fadeIn();
                                                }).focusout(function(){
                                                    $('#mob_colorpicker_<?php echo $oForm->form_id; ?>').fadeOut();
                                                }).keypress(function(){
                                                    //$('.cUs_oSbr').css({background:$(this).val()});
                                                });

                                                $( "#mob_barheight_<?php echo $oForm->form_id; ?>" ).slider({
                                                    range: "min",
                                                    value: <?php echo (!empty($aryBarSet['bar_height']))?$aryBarSet['bar_height']:'20';?>,
                                                    min: 18,
                                                    max: 300,
                                                    slide: function( event, ui ) {
                                                        $( "#mob_bar_height_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                                        //$('.cUs_oSbr').css({height:ui.value});
<!--                                                        if( ui.value <= 50 ){-->
<!--                                                            $('.cUs_oSbr > ._xt').css({top:"25%"});-->
<!--                                                            $('#tXt_pos_--><?php //echo $oForm->form_id; ?><!--').val(25);-->
<!--                                                        }else if(ui.value > 50 && ui.value < 80){-->
<!--                                                            $('.cUs_oSbr > ._xt').css({top:"35%"});-->
<!--                                                            $('#tXt_pos_--><?php //echo $oForm->form_id; ?><!--').val(35);-->
<!--                                                        }else if(ui.value > 80){-->
<!--                                                            $('.cUs_oSbr > ._xt').css({top:"40%"});-->
<!--                                                            $('#tXt_pos_--><?php //echo $oForm->form_id; ?><!--').val(40);-->
<!--                                                        }-->
                                                    }
                                                });

                                                $( "#mob_barmargin_<?php echo $oForm->form_id; ?>" ).slider({
                                                    range: "min",
                                                    value: <?php echo (!empty($aryBarSet['bar_margin']))?$aryBarSet['bar_margin']:'0';?>,
                                                    min: 0,
                                                    max: 99,
                                                    slide: function( event, ui ) {
                                                        //$('.cUs_oSbr').css({top:ui.value+"px"});
                                                        $( "#mob_bar_margin_<?php echo $oForm->form_id; ?>" ).val(  ui.value );
                                                    }
                                                });

                                                //BAR POSITION
                                                $('input[type=radio][name=mob_position_<?php echo $oForm->form_id; ?>]').change(function() {
                                                    if (this.value == '_t0p') {
                                                        //$('.cUs_oSbr').removeClass('_b0t').addClass(this.value);
                                                    }else if (this.value == '_b0t') {
                                                        //$('.cUs_oSbr').removeClass('_t0p').addClass(this.value);
                                                    }
                                                });

                                                //BAR SHADOW
                                                $('input[type=radio][name=mob_bar-shadow-<?php echo $oForm->form_id; ?>]').change(function() {
                                                    if (this.value == 1) {
                                                        //$('.cUs_oSbr').addClass('_shadow');
                                                    }else{
                                                        //$('.cUs_oSbr').removeClass('_shadow');
                                                    }
                                                });


                                            }catch(err){
                                                console.log(err);
                                            }

                                        });

                                    </script>

                                </form>
                            </div>

                            <div id="bAcc3">

                                <?php
                                $aryBarActions = get_option('cUsSBr_settings_BAR_ACTIONS_'.$oForm->form_key );
                                ?>

                                <div class="note">
                                    <h4>When customizing your Bar Settings and Callout Bar Actions, please save each tab. There is an orange save button at the bottom of each tab.</h4>
                                </div>

                                <h3>Bar Actions</h3>
                                <p>By default, this bar is used to open up a new ContactUs.com form that has been created in your account.  The type of form depends on  the goal you submitted at registration.</p>
                                <p>Based on your choice of “Grow your email list”, a newsletter signup form has been created for you, and that is the default action for this bar.  However, you can change this setting below:</p>
                                <div class="loadingMessage"></div><div class="advice_notice">Advice ....</div><div class="notice">Messages....</div>

                                <form action="" name="bar_actions_<?php echo $oForm->form_id; ?>" id="bar_actions_<?php echo $oForm->form_id; ?>">
                                    <p><input type="radio" name="action_<?php echo $oForm->form_id; ?>" id="pop_<?php echo $oForm->form_id; ?>" value="popup" <?php echo($aryBarActions['action_'.$oForm->form_id] == 'popup') ? 'checked' : ''; ?>  <?php echo(!is_array($aryBarActions) && empty($aryBarActions))?'checked':'';?> ><label for="pop_<?php echo $oForm->form_id; ?>"><b>Open up a ContactUs.com form</b> (default action)</label></p>
                                    <p><input type="radio" name="action_<?php echo $oForm->form_id; ?>" id="noa_<?php echo $oForm->form_id; ?>" value="noaction" <?php echo($aryBarActions['action_'.$oForm->form_id] == 'noaction') ? 'checked' : ''; ?> ><label for="noa_<?php echo $oForm->form_id; ?>">No action on the bar (it’s text only)</label></p>
                                    <p><input type="radio" name="action_<?php echo $oForm->form_id; ?>" id="lin_<?php echo $oForm->form_id; ?>" value="link" <?php echo($aryBarActions['action_'.$oForm->form_id] == 'link') ? 'checked' : ''; ?> ><label for="lin_<?php echo $oForm->form_id; ?>">Create navigation link for the bar (type or paste your link below)</label></p>
                                    <p><input type="text" size="50" name="linkurl" id="linkurl_<?php echo $oForm->form_id; ?>" placeholder="ex. http://<?php echo $_SERVER['SERVER_NAME'];?>" value="<?php echo($aryBarActions['action_'.$oForm->form_id] == 'link') ? $aryBarActions['linkurl'] : ''; ?>" ></p>

                                    <input type="hidden" name="action" value="cUsSBr_saveBarActions">
                                    <input type="hidden" name="bar_formkey" value="<?php echo $oForm->form_key ?>">
                                    <input type="hidden" name="form_id" value="<?php echo $oForm->form_id; ?>">
                                    <button class="m1 btn orange large save_bar_actions" data-formid="<?php echo $oForm->form_id; ?>" type="button">Save Bar Actions</button>
                                </form>
                            </div>

                            </div>


                            </div>

                            <div class="form_description hidden" id="form_description_<?php echo $oForm->form_id; ?>">


                                <?php
                                $default_deep_link = $oForm->deep_link_view;
                                $ablink = $cUsSBr_api->parse_deeplink($default_deep_link);
                                $ablink = $ablink . '?pageID=90&do=view&formID=' . $oForm->form_id;
                                ?>

                                <h2>Form Name: <?php echo $oForm->form_name ?>
                                    <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=1" target="_blank" class="btn lightblue">Change Form Name</a></h2>


                                <div class="form-template">
                                    <span class="thumb"><img src="<?php echo $oForm->template_desktop_form_thumbnail ?>" class="form_thumb_<?php echo $formID; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" /></span>
                                    <p><b>Form Template:</b> <?php echo $oForm->template_desktop_form ?></p>
                                </div>
                                <div class="form-template">
                                    <span class="thumb"><img src="<?php echo $oForm->template_mobile_form_thumbnail ?>"  /></span>
                                    <p><b>Mobile Form Template:</b> <?php echo $oForm->template_mobile_form ?></p>
                                </div>
                                <div class="form-template">
                                    <span class="thumb"><img src="<?php echo $oForm->template_desktop_tab_thumbnail ?>" class="tab_thumb" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" /></span>
                                    <p><b>Tab Template:</b> <?php echo $oForm->template_desktop_tab ?></p>
                                </div>

                                <div class="form_templates_tools">
                                    <h4>Find instructions on how to build shortcodes and theme snippets  <a href="javascript:;" class="blue_link" onclick="jQuery('#cUsSBr_tabs').tabs({active: 2});jQuery.colorbox.close();"> Here. </a></h4>
                                    <h3>Form Tools</h3>
                                    <div>
                                        <div class="Template_Contact_Form">
                                            <div class="button_set">
                                                <?php if ($form_Type == 'contact_us') { ?><a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=14%26newTemplate=genericTemplate2" target="_blank" class="btn lightblue abutton cf setLabels" title="Add Custom Form Fields on a ContactUs.com Custom Form to Make It Your Own">Custom Fields</a> <?php } ?>
                                                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=1" target="_blank" class="btn lightblue abutton confF setLabels" title="For the use your own hyperlink/event. You can create your own link to open the form instead. Automatically open form or on Exit Intent">Events & Triggers</a>
                                                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=4" target="_blank" class="btn lightblue abutton confF setLabels" title="Our beautiful form templates are built by designers who have extensive experience in generating online web leads for websites. Change It From Here.">Configure Form</a>
                                                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=5" target="_blank" class="btn lightblue abutton ct setLabels" title="They’re designed by our web conversion rate experts to catch the attention of those looking to take the next step in contacting you. Change It From Here.">Configure Tab</a>
                                                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($ablink)); ?>" target="_blank" class="btn lightblue abutton AbTest setLabels" title="ContactUs.com lets websites simply set-up and run A/B experiments with the sole purpose of increase your website’s engagements.">A/B Test</a>

                                            </div>
                                            <h4>Instructions on how to use Delayed Pop-up &  Exit Intent Triggers</h4>
                                            <ul class="hints" style="margin-left:50px;">
                                                <li><a href="http://www.contactus.com/delayed-pop-up-triggers/" target="_blank"> Delayed Pop-up Triggers </a></li>
                                                <li><a href="http://www.contactus.com/exit-intent-triggers/" target="_blank"> Exit Intent Triggers </a></li>
                                            </ul>

                                            <hr />
                                            <hr />
                                            <p><strong>NOTE:</strong> You will be redirected to your ContactUs.com admin panel to edit your form configurations.</p>

                                        </div>
                                    </div>

                                    <h3>Delivery Options / 3rd Party Services</h3>
                                    <div>
                                        <div class="delivery_options">
                                            <div class="button_set">
                                                <?php $default_deep_link = $oForm->deep_link_view; ?>
                                                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo $cUs_API_Key; ?>&confirmed=1&redir_url=<?php echo urlencode(trim($default_deep_link)); ?>%26expand=103" target="_blank" rel="toDash" class="btn lightblue abutton setLabels" title="Integration with popular CRM and email marketing software services">3rd Party Integrations</a>
                                            </div>
                                            <p>Do you need to learn how to manage or configure software integrations on ContactUs.com?  <a href="http://help.contactus.com/hc/en-us/articles/200676336-Configuring-Lead-Deliveries-to-3rd-Party-Services" class="blue_link" target="_blank">Click here</a></p>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <?php
                            $nCF++;
                            //END IF ALLOWED TYPES
                        }
                    }
                    ?>
                    </div>
                    <?php
                    break;
            } //endswitch;

            if ($nCF <= 1) {
                ?>
                <a href="<?php echo cUsSBr_PARTNER_URL; ?>/index.php?loginName=<?php echo $cUs_API_Account; ?>&userPsswd=<?php echo urlencode($cUs_API_Key); ?>&confirmed=1&redir_url=<?php echo urlencode(trim($createform)) . $form_Type; ?>" target="_blank" class="deep_link_action">Add New Form <span>+</span></a>
            <?php
            }
        }
    }

}


?>

<script>
    //PLUGIN cUsSBr_myjq ENVIROMENT (cUsSBr_myjq)
    var cUsSBr_myjq = jQuery.noConflict();

    //ON READY DOM LOADED
    cUsSBr_myjq(document).ready(function($) {

        try{
            $('.save_tab').click(function(e){
                e.preventDefault();
                var theBID = $(this).attr('data-formid');
                var oBarData = $('#bar_settings_frm_' + theBID).serialize();
                var oThis = $(this);
                cUsSBr_myjq('.loadingMessage').show();
                oThis.html('Saving...');
                cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: oBarData ,
                    success: function(data) {
                        oThis.html('Saving...').delay(900).html('Completed...');
                        message = '<p>Bar Settings Saved Correctly</p>';
                        cUsSBr_myjq('.notice').html(message).fadeIn();
                        setTimeout(function(){
                            oThis.html('Save Bar Settings');
                            cUsSBr_myjq('.notice').html('').fadeOut();
                        },1500);
                        cUsSBr_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });
            });
        }catch(err){
            console.log(err);
        }

        //save mobile settings
        try{
            $('.save_tab_mob').click(function(e){
                e.preventDefault();
                var theBID = $(this).attr('data-formid');
                var oBarData = $('#bar_settings_mob_frm_' + theBID).serialize();
                var oThis = $(this);
                cUsSBr_myjq('.loadingMessage').show();
                oThis.html('Saving...');
                cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: oBarData ,
                    success: function(data) {
                        oThis.html('Saving...').delay(900).html('Completed...');
                        message = '<p>Bar Settings Saved Correctly</p>';
                        cUsSBr_myjq('.notice').html(message).fadeIn();
                        setTimeout(function(){
                            oThis.html('Save Bar Settings');
                            cUsSBr_myjq('.notice').html('').fadeOut();
                        },1500);
                        cUsSBr_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });
            });
        }catch(err){
            console.log(err);
        }

        try{
            $('.save_bar_actions').click(function(e){
                e.preventDefault();
                var theBID = $(this).attr('data-formid');
                var oBarData = $('#bar_actions_' + theBID).serialize();
                var linkUrl = $('#linkurl_' + theBID).val();
                var linkUrl_webValid = checkURL(linkUrl);
                var oThis = $(this);

                if(linkUrl.length && !linkUrl_webValid){
                    alert('Please, enter one valid website URL. Ex. http://www.yourlink.com/?true');
                    return false;
                }

                cUsSBr_myjq('.loadingMessage').show();
                oThis.html('Saving...');
                cUsSBr_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: oBarData ,
                    success: function(data) {
                        oThis.html('Saving...').delay(900).html('Completed...');
                        message = '<p>Bar Actions Saved Correctly</p>';
                        cUsSBr_myjq('.notice').html(message).fadeIn();;
                        setTimeout(function(){
                            oThis.html('Save Bar Actions');
                            cUsSBr_myjq('.notice').html('').fadeOut();
                            //$.colorbox.close();
                        },1500);
                        cUsSBr_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });

            });
        }catch(err){
            console.log(err);
        }


        try {
            $('.form_zoom').click(function() {
                var form_id = $(this).attr('data-id');
                var form_key = $(this).attr('data-key');
                var el_id = "#bar_settings_" + form_id;
                //$(el_id).draggable();
                $.colorbox({inline: true, width: "75%", maxHeight:"99%", open: true, opacity:0.2, href: el_id, transition: 'fade', className: 'forms_box',
                    onClosed: function() {
                        $(el_id).hide();

                        $('.cUs_oSbr').removeClass("oSans oSwald DroidSerif Playfair Arial Helvetica Verdana Tahoma Times _b0t _t0p _shadow");
                        $('.cUs_oSbr').addClass('_t0p').addClass('oSans').css({background:'#002968',height:38}).fadeOut();

                        $('.cUs_oSbr > ._xt p').html('Love our website? Signup to our list to keep current on the awesome stuff we’re doing.')
                            .css({'font-size':'12px', 'color':'#ffffff'});
                        $('.cUs_oSbr > ._xt').css({'top':'25%'});
                    },
                    onOpen: function() {

                        cUsSBr_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsSBr_getBarSettings', form_key:form_key} ,
                            success: function(data) {
                                if(data){
                                    var form_id = data.form_id;
                                    var bPos = data['position_' + form_id];
                                    var shadw = (data['bar-shadow-' + form_id] == 1) ? '_shadow' : '';

                                    $('.cUs_oSbr').removeClass("oSans oSwald DroidSerif Playfair Arial Helvetica Verdana Tahoma Times _b0t _t0p _shadow")
                                        .addClass(bPos)
                                        .addClass(data.font)
                                        .addClass(shadw)
                                        .css({background:data.bar_color,height:data.bar_height});

                                    $('.cUs_oSbr > ._xt p').html(data.bar_txt).css({'font-size':data.font_size + 'px', 'color':data.font_color});
                                    $('.cUs_oSbr > ._xt').css({'top':data.tXt_pos + '%'});
                                }
                            },
                            async: false
                        });
                        $(el_id).show();
                        $('.cUs_oSbr').slideDown();
                    }
                });
            });
        } catch (err) {
            console.log(err);
        }

        try {
            $('.form_bar_set').click(function() {
                var form_id = $(this).attr('data-id');
                var el_id = "#form_description_" + form_id;
                $.colorbox({inline: true, width: "75%", maxHeight:"89%", open: true, opacity:0.2, href: el_id, transition: 'fade', className: 'forms_box',
                    onClosed: function() {
                        $(el_id).hide();
                    },
                    onOpen: function() {
                        $(el_id).show();
                    }
                });
                $.colorbox.resize();
            });
        } catch (err) {
            console.log(err);
        }

        function checkURL(url) {
            return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
        }

        $.fn.serializeObject = function()
        {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };


    });//ready
</script>