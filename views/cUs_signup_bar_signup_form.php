<?php
/**
 * 
 * CALLOUT BAR BY CONTACTUS.COM
 * 
 * Initialization Signup Form View
 * @since 1.0 First time this was introduced into  plugin.
 * @author ContactUs.com <support@contactus.com>
 * @copyright 2014 ContactUs.com Inc.
 * Company      : contactus.com
 * Updated  	: 20140127
 * */
/*
 * SINGUP FORM - SIGNUP WIZARD - STEP 1
 * @since 1.0
 */
?>

<form method="post" action="admin.php?page=cUs_callout_bar_plugin" id="cUsSBr_userdata" name="cUsSBr_userdata" class="steps step1" onsubmit="return false;">
    <a name="signupform"></a>
    <h3 class="step_title">Register for Your ContactUs.com Account</h3>

    <table class="form-table">
        <tr>
            <td>
                <label class="labelform" for="cUsSBr_option">What is the Goal of Your Callout Bar?</label>
                <select name="cUsSBr_option" id="cUsSBr_option">
                    <option value="email_list">Grow Your Email List</option>
                    <option value="sales_leads">Generate Sales Leads</option>
                    <option value="contact_inquires">Enable General Contact Inquiries</option>
                </select>
            </td>
            <td>
                <label class="labelform" for="cUsSBr_email">Email</label>
                <input type="text" class="inputform text" placeholder="Email" name="cUsSBr_email" id="cUsSBr_email" value="<?php echo (isset($_POST['cUsSBr_email']) && strlen($_POST['cUsSBr_email'])) ? $_POST['cUsSBr_email'] : $current_user->user_email; ?>"/>
            </td>
        </tr>

        <tr>
            <td><label class="labelform" for="cUsSBr_password">Password</label><input type="password" class="inputform text" name="cUsSBr_password" id="cUsSBr_password" value=""/></td>
            <td><label class="labelform" for="cUsSBr_password_r">Confirm Password</label><input type="password" class="inputform text" name="cUsSBr_password_r" id="cUsSBr_password_r" value=""/></td>
        </tr>

        <tr>
            <td>
                <label class="labelform" for="cUsSBr_first_name">First Name</label>
                <input type="text" class="inputform text" placeholder="First Name" name="cUsSBr_first_name" id="cUsSBr_first_name" value="<?php echo (isset($_POST['cUsSBr_first_name']) && strlen($_POST['cUsSBr_first_name'])) ? $_POST['cUsSBr_first_name'] : $current_user->user_firstname; ?>" />
            </td>
            <td>
                <label class="labelform" for="cUsSBr_last_name">Last Name</label>
                <input type="text" class="inputform text" placeholder="Last Name" name="cUsSBr_last_name" id="cUsSBr_last_name" value="<?php echo (isset($_POST['cUsSBr_last_name']) && strlen($_POST['cUsSBr_last_name'])) ? $_POST['cUsSBr_last_name'] : $current_user->user_lastname; ?>"/>
            </td>
        </tr>

        <tr>
            <td><label class="labelform" for="cUsSBr_web">Website</label><input type="text" class="inputform text" placeholder="Website (http://www.example.com)" name="cUsSBr_web" id="cUsSBr_web" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>"/></td>
            <td><label class="labelform" for="cUsSBr_phone">Phone</label><input type="text" class="inputform text" placeholder="Phone (optional)" name="cUsSBr_phone" id="cUsSBr_phone" value=""/></td>
        </tr>

        <tr>
            <td>
                <input id="cUsSBr_CreateCustomer" class="btn orange" value="Create My Account" href="#cats_selection" type="submit" />
            </td>
            <td><div class="loadingMessage"></div></td>
        </tr>
        <tr>
            <td  colspan="2">By creating a ContactUs.com account, You agree that: <b>a)</b> You have read and accepted our <a href="http://www.contactus.com/terms-of-service/" class="blue_link" target="_blank">Terms</a> and our <a href="http://www.contactus.com/privacy-security/" class="blue_link" target="_blank">Privacy Policy</a> and <b>b)</b> You may receive communications from <a href="http://www.contactus.com/" class="blue_link"  target="_blank">ContactUs.com</a></td>
        </tr>
    </table>
</form>

<?php
global $current_user;
get_currentuserinfo();
?>

<!-- CATS SUBCATS AND GOALS -->
<div id="cats_container" style="display:none;">

    <div id="cats_selection">
        <div class="loadingMessage"></div><div class="advice_notice">Advices....</div><div class="notice">Ok....</div>
        <form action="/" onsubmit="return false;">

            <div id="customer-categories-box" class="questions-box">

                <div class="cc-headline">Hi <?php echo $current_user->first_name; ?>, Help us get you started</div>
                <img src="<?php echo plugins_url('assets/style/images/contactus-users.png', dirname(__FILE__)); ?>" class="user-graphic">
                <div class="cc-message">We’re working on new ways to personalize your account</div>
                <div class="cc-message-small">Please take 7 seconds to tell us about your website, which helps us identify the best tools for your needs:</div>

                <h4 class="cc-title" id="category-message">Select the Category of Your Website:</h4>

                <?php
                /*
                 * GET CATEGORIES AND SUBCATEGORIES
                 */
                $aryCategoriesAndSub = $cUsSBr_api->getCategoriesSubs();

                if (is_array($aryCategoriesAndSub)) {
                    ?>
                    <ul id="customer-categories">
                        <?php foreach ($aryCategoriesAndSub as $category => $arySubs) { ?>

                            <li class="parent-category"><span data-maincat="<?php echo $category; ?>" id="<?php echo str_replace(' ', '-', $category); ?>" class="parent-title"><?php echo trim($category); ?></span>
                                <?php if (is_array($arySubs)) { ?>
                                    <ul class="sub-category">
                                        <?php foreach ($arySubs as $Sub) { ?>
                                            <li data-subcat="<?php echo $Sub; ?>"><span><?php echo trim($Sub); ?></span></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>

                        <?php } ?>
                    </ul>
                <?php } ?>

                <div class="int-navigation">
                    <button class="btn next btn-skip">Skip</button>
                    <img src="<?php echo plugins_url('assets/style/images/ajax-loader.gif', dirname(__FILE__)); ?>" width="16" height="16" alt="Loading . . ." style="display:none; vertical-align:middle;" class="img_loader" />
                    <div class="next btn unactive" id="open-intestes">Next Question</div>
                </div>

            </div>

            <div id="user-interests-box" class="questions-box">
                <div class="cc-headline">Hi <?php echo $current_user->user_login; ?></div>
                <div class="cc-message">What are your goals for your ContactUs.com form?</div>

                <?php
                /*
                 * GET GOALS
                 */
                $aryGoals = $cUsSBr_api->getGoals();

                if (is_array($aryGoals)) {
                    ?>
                    <ul id="user-interests">
                        <?php foreach ($aryGoals as $Goal) { ?>
                            <li data-goals="<?php echo trim($Goal); ?>" <?php if ($Goal === 'Other') { ?>id="other"<?php } ?>><span <?php if (strpos($Goal, 'to my email') !== false) { ?> class="grey" <?php } ?>><?php echo trim($Goal); ?></span></li>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <div id="other-interest">Please tell us <input type="text" name="other" id="other_goal" value="" /></div>

                <div class="int-navigation">
                    <button class="btn next btn-skip">Skip</button>
                    <div class="next btn unactive btn-skip" id="save">Save Preferences</div>
                    <img src="<?php echo plugins_url('assets/style/images/ajax-loader.gif', dirname(__FILE__)); ?>" width="16" height="16" alt="Loading . . ." style="display:none; vertical-align:middle;" class="img_loader" />
                </div>

            </div>

            <!-- input the category and subcategory data -->
            <input type="hidden" value="" name="CU_category" id="CU_category" />
            <input type="hidden" value="" name="CU_subcategory" id="CU_subcategory" />
            <!-- <input type="hidden" value="" name="CU_goals" id="CU_goals" /> -->

            <div id="goals_added"></div>

        </form>
        <br /><br /><br />
    </div>
</div>
<!-- / CATS SUBCATS AND GOALS -->