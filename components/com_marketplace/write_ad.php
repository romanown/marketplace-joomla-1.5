<?php
/**
 * write.php
 *
 * writes and edits ads,
 * uploads and deletes images
 *
 * @package com_marketplace
 * @subpackage frontend
 *
 * @copyright 2005-2008 Codingfish Limited
 * @author Achim Fischer
 *
 * This file is part of Codingfish Marketplace.
 *
 * Marketplace is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Marketplace is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Marketplace; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Dont allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>

<link rel="stylesheet" href="components/com_marketplace/marketplace.css" type="text/css" />

<?php
global $database;


$Itemid       = intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );
$adid         = intval( mosGetParam( $_REQUEST, 'adid', '0' ) );
$isUpdateMode = intval( mosGetParam( $_REQUEST, 'isUpdateMode', '0' ) );
$userid       = intval( mosGetParam( $_REQUEST, 'userid', '0' ) );

$username     = strval( mosGetParam( $_REQUEST, 'username', '' ) );
$mode         = strval( mosGetParam( $_REQUEST, 'mode', '' ) );

$name         = strval( mosGetParam( $_REQUEST, 'name', '' ) );
$surname      = strval( mosGetParam( $_REQUEST, 'surname', '' ) );
$street       = strval( mosGetParam( $_REQUEST, 'street', '' ) );
$zip          = strval( mosGetParam( $_REQUEST, 'zip', '' ) );
$city         = strval( mosGetParam( $_REQUEST, 'city', '' ) );
$state        = strval( mosGetParam( $_REQUEST, 'state', '' ) );
$country      = strval( mosGetParam( $_REQUEST, 'country', '' ) );
$email        = strval( mosGetParam( $_REQUEST, 'email', '' ) );
$web          = strval( mosGetParam( $_REQUEST, 'web', '' ) );
$phone1       = strval( mosGetParam( $_REQUEST, 'phone1', '' ) );
$phone2       = strval( mosGetParam( $_REQUEST, 'phone2', '' ) );

$ad_type      = intval( mosGetParam( $_REQUEST, 'ad_type', '0' ) );
$category     = intval( mosGetParam( $_REQUEST, 'category', '0' ) );

$ad_headline  = strval( mosGetParam( $_REQUEST, 'ad_headline', 'Foto' ) );
$ad_text      = strval( mosGetParam( $_REQUEST, 'ad_text', 'Foto' ) );

$ad_condition = strval( mosGetParam( $_REQUEST, 'ad_condition', '' ) );
$ad_price     = strval( mosGetParam( $_REQUEST, 'ad_price', '' ) );

$ad_picture1  = strval( mosGetParam( $_REQUEST, 'ad_picture1', '' ) );
$ad_picture2  = strval( mosGetParam( $_REQUEST, 'ad_picture2', '' ) );
$ad_picture3  = strval( mosGetParam( $_REQUEST, 'ad_picture3', '' ) );
$ad_picture4  = strval( mosGetParam( $_REQUEST, 'ad_picture4', '' ) );
$ad_picture5  = strval( mosGetParam( $_REQUEST, 'ad_picture5', '' ) );
$ad_picture6  = strval( mosGetParam( $_REQUEST, 'ad_picture6', '' ) );
$ad_picture7  = strval( mosGetParam( $_REQUEST, 'ad_picture7', '' ) );
$ad_picture8  = strval( mosGetParam( $_REQUEST, 'ad_picture8', '' ) );
$ad_picture9  = strval( mosGetParam( $_REQUEST, 'ad_picture9', '' ) );
$ad_picture10 = strval( mosGetParam( $_REQUEST, 'ad_picture10', '' ) );
$ad_picture11 = strval( mosGetParam( $_REQUEST, 'ad_picture11', '' ) );
$ad_picture12 = strval( mosGetParam( $_REQUEST, 'ad_picture12', '' ) );
$ad_picture13 = strval( mosGetParam( $_REQUEST, 'ad_picture13', '' ) );
$ad_picture14 = strval( mosGetParam( $_REQUEST, 'ad_picture14', '' ) );
$ad_picture15 = strval( mosGetParam( $_REQUEST, 'ad_picture15', '' ) );
$ad_picture16 = strval( mosGetParam( $_REQUEST, 'ad_picture16', '' ) );
$ad_picture17 = strval( mosGetParam( $_REQUEST, 'ad_picture17', '' ) );
$ad_picture18 = strval( mosGetParam( $_REQUEST, 'ad_picture18', '' ) );
$ad_picture19 = strval( mosGetParam( $_REQUEST, 'ad_picture19', '' ) );
$ad_picture20 = strval( mosGetParam( $_REQUEST, 'ad_picture20', '' ) );

$cb_image1    = strval( mosGetParam( $_REQUEST, 'cb_image1', '' ) );
$cb_image2    = strval( mosGetParam( $_REQUEST, 'cb_image2', '' ) );
$cb_image3    = strval( mosGetParam( $_REQUEST, 'cb_image3', '' ) );
$cb_image4    = strval( mosGetParam( $_REQUEST, 'cb_image4', '' ) );
$cb_image5    = strval( mosGetParam( $_REQUEST, 'cb_image5', '' ) );
$cb_image6    = strval( mosGetParam( $_REQUEST, 'cb_image6', '' ) );
$cb_image7    = strval( mosGetParam( $_REQUEST, 'cb_image7', '' ) );
$cb_image8    = strval( mosGetParam( $_REQUEST, 'cb_image8', '' ) );
$cb_image9    = strval( mosGetParam( $_REQUEST, 'cb_image9', '' ) );
$cb_image10   = strval( mosGetParam( $_REQUEST, 'cb_image10', '' ) );
$cb_image11   = strval( mosGetParam( $_REQUEST, 'cb_image11', '' ) );
$cb_image12   = strval( mosGetParam( $_REQUEST, 'cb_image12', '' ) );
$cb_image13   = strval( mosGetParam( $_REQUEST, 'cb_image13', '' ) );
$cb_image14   = strval( mosGetParam( $_REQUEST, 'cb_image14', '' ) );
$cb_image15   = strval( mosGetParam( $_REQUEST, 'cb_image15', '' ) );
$cb_image16   = strval( mosGetParam( $_REQUEST, 'cb_image16', '' ) );
$cb_image17   = strval( mosGetParam( $_REQUEST, 'cb_image17', '' ) );
$cb_image18   = strval( mosGetParam( $_REQUEST, 'cb_image18', '' ) );
$cb_image19   = strval( mosGetParam( $_REQUEST, 'cb_image19', '' ) );
$cb_image20   = strval( mosGetParam( $_REQUEST, 'cb_image20', '' ) );

$gflag        = intval( mosGetParam( $_REQUEST, 'gflag', '0' ) );

$ad_published 		= intval( mosGetParam( $_REQUEST, 'ad_published', '0' ) );
$ad_flag_top 		= intval( mosGetParam( $_REQUEST, 'ad_flag_top', '0' ) );
$ad_flag_featured 	= intval( mosGetParam( $_REQUEST, 'ad_flag_featured', '0' ) );
$ad_flag_commercial	= intval( mosGetParam( $_REQUEST, 'ad_flag_commercial', '0' ) );

$payment			= intval( mosGetParam( $_REQUEST, 'payment', '0' ) );


// escape strings for mysql
$name 			= mysql_escape_string( $name);
$surname 		= mysql_escape_string( $surname);
$street 		= mysql_escape_string( $street);
$zip 			= mysql_escape_string( $zip);
$city 			= mysql_escape_string( $city);
$state 			= mysql_escape_string( $state);
$country		= mysql_escape_string( $country);
$ad_headline 	= mysql_escape_string( $ad_headline);
$ad_text 	 	= mysql_escape_string( $ad_text);
$ad_condition 	= mysql_escape_string( $ad_condition);
$ad_price 	 	= mysql_escape_string( $ad_price);



// set page title
if( $adid == "") {
    $mainframe->SetPageTitle( JOO_TITLE." - " .JOO_AD_WRITE );
}
else {
    $mainframe->SetPageTitle( JOO_TITLE." - " .JOO_AD_EDIT );
}


// get marketplace configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();
$ad_default                       	= (int)$config[0]->ad_default;
$use_top                      		= (int)$config[0]->use_top;
$use_featured                      	= (int)$config[0]->use_featured;
$use_commercial                     = (int)$config[0]->use_commercial;
$use_surname                      	= (int)$config[0]->use_surname;
$use_street                       	= (int)$config[0]->use_street;
$use_zip                          	= (int)$config[0]->use_zip;
$use_city                         	= (int)$config[0]->use_city;
$use_state                        	= (int)$config[0]->use_state;
$use_country                      	= (int)$config[0]->use_country;
$use_web                          	= (int)$config[0]->use_web;
$use_phone1                       	= (int)$config[0]->use_phone1;
$use_phone2                       	= (int)$config[0]->use_phone2;
$use_condition                    	= (int)$config[0]->use_condition;
$use_price                        	= (int)$config[0]->use_price;
$rss_syndication                  	= (int)$config[0]->rss_syndication;
$emailFrom                        	= (string)$config[0]->email_from;
$emailFromName                    	= (string)$config[0]->email_from_name;
$use_admin_email_notification     	= (int)$config[0]->use_admin_email_notification;
$use_moderator_email_notification 	= (int)$config[0]->use_moderator_email_notification;
$notification_email_subject       	= (string)$config[0]->notification_email_subject;
$notification_email_text          	= (string)$config[0]->notification_email_text;
$use_paid_ads                    	= (int)$config[0]->use_paid_ads;
$paid_ads_currency          		= (string)$config[0]->paid_ads_currency;
$paid_ads_price_basic          		= (string)$config[0]->paid_ads_price_basic;
$paid_ads_price_top          		= (string)$config[0]->paid_ads_price_top;
$paid_ads_price_featured          	= (string)$config[0]->paid_ads_price_featured;
$paid_ads_price_commercial          = (string)$config[0]->paid_ads_price_commercial;
$use_paypal_testmode          		= (int)$config[0]->use_paypal_testmode;
$use_offline_payment          		= (int)$config[0]->use_offline_payment;
$offline_payment_text          		= (string)$config[0]->offline_payment_text;
$paypal_businessid          		= (string)$config[0]->paypal_businessid;
$use_paypal_payment          		= (int)$config[0]->use_paypal_payment;
$images_per_ad          			= (int)$config[0]->images_per_ad;


// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}


// get marketplace user data
$dateToday = date("Y-m-d");
$database->setQuery("SELECT * FROM #__marketplace_users WHERE userid = '$my->id' AND published = '1' AND date_begin <= curdate() AND date_end >= curdate() ORDER BY date_begin ASC, date_end ASC ");
$marketplace_users = $database->loadObjectList();
$marketplace_users_entry_count = count( $marketplace_users);

$marketplace_users_isAdmin          = (int)$marketplace_users[0]->isAdmin;
$marketplace_users_isModerator      = (int)$marketplace_users[0]->isModerator;
$marketplace_users_categories       = (string)$marketplace_users[0]->categories;
$marketplace_users_isBlocked        = (int)$marketplace_users[0]->isBlocked;
$marketplace_users_flagTop          = (int)$marketplace_users[0]->flag_top;
$marketplace_users_flagFeatured     = (int)$marketplace_users[0]->flag_featured;
$marketplace_users_flagCommercial   = (int)$marketplace_users[0]->flag_commercial;

// Paypal settings
$notify_url 						= sefRelToAbs( "index.php?option=com_marketplace&page=ipn");


function ad_image( $adid, $image, $itrail, $mosConfig_absolute_path, $af_info, $database, $images_per_ad) {

    $af_dir_ads = $mosConfig_absolute_path."/components/com_marketplace/images/entries/";

    // check imagesize
    $database->setQuery( "SELECT max_image_size FROM #__marketplace_config");
    $max_image_size = $database->loadResult();

    $image_too_big = 0;

	// loop over configured # of images and check size
	for ( $i = 1; $i <= $images_per_ad; $i += 1) {

        if (isset( $_FILES[$image]) ) {
        	if ( $_FILES[$image]['size'] > $max_image_size) {
            	//$image_too_big = 1;
				//begin resize
				//resize image begin
			{ 
        $af_size = GetImageSize ($_FILES[$image]['tmp_name'], $af_info);

        switch ($af_size[2]) {
                case 1 : {
                    $thispicext = 'gif';
                    break;
                }
                case 2 : {
                    $thispicext = 'jpg';
                    break;
                }
                case 3 : {
                    $thispicext = 'png';
                    break;
                }
        }


           if ( $af_size[2] >= 1 && $af_size[2] <= 3) { // GIF, JPG or PNG

        	//$pict_jpg = $_FILES[$image]['tmp_name'];
            
            chmod ( $_FILES[$image]['tmp_name'], 0644);

            // copy image
         //   move_uploaded_file ( $_FILES[$image]['tmp_name'], $af_dir_ads.$adid.$itrail.".".$thispicext);

            // create thumbnail
            switch ($af_size[2]) {
                case 1 : $src = ImageCreateFromGif( $_FILES[$image]['tmp_name']); break;
                case 2 : $src = ImageCreateFromJpeg( $_FILES[$image]['tmp_name']); break;
                case 3 : $src = ImageCreateFromPng( $_FILES[$image]['tmp_name']); break;
            }

            $width_before  = ImageSx( $src);
            $height_before = ImageSy( $src);

            if ( $width_before  >= $height_before) {
                $width_new = min(300, $width_before);
                $scale = $width_before / $height_before;
                $height_new = round( $width_new / $scale);
            }
            else {
                $height_new = min(200, $height_before);
                $scale = $height_before / $width_before;
                $width_new = round( $height_new / $scale);
            }

            $dst = ImageCreateTrueColor( $width_new, $height_new);

            // GD Lib 2
            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            // GD Lib 1
            //ImageCopyResized( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            switch ($af_size[2]) {
                case 1 : ImageGIF( $dst, $_FILES[$image]['tmp_name']); break; // or case 1 : ImageGIF( $dst, $af_dir_ads.$adid.$itrail.".".$thispicext); break; 
                case 2 : ImageJPEG( $dst, $_FILES[$image]['tmp_name']); break;
                case 3 : ImagePNG( $dst, $_FILES[$image]['tmp_name']); break;
            }

            imagedestroy( $dst);
            imagedestroy( $src);	
				//resise image end
				//end resize
        	}
        }

	}



    if ( $image_too_big == 1) {  // image is too big -> display message
        echo "<font color='#CC0000'>";
        echo JOO_IMAGETOOBIG;
        echo "</font>";
        echo "<br>";
        echo "<br>";
    }
    else { // images are ok
        $af_size = GetImageSize ($_FILES[$image]['tmp_name'], $af_info);

        switch ($af_size[2]) {
                case 1 : {
                    $thispicext = 'gif';
                    break;
                }
                case 2 : {
                    $thispicext = 'jpg';
                    break;
                }
                case 3 : {
                    $thispicext = 'png';
                    break;
                }
        }


        $isNewImage = 1;
        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.gif")) {
            $isNewImage = 0;
        }
        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.jpg")) {
            $isNewImage = 0;
        }
        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.png")) {
            $isNewImage = 0;
        }



        if ( $af_size[2] >= 1 && $af_size[2] <= 3) { // GIF, JPG or PNG

        	$pict_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.jpg";
            if ( file_exists( $pict_jpg)) {
            	unlink( $pict_jpg);
            }
            $pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail.".jpg";
            if ( file_exists( $pic_jpg)) {
                unlink( $pic_jpg);
            }


            $pict_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.png";
            if ( file_exists( $pict_png)) {
            	unlink( $pict_png);
            }
            $pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail.".png";
            if ( file_exists( $pic_png)) {
            	unlink( $pic_png);
            }


            $pict_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail."_t.gif";
            if ( file_exists( $pict_gif)) {
                unlink( $pict_gif);
            }
            $pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$itrail.".gif";
            if ( file_exists( $pic_gif)) {
                unlink( $pic_gif);
            }



            chmod ( $_FILES[$image]['tmp_name'], 0644);

            // copy image
            move_uploaded_file ( $_FILES[$image]['tmp_name'], $af_dir_ads.$adid.$itrail.".".$thispicext);

            // create thumbnail
            switch ($af_size[2]) {
                case 1 : $src = ImageCreateFromGif( $af_dir_ads.$adid.$itrail.".".$thispicext); break;
                case 2 : $src = ImageCreateFromJpeg( $af_dir_ads.$adid.$itrail.".".$thispicext); break;
                case 3 : $src = ImageCreateFromPng( $af_dir_ads.$adid.$itrail.".".$thispicext); break;
            }

            $width_before  = ImageSx( $src);
            $height_before = ImageSy( $src);

            if ( $width_before  >= $height_before) {
                $width_new = min(100, $width_before);
                $scale = $width_before / $height_before;
                $height_new = round( $width_new / $scale);
            }
            else {
                $height_new = min(75, $height_before);
                $scale = $height_before / $width_before;
                $width_new = round( $height_new / $scale);
            }

            $dst = ImageCreateTrueColor( $width_new, $height_new);

            // GD Lib 2
            ImageCopyResampled( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            // GD Lib 1
            //ImageCopyResized( $dst, $src, 0, 0, 0, 0, $width_new, $height_new, $width_before, $height_before);

            switch ($af_size[2]) {
                case 1 : ImageGIF( $dst, $af_dir_ads.$adid.$itrail."_t.".$thispicext); break;
                case 2 : ImageJPEG( $dst, $af_dir_ads.$adid.$itrail."_t.".$thispicext); break;
                case 3 : ImagePNG( $dst, $af_dir_ads.$adid.$itrail."_t.".$thispicext); break;
            }

            imagedestroy( $dst);
            imagedestroy( $src);


            // DB updaten
            if ( $isNewImage == 1) {
                $sql = "UPDATE #__marketplace_ads
                     SET ad_image = ad_image + 1, date_lastmodified = CURRENT_DATE()
                     WHERE id = $adid";
            }
            else { // isNewImage==0
                $sql = "UPDATE #__marketplace_ads
                     SET date_lastmodified = CURRENT_DATE()
                     WHERE id = $adid";
            }

            $database->setQuery( $sql);

            if ($database->getErrorNum()) {
                echo $database->stderr();
            } else {
                $database->query();
            }


        }
    }
}



echo "<table width='100%'>";
echo "<tr>";
echo "<td align='left'>";

include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');
// -------------------------------------------------------------------------------

$username=$my->username;
$userid=$my->id;
if ($username == ''){$username = 'Гость';}
if ($userid == '0'){$userid = '67';}


$afNameClass 		= "marketplace_required";
$afEmailClass 		= "marketplace_required";
$afHeadlineClass 	= "marketplace_required";
$afTextClass 		= "marketplace_required";


if ($userid == "0") {
    echo "<br>";
    echo "<br>";

    echo "<table cellspacing=\"10\" cellpadding=\"5\">";
    echo "<tr>";
    echo "<td width=\"20\">";
    echo "&nbsp;";
    echo "</td>";
    echo "<td>";
    echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/warning.gif\" border=\"0\" align=\"center\">";
    echo "</td>";
    echo "<td>";
    echo JOO_ADD_NOTALLOWED;
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}
else {  // user is logged in
if ( $payment == 0) { // no payment set
    if ( $marketplace_users_entry_count > 0 && $marketplace_users_isBlocked == 1) {
            echo JOO_ACCOUNT_IS_BLOCKED;
    }
    else {  // user has no entry in users table or has one and is not blocked

    /* input validation */
	if ($email ==''){$email = 'nomail@noemail.no';}
	if ($name ==''){$name = 'user';}
	if ($ad_headline ==''){$ad_headline = 'Foto AD';}
	if ($ad_text ==''){$ad_text = 'Foto AD';}
	
    if( $mode == "db") {
        $bInputFields = 0;

        if ( strlen ( $name) < 3) {
            $bInputFields = 1;
            $afNameClass = "marketplace_error";
        }
        if ( strlen ( $email) < 7) {
            $bInputFields = 1;
            $afEmailClass = "marketplace_error";
        }
       // if ( strlen ( $ad_headline) < 5) {
       //     $bInputFields = 1;
       //     $afHeadlineClass = "marketplace_error";
       // }
       // if ( strlen ( $ad_text) < 5) {
       //     $bInputFields = 1;
       //     $afTextClass = "marketplace_error";
       // }
    }



    if( $mode == "db" && $bInputFields == 0) {

        // get all keywords with action "block"
        $block_ad = 0;
        $database->setQuery("SELECT keyword, infotext FROM #__marketplace_keywords WHERE action='3' AND published = '1' ORDER BY keyword ASC ");
        $block_keywords = $database->loadObjectList();

        $test_adtext = strtolower( $ad_headline.$ad_text);

        foreach ( $block_keywords as $block_keyword ) {

            $test_keyword = strtolower( $block_keyword->keyword);

            if ( strpos( $test_adtext, $test_keyword) === false) {
                // do nothing
            }
            else {
                $block_ad = 1;
                echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                    echo "<tr>";
                        echo "<td width=\"20\">";
                            echo "&nbsp;";
                        echo "</td>";
                        echo "<td>";
                            echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/error.gif\" border=\"0\" align=\"center\">";
                        echo "</td>";
                        echo "<td>";
                            echo $block_keyword->infotext;
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            }

        }


        if ( $block_ad == 0) {  // block this ad when keyword with action "block" is found in the ad text

        if( $isUpdateMode) { // update
            $sql    = "UPDATE #__marketplace_ads
								 SET category          = '$category',
									 name              = '$name',
									 surname           = '$surname',
									 street            = '$street',
									 zip               = '$zip',
									 city              = '$city',
									 state             = '$state',
									 country           = '$country',
									 phone1            = '$phone1',
									 phone2            = '$phone2',
									 email             = '$email',
									 web               = '$web',
									 ad_type           = '$ad_type',
									 ad_headline       = '$ad_headline',
									 ad_text           = '$ad_text',
									 ad_condition      = '$ad_condition',
									 ad_price          = '$ad_price',
									 published         = '$ad_published',
									 flag_featured	   = '$ad_flag_featured',
									 flag_top	   	   = '$ad_flag_top',
									 flag_commercial   = '$ad_flag_commercial',
									 date_lastmodified = CURRENT_DATE()
								 WHERE id = $adid
							  ";

            $database->setQuery( $sql);

            if ($database->getErrorNum()) {
                echo $database->stderr();
            } else {
                $database->query();
            }



			for ( $i = 1; $i <= $images_per_ad; $i += 1) {
				$c = chr( 96 + $i);
				$cbi = "cb_image".$i;

            	if ( $$cbi == "delete") {
                	$pict_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c."_t.jpg";
                	if ( file_exists( $pict_jpg)) {
                    	unlink( $pict_jpg);
                	}
                	$pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c.".jpg";
                	if ( file_exists( $pic_jpg)) {
                    	unlink( $pic_jpg);
                	}

                	$pict_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c."_t.png";
                	if ( file_exists( $pict_png)) {
                    	unlink( $pict_png);
                	}
                	$pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c.".png";
                	if ( file_exists( $pic_png)) {
                    	unlink( $pic_png);
                	}

                	$pict_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c."_t.gif";
                	if ( file_exists( $pict_gif)) {
                    	unlink( $pict_gif);
                	}
                	$pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c.".gif";
                	if ( file_exists( $pic_gif)) {
                    	unlink( $pic_gif);
                	}

                	$sql = "UPDATE #__marketplace_ads
                     			SET ad_image = ad_image - 1, date_lastmodified = CURRENT_DATE()
                     			WHERE id = $adid";

                	$database->setQuery( $sql);

                	if ($database->getErrorNum()) {
                    	echo $database->stderr();
                	} else {
                    	$database->query();
                	}
            	}

			}



			// loop over configured # of images
			for ( $i = 1; $i <= $images_per_ad; $i += 1) {
				$c = chr( 96 + $i);
				$adpic = "ad_picture".$i;

            	// image upload
            	if (isset( $_FILES[$adpic]) and !$_FILES[$adpic]['error'] ) {
                	ad_image( $adid, $adpic, $c, $mosConfig_absolute_path, $af_info, $database, $images_per_ad);
            	}
			}


        }
        else { // insert

        	// get marketplace category settings
			$database->setQuery("SELECT * FROM #__marketplace_categories WHERE id='".$category."'");
			$category_config = $database->loadObjectList();
			$category_use_paid_ads								= (int)$category_config[0]->use_paid_ads;
			$category_overwrite_paid_ads_price_basic			= (int)$category_config[0]->overwrite_paid_ads_price_basic;
			$category_paid_ads_price_basic						= (string)$category_config[0]->paid_ads_price_basic;
			$category_overwrite_paid_ads_price_top				= (int)$category_config[0]->overwrite_paid_ads_price_top;
			$category_paid_ads_price_top						= (string)$category_config[0]->paid_ads_price_top;
			$category_overwrite_paid_ads_price_featured			= (int)$category_config[0]->overwrite_paid_ads_price_featured;
			$category_paid_ads_price_feaured					= (string)$category_config[0]->paid_ads_price_featured;
			$category_overwrite_paid_ads_price_commercial		= (int)$category_config[0]->overwrite_paid_ads_price_commercial;
			$category_paid_ads_price_commercial					= (string)$category_config[0]->paid_ads_price_commercial;
			$category_ad_default								= (int)$category_config[0]->ad_default;


			// start overwriting

			switch ( (int)$category_ad_default) {
				case 0: { // do not publish in this category
					$ad_default = 0;
					break;
				}
				case 1: { // publish ad immediatly
					$ad_default = 1;
					break;
				}
				default : { // use global setting from configuration tab -> overwrite nothing
					break;
				}
			}


			switch ( (int)$category_use_paid_ads) {

				case 0: { // no paid ads -> this category has free ads, no matter what is configured global
					$use_paid_ads = 0;
					break;
				}

				case 1: { // paid ads -> this category has paid ads, no matter what is configured global
					$use_paid_ads = 1;

					// now check if we have to overwrite the prices

					// basic price
					if ( (int)$category_overwrite_paid_ads_price_basic == 1) { // overwrite basic price
						$paid_ads_price_basic = $category_paid_ads_price_basic;
					}

					// top price
					if ( (int)$category_overwrite_paid_ads_price_top == 1) { // overwrite top price
						$paid_ads_price_top = $category_paid_ads_price_top;
					}

					// featured price
					if ( (int)$category_overwrite_paid_ads_price_featured == 1) { // overwrite featured price
						$paid_ads_price_featured = $category_paid_ads_price_featured;
					}

					// commercial price
					if ( (int)$category_overwrite_paid_ads_price_commercial == 1) { // overwrite commercial price
						$paid_ads_price_commercial = $category_paid_ads_price_commercial;
					}

					break;
				}

				default : { // use global setting from configuration tab -> overwrite nothing
					break;
				}

			}


            $flagTop = $ad_flag_top;
            $flagFeatured = $ad_flag_featured;
            $flagCommercial = $ad_flag_commercial;

            if ( $marketplace_users_entry_count > 0 && $marketplace_users_flagTop == 1) {
                $flagTop = 1;
            }
            if ( $marketplace_users_entry_count > 0 && $marketplace_users_flagFeatured == 1) {
                $flagFeatured = 1;
            }
            if ( $marketplace_users_entry_count > 0 && $marketplace_users_flagCommercial == 1) {
                $flagCommercial = 1;
            }



            // get all keywords with action "warning"
            $database->setQuery("SELECT keyword, infotext FROM #__marketplace_keywords WHERE action='2' AND published = '1' ORDER BY keyword ASC ");
            $warning_keywords = $database->loadObjectList();

            $isWarningLevel = 0;
            foreach ( $warning_keywords as $warning_keyword ) {

                $test_keyword = strtolower( $warning_keyword->keyword);

                if ( strpos( $test_adtext, $test_keyword) === false) {
                    $isWarningLevel = 0;
                }
                else {
                    $isWarningLevel = 1;
                    echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                        echo "<tr>";
                            echo "<td width=\"20\">";
                                echo "&nbsp;";
                            echo "</td>";
                            echo "<td>";
                                echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/warning.gif\" border=\"0\" align=\"center\">";
                            echo "</td>";
                            echo "<td>";
                                echo $warning_keyword->infotext;
                            echo "</td>";
                        echo "</tr>";
                    echo "</table>";
                }

            }

            // todo overwrite publishAd or ad_default ?!

            if( $isWarningLevel == 0) {
                $publishAd = $ad_default;
            }
            else {
                $publishAd = 0;
            }

            // 1. insert ad

            $sql = "INSERT INTO #__marketplace_ads (
						category, userid, user, name, surname, street, zip, city, state, country, phone1, phone2, email, web,
						ad_type, ad_headline, ad_text, ad_condition, ad_price, date_created, date_lastmodified,
						flag_featured, flag_top, flag_commercial, published
						)
						VALUES (
						'$category', '$userid', '$username', '$name', '$surname', '$street', '$zip', '$city', '$state', '$country',
						'$phone1', '$phone2', '$email', '$web', '$ad_type', '$ad_headline', '$ad_text',
						'$ad_condition', '$ad_price', CURRENT_DATE(), CURRENT_DATE(),
						'$flagFeatured', '$flagTop', '$flagCommercial', '$publishAd'
						)";

            $database->setQuery( $sql);

            if ($database->getErrorNum()) {
                echo $database->stderr();
            } else {
                $database->query();
            }


            //$adid = mysql_insert_id();
		    $database->setQuery( "SELECT LAST_INSERT_ID() from #__marketplace_ads");
		    $adid = $database->loadResult();



			// loop over configured # of images
			for ( $i = 1; $i <= $images_per_ad; $i += 1) {
				$c = chr( 96 + $i);
				$adpic = "ad_picture".$i;

            	// image upload
            	if (isset( $_FILES[$adpic]) and !$_FILES[$adpic]['error'] ) {
                	ad_image( $adid, $adpic, $c, $mosConfig_absolute_path, $af_info, $database, $images_per_ad);
            	}
			}


        }



        // get all keywords with action "information"
        $database->setQuery("SELECT keyword, infotext FROM #__marketplace_keywords WHERE action='1' AND published = '1' ORDER BY keyword ASC ");
        $information_keywords = $database->loadObjectList();

        foreach ( $information_keywords as $information_keyword ) {

            $test_keyword = strtolower( $information_keyword->keyword);

            if ( strpos( $test_adtext, $test_keyword) === false) {
                // do nothing
            }
            else {
                echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                    echo "<tr>";
                        echo "<td width=\"20\">";
                            echo "&nbsp;";
                        echo "</td>";
                        echo "<td>";
                            echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/information.gif\" border=\"0\" align=\"center\">";
                        echo "</td>";
                        echo "<td>";
                            echo $information_keyword->infotext;
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            }

        }



        echo "<table cellspacing='10' cellpadding='5' border='0'>";
            echo "<tr>";
                echo "<td width='20'>";
                    echo "&nbsp;";
                echo "</td>";
                echo "<td>";
                	if ( $use_paid_ads == 0 || $isUpdateMode) {
                    	echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/success.gif\" border=\"0\" align=\"center\">";
                	}
                echo "</td>";
                echo "<td>";

                    if( $isUpdateMode) { // update
                        echo JOO_UPDATE_SUCCESSFULL;
                    }
                    else { // insert

                    // notification email
                    $dateToday = date("Y-m-d");
                    $linkToAd = sefRelToAbs( "index.php?option=com_marketplace&page=show_ad&catid=$category&adid=$adid&Itemid=$Itemid");

                    // admins
                    if ( $use_admin_email_notification == 1) {

                        $adminEmailSubject = $notification_email_subject;
                        $adminEmailText    = str_replace("[LINK_TO_AD]", $linkToAd, $notification_email_text);

                        // get all admins
                        $database->setQuery("SELECT DISTINCT a.userid, b.email FROM #__marketplace_users a, #__users b WHERE a.isAdmin = '1' AND a.published = '1' AND a.date_begin <= curdate() AND a.date_end >= curdate() AND a.userid = b.id AND b.block='0' ORDER BY a.date_begin ASC, a.date_end ASC ");
                        $admins = $database->loadObjectList();

                        foreach ( $admins as $admin ) {

                            // send email to admin
                            mosMail( $emailFrom, $emailFromName, $admin->email, $adminEmailSubject, $adminEmailText);

                        }

                    }


                    // moderators
                    if ( $use_moderator_email_notification == 1) {

                        $moderatorEmailSubject = $notification_email_subject;
                        $moderatorEmailText    = str_replace("[LINK_TO_AD]", $linkToAd, $notification_email_text);

                        // get all moderators
                        $database->setQuery("SELECT DISTINCT a.userid, a.categories, b.email FROM #__marketplace_users a, #__users b WHERE a.isModerator = '1' AND a.published = '1' AND a.date_begin <= curdate() AND a.date_end >= curdate() AND a.userid = b.id AND b.block='0' ORDER BY a.date_begin ASC, a.date_end ASC ");
                        $moderators = $database->loadObjectList();

                        foreach ( $moderators as $moderator ) {

                            $modcats = explode( ',', $moderator->categories );
                            $iSendMail = 0;

                            // check if moderator moderates this category
			                foreach( $modcats as $modcat ) {
			                     if ( $modcat == $category) {
			                         $iSendMail = 1;
			                     }
			                }

                            if ( $iSendMail == 1) {
                                // send email to moderator
                                mosMail( $emailFrom, $emailFromName, $moderator->email, $moderatorEmailSubject, $moderatorEmailText);
                            }

                        }

                    }


					if ( $use_paid_ads == 0) {
                    	if ( $isWarningLevel == 0) {
                        	echo JOO_INSERT_SUCCESSFULL;
                    	}
                    	else {
                        	echo JOO_AD_REQUIRES_APPROVAL;
                    	}
					}

                }
                echo "</td>";
            echo "</tr>";


            if ( $use_paid_ads == 1 && $isUpdateMode == 0) {


            	// calculate costs for ad
            	echo "<tr>";
                	echo "<td>";
                    	echo "&nbsp;";
                	echo "</td>";
                	echo "<td colspan='2'>";

                        echo "<table border='0'>";
                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                        			echo JOO_COMPLETE_PAYMENT;
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                					echo "&nbsp;";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                					echo "<b>".$ad_headline."</b>";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                					echo "&nbsp;";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td width='30%' colspan='1'>";
									echo JOO_PRICE_BASIC_TEXT;
                        		echo "</td>";
                        		echo "<td width='70%' colspan='1'>";
									echo number_format( $paid_ads_price_basic,2)." ".$paid_ads_currency;
									$paid_ads_price_total = $paid_ads_price_basic; // at least basic price
                        		echo "</td>";
                        	echo "</tr>";

                        	if ( $ad_flag_top == 1) { // top set
                        		echo "<tr>";
                        			echo "<td colspan='1'>";
										echo JOO_PRICE_TOP_TEXT;
                        			echo "</td>";
                        			echo "<td colspan='1'>";
										echo number_format( $paid_ads_price_top,2)." ".$paid_ads_currency;
										$paid_ads_price_total += $paid_ads_price_top;
                        			echo "</td>";
                        		echo "</tr>";
                        	}

                        	if ( $ad_flag_featured == 1) { // featured set
                        		echo "<tr>";
                        			echo "<td colspan='1'>";
										echo JOO_PRICE_FEATURED_TEXT;
                        			echo "</td>";
                        			echo "<td colspan='1'>";
										echo number_format( $paid_ads_price_featured,2)." ".$paid_ads_currency;
										$paid_ads_price_total += $paid_ads_price_featured;
                        			echo "</td>";
                        		echo "</tr>";
                        	}

                        	if ( $ad_flag_commercial == 1) { // commercial set
                        		echo "<tr>";
                        			echo "<td colspan='1'>";
                        				echo JOO_PRICE_COMMERCIAL_TEXT;
                        			echo "</td>";
                        			echo "<td colspan='1'>";
										echo number_format( $paid_ads_price_commercial,2)." ".$paid_ads_currency;
										$paid_ads_price_total += $paid_ads_price_commercial;
                        			echo "</td>";
                        		echo "</tr>";
                        	}

                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                					echo "&nbsp;";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td colspan='1'>";
                        			echo JOO_PRICE_TOTAL_TEXT;
                        		echo "</td>";
                        		echo "<td colspan='1'>";
									echo "<b>".number_format($paid_ads_price_total,2)." ".$paid_ads_currency." ";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "<tr>";
                        		echo "<td colspan='2'>";
                					echo "&nbsp;";
                        		echo "</td>";
                        	echo "</tr>";

                        	echo "</table>";


                	echo "</td>";
            	echo "</tr>";


				if ( number_format($paid_ads_price_total,2) == "0.00") {
            		echo "<tr>";
                        echo "<td colspan='1'>";
                			echo "&nbsp;";
                        echo "</td>";

                		echo "<td colspan='2'>";
							echo "Thank you, your ad has been added to our database";
                		echo "</td>";
            		echo "</tr>";
				}
				else {

            	if ( $use_offline_payment == 1) { // offline / bank transfer
            		echo "<tr>";
                		echo "<td>";
                    		echo "&nbsp;";
                		echo "</td>";
                		echo "<td>";
       						?>

							<form action="#" method="post">
   								<input type="hidden" name="payment" value="1">
   								<input type="hidden" name="adid" value="<?php echo $adid; ?>">
								<input class="button" type="submit" name="submit" value="<?php echo JOO_FORM_SUBMIT_OFFLINE_TEXT; ?>">
							</form>

  							<?php
                		echo "</td>";
                		echo "<td>";
                    		echo "You will be asked to pay the ad via Bank Transfer. The new ad will stay in a 'pending' status until the money is transfered. Then the new ad is being published.";
                		echo "</td>";
            		echo "</tr>";
            	}


            	if ( $use_paypal_payment == 1) { // PayPal
            		echo "<tr>";
                		echo "<td>";
                    		echo "&nbsp;";
                		echo "</td>";
                		echo "<td>";

                			if ( $use_paypal_testmode == 1) { // use PayPal Sandbox
       							?>
								<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  								<?php
                			}
  							else {
  								?>
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<?php
  							}
							?>

   									<input type="hidden" name="cmd" value="_xclick">
   									<input type="hidden" name="business" value="<?php echo $paypal_businessid; ?>">
   									<input type="hidden" name="item_number" value="<?php echo $adid; ?>">
   									<input type="hidden" name="item_name" value="<?php echo $ad_headline; ?>">
   									<input type="hidden" name="amount" value="<?php echo $paid_ads_price_total; ?>">
   									<input type="hidden" name="no_shipping" value="1">
   									<input type="hidden" name="no_note" value="1">
   									<input type="hidden" name="currency_code" value="<?php echo $paid_ads_currency; ?>">
   									<input type="hidden" name="bn" value="">
   									<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>">
									<input class="button" type="submit" name="submit" value="<?php echo JOO_FORM_SUBMIT_PAYPAL_TEXT; ?>">
								</form>
								<?php
                		echo "</td>";
                		echo "<td>";
                    		echo "You will be directed to the PayPal website to make your payment. After you made the payment, the new ad is being published automatically usually within minutes.";
                		echo "</td>";
            		echo "</tr>";
            	}

				} // total

            }


        echo "</table>";


        }
        else {  // this ad is blocked

            echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                echo "<tr>";
                    echo "<td width=\"20\">";
                        echo "&nbsp;";
                    echo "</td>";
                    echo "<td>";
                        echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/error.gif\" border=\"0\" align=\"center\">";
                    echo "</td>";
                    echo "<td>";
                        echo "<b>";
                        echo JOO_AD_IS_BLOCKED;
                        echo "</b>";
                    echo "</td>";
                echo "</tr>";
            echo "</table>";

        }
        // end block keyword


    } // mode db && bInputfields==0
    else {

        if( $adid > 0) { // edit ad



            // 1. get data
            $database->setQuery("SELECT * FROM #__marketplace_ads WHERE id=$adid");
            $row = $database->loadObjectList();
            $ad_id          	= $row[0]->id;
            $ad_category    	= $row[0]->category;
            $ad_user        	= $row[0]->user;
            $ad_userid      	= $row[0]->userid;
            $ad_name        	= $row[0]->name;
            $ad_surname    		= $row[0]->surname;
            $ad_street      	= $row[0]->street;
            $ad_zip         	= $row[0]->zip;
            $ad_city        	= $row[0]->city;
            $ad_state       	= $row[0]->state;
            $ad_country     	= $row[0]->country;
            $ad_phone1      	= $row[0]->phone1;
            $ad_phone2      	= $row[0]->phone2;
            $ad_email       	= $row[0]->email;
            $ad_web         	= $row[0]->web;
            $ad_type        	= $row[0]->ad_type;
            $ad_headline    	= $row[0]->ad_headline;
            $ad_text        	= $row[0]->ad_text;
            $ad_condition   	= $row[0]->ad_condition;
            $ad_price       	= $row[0]->ad_price;
            $ad_published   	= $row[0]->published;
            $ad_flag_featured	= $row[0]->flag_featured;
            $ad_flag_top		= $row[0]->flag_top;
            $ad_flag_commercial	= $row[0]->flag_commercial;


            $bAdminMode = false; // defined start value
            if ( $marketplace_users_isAdmin == 1) {
                $bAdminMode = true;
            }

            $bModeratorMode = false; // defined start value
            if ( $marketplace_users_isModerator == 1) {
                $token = strtok( $marketplace_users_categories, ',');
                while( $token){
                    if ( $token == $ad_category) {
                        $bModeratorMode = true;
                    }
                    $token = strtok( ',');
                }
            }

            if( $my->id == $ad_userid  || $bAdminMode == true  || $bModeratorMode == true) { // owner or admin or moderator of this category
                $isUpdateMode = 1;
            }
            else {
                $isUpdateMode = 0;
            }

        }
        else { // insert
            $isUpdateMode = 0;
        }


        echo "<br>";
        echo "<br>";


        echo "<table class=\"marketplace_header\">";
        echo "<tr>";
        echo "<td class=\"marketplace_header\" id=\"writead_header1\">";
        echo "&nbsp;";
        echo "</td>";
        echo "<td>";
        echo "&nbsp;".JOO_HEADER1."&nbsp;&nbsp;&nbsp;";
        echo "</td>";

        if ( $bInputFields == 1) { // errorhandling
            echo "<td class=\"marketplace_header\" id=\"writead_header3\">";
            echo "&nbsp;";
            echo "</td>";
            echo "<td>";
            echo "&nbsp;".JOO_HEADER3."&nbsp;&nbsp;&nbsp;";
            echo "</td>";
        }

        echo "<td class=\"marketplace_header\" id=\"writead_header2\">";
        echo "&nbsp;";
        echo "</td>";
        echo "<td>";
        echo "&nbsp;".JOO_HEADER2."&nbsp;&nbsp;&nbsp;";
        echo "</td>";
        echo "</tr>";
        echo "</table>";


        echo "<br>";
        echo "<br>";



        if ( $bInputFields == 1) { // errorhandling
            $ad_name  		= $name;
            $ad_email 		= $email;
            $ad_headline 	= $ad_headline;
            $ad_text 		= $ad_text;
            //$ad_phone1 		= $phone1;
            $ad_type 		= $ad_type;
            $ad_category 	= $category;

        }

	?>


	<fieldset class="marketplace">

        <!-- titel -->
		<legend class="marketplace">
		<?php
		if( $isUpdateMode) {
		    echo JOO_AD_EDIT;
		}
		else {
		    echo JOO_AD_WRITE;
		}
		 ?>
		</legend>
        <!-- titel -->



    <!-- form -->
    <?php
    $action = sefRelToAbs( "index.php?option=com_marketplace&page=write_ad&Itemid=".$Itemid);
    ?>

    <form class="marketplace" action="<?php echo $action;?>" method="post" name="write_ad" enctype="multipart/form-data">

			<?php
			if ( $isUpdateMode != 1 && $bInputFields != 1) {
				// get user data and preset name and email field in form
				$database->setQuery("SELECT name, email FROM #__users WHERE id='$my->id' ");
				$dbu = $database->loadObjectList();

				$sDbName    = $dbu[0]->name;
				$sDbEmail   = $dbu[0]->email;
			}
    		?>

			<br />

			<!-- published -->
			<?php
			if( $bAdminMode == true  || $bModeratorMode == true) { // admin or moderator
				?>

				<label class="marketplace" for="published"><?php echo JOO_PUBLISHED; ?></label>
				<?php
                echo "<select class='marketplace' id='ad_published' name='ad_published'>";
                	if( $ad_published == 1) {
                    	echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    }
                    else {
                        echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    }
		        echo "</select>";
		        echo "<br />";
		        echo "<br />";
			}
			else {
				echo "<input type='hidden' name='ad_published' value='$ad_published'>";
			}
			?>
			<!-- published -->




			<!-- name -->
				<label class="marketplace" for="name"><?php echo JOO_FORM_NAME; ?></label>
				<?php
				if ( $isUpdateMode == 1 || $bInputFields == 1) {
				    echo "<input class='".$afNameClass."' id='name' type='text' name='name' value='$ad_name' >";
				}
				else {
				    echo "<input class='".$afNameClass."' id='name' type='text' name='name' value='$sDbName' >";
				}
				?>
				<label class="marketplace_right" for="name"><?php echo JOO_FORM_NAME_TEXT; ?></label>
			<!-- name -->


			<!-- surname -->
			<?php
			if ($use_surname) {
	        ?>
			<br />
				<label class="marketplace" for="surname"><?php echo JOO_FORM_SURNAME; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='surname' type='text' name='surname' value='$ad_surname'>";
				}
				else {
				    echo "<input class='marketplace' id='surname' type='text' name='surname'>";
				}
				?>
				<label class="marketplace_right" for="surname"><?php echo JOO_FORM_SURNAME_TEXT; ?></label>
	         <?php
			}
	         ?>
			<!-- surname -->


			<!-- street -->
			<?php
			if ($use_street) {
	        ?>
			<br />
				<label class="marketplace" for="street"><?php echo JOO_FORM_STREET; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='street' type='text' name='street' value='$ad_street'>";
				}
				else {
				    echo "<input class='marketplace' id='street' type='text' name='street'>";
				}
				?>
				<label class="marketplace_right" for="street"><?php echo JOO_FORM_STREET_TEXT; ?></label>
	         <?php
			}
	         ?>
			<!-- street -->


			<!-- zip -->
			<?php
			if ($use_zip) {
	        ?>
			<br />
				<label class="marketplace" for="zip"><?php echo JOO_FORM_ZIP; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='zip' type='text' name='zip' maxlength='10' value='$ad_zip'>";
				}
				else {
				    echo "<input class='marketplace' id='zip' type='text' name='zip' maxlength='10'>";
				}
				?>
				<label class="marketplace_right" for="zip"><?php echo JOO_FORM_ZIP_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- zip -->


			<!-- city -->
			<?php
			if ($use_city) {
	        ?>
			<br />
				<label class="marketplace" for="city"><?php echo JOO_FORM_CITY; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='city' type='text' name='city' value='$ad_city'>";
				}
				else {
				    echo "<input class='marketplace' id='city' type='text' name='city'>";
				}
				?>
				<label class="marketplace_right" for="city"><?php echo JOO_FORM_CITY_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- city -->


			<!-- state -->
			<?php
			if ($use_state) {
	        ?>
			<br />
				<label class="marketplace" for="state"><?php echo JOO_FORM_STATE; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='state' type='text' name='state' value='$ad_state'>";
				}
				else {
				    echo "<input class='marketplace' id='state' type='text' name='state'>";
				}
				?>
				<label class="marketplace_right" for="state"><?php echo JOO_FORM_STATE_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- state -->


			<!-- country -->
			<?php
			if ($use_country) {
	        ?>
			<br />
				<label class="marketplace" for="country"><?php echo JOO_FORM_COUNTRY; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='country' type='text' name='country' value='$ad_country'>";
				}
				else {
				    echo "<input class='marketplace' id='country' type='text' name='country'>";
				}
				?>
				<label class="marketplace_right" for="country"><?php echo JOO_FORM_COUNTRY_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- country -->



			<br />
			<!-- email -->
<label class="marketplace" for="email"><?php echo JOO_FORM_EMAIL; ?></label>
<?php
if ($sDbEmail ==''){$sDbEmail = 'nomail@noemail.no';}
if ($isUpdateMode || $bInputFields == 1) {
echo "<input class='".$afEmailClass."' id='email' type='text' name='email' maxlength='50' value='$ad_email'>";
}
else {
echo "<input class='".$afEmailClass."' id='email' type='text' name='email' maxlength='50' value='$sDbEmail' >";
}
?>
<label class="marketplace_right" for="email"><?php echo JOO_FORM_EMAIL_TEXT; ?></label>
<!-- email -->


			<!-- Web -->
			<?php
			if ($use_web) {
	        ?>
			<br />
				<label class="marketplace" for="web"><?php echo JOO_FORM_WEB; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='web' type='text' name='web' value='$ad_web'>";
				}
				else {
				    echo "<input class='marketplace' id='web' type='text' name='web'>";
				}
				?>
				<label class="marketplace_right" for="web"><?php echo JOO_FORM_WEB_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- Web -->


			<!-- phone1 -->
			<?php
			if ($use_phone1) {
	        ?>
			<br />
				<label class="marketplace" for="phone1"><?php echo JOO_FORM_PHONE1; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='phone1' type='text' name='phone1' maxlength='50' value='$ad_phone1'>";
				}
				else {
				    echo "<input class='marketplace' id='phone1' type='text' name='phone1' maxlength='50'>";
				}
				?>
				<label class="marketplace_right" for="phone1"><?php echo JOO_FORM_PHONE1_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- phone1 -->


			<!-- phone2 -->
			<?php
			if ($use_phone2) {
	        ?>
			<br />
				<label class="marketplace" for="phone2"><?php echo JOO_FORM_PHONE2; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='phone2' type='text' name='phone2' maxlength='50' value='$ad_phone2'>";
				}
				else {
				    echo "<input class='marketplace' id='phone2' type='text' name='phone2' maxlength='50'>";
				}
				?>
				<label class="marketplace_right" for="phone2"><?php echo JOO_FORM_PHONE2_TEXT; ?></label>
	         <?php
			}
	         ?>
			 <!-- phone2 -->


			<br />
			<br />
			<br />
			<!-- category -->
				<label class="marketplace" for="ad_type"><?php echo JOO_FORM_CATEGORY; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {

                    // get ad types
                    $database->setQuery("SELECT id, name FROM #__marketplace_types WHERE published='1' ORDER BY sort_order");
                    $rows_type = $database->loadObjectList();

                    echo "<select class='marketplace' id='ad_type' name='ad_type'>";
                        foreach( $rows_type as $rowtype) {
                            if( $rowtype->id == $ad_type) {
                                echo "<option value='$rowtype->id' selected>$rowtype->name</option>";
                            }
                            else {
                                echo "<option value='$rowtype->id'>$rowtype->name</option>";
                            }
                        }
		            echo "</select>";

				    $database->setQuery("SELECT id, parent, name FROM #__marketplace_categories WHERE has_entries > 0 ORDER BY parent ASC, sort_order ASC");
				    $rows = $database->loadObjectList();

				    echo "<select class='marketplace' name='category'>";

				    $OptGroup = 0; // Preset Optgroup
				    foreach($rows as $row) {

				    	if ( $row->parent != 0 AND $row->parent != $OptGroup) {
							// get container name
							$database->setQuery("SELECT name FROM #__marketplace_categories WHERE id='".$row->parent."' AND published='1' LIMIT 1");
							$container = $database->loadObjectList();
							$container_name = $container[0]->name;
				            echo "<optgroup label='".$container_name."'>";
				    	}

				        if ( $row->id == $ad_category) {
				            echo "<option value='".$row->id."' selected>".$row->name;
				        }
				        else {
				            echo "<option value='".$row->id."'>".$row->name;
				        }

				        if ( $row->parent != 0 AND $row->parent != $OptGroup) {
				            $OptGroup = $row->parent;
				            echo "</optgroup>";
				    	}
				    }

				    echo "</select>";

				} // isUpdateMode (insert)
				else {

                    // get ad types
                    $database->setQuery("SELECT id, name FROM #__marketplace_types WHERE published='1' ORDER BY sort_order");
                    $rows_type = $database->loadObjectList();

                    echo "<select class='marketplace' id='ad_type' name='ad_type'>";
                        foreach( $rows_type as $rowtype) {
                            echo "<option value='$rowtype->id'>$rowtype->name</option>";
                        }
		            echo "</select>";

				    echo "&nbsp;&nbsp;&nbsp;";


				    $database->setQuery("SELECT id, parent, name FROM #__marketplace_categories WHERE published='1' AND has_entries>'0' ORDER BY parent ASC, sort_order ASC");
				    $rows = $database->loadObjectList();

				    echo "<select class='marketplace' name='category'>";

				    $afCounter=0;
				    $OptGroup = 0; // Preset Optgroup
				    foreach($rows as $row) {

				    	if ( $row->parent != 0 AND $row->parent != $OptGroup) {
							// get container name
							$database->setQuery("SELECT name FROM #__marketplace_categories WHERE id='".$row->parent."' AND published='1' LIMIT 1");
							$container = $database->loadObjectList();
							$container_name = $container[0]->name;
				            echo "<optgroup label='".$container_name."'>";
				    	}


				        if ( $afCounter==0) {
				            echo "<option value='".$row->id."' selected>".$row->name;
				        }
				        else {
				            echo "<option value='".$row->id."'>".$row->name;
				        }
				        $afCounter++;


				    	if ( $row->parent != 0 AND $row->parent != $OptGroup) {
				            $OptGroup = $row->parent;
				            echo "</optgroup>";
				    	}



				    }
				    echo "</select>";




				}
				?>
			<!-- category -->


			<br />
			<br />


			<!-- ad headline -->
				<label class="marketplace" for="ad_headline"><?php echo JOO_FORM_AD_HEADLINE; ?></label>
				<?php
					if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='".$afHeadlineClass."' id='ad_headline' type='text' name='ad_headline' maxlength='80' value='".htmlspecialchars($ad_headline, ENT_QUOTES)."'>";
				}
				else {
				    echo "<input class='".$afHeadlineClass."' id='ad_headline' type='text' name='ad_headline' maxlength='80' value='Foto'>";
				}
				?>
				
			<!-- ad headline -->



			<br />
			<!-- ad text -->
				
				<?php 
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<label class='".$afTextClass."' id='ad_text' name='ad_text'></label>";
				}
				else {
				    echo "<label class='".$afTextClass."' id='ad_text' name='ad_text'></label>";
				}
				?>
			<!-- ad text -->


			<!-- condition -->
			<?php
			if ($use_condition) {
	        ?>
			<br />
				<label class="marketplace" for="ad_condition"><?php echo JOO_FORM_CONDITION; ?></label>
				<?php
				if ($isUpdateMode || $bInputFields == 1) {
				    echo "<input class='marketplace' id='ad_condition' type='text' name='ad_condition' maxlength='50' value='$ad_condition'>";
				}
				else {
				    echo "<input class='marketplace' id='ad_condition' type='text' name='ad_condition' maxlength='50'>";
				}
				?>
				<label class="marketplace_right" for="condition_text"><?php echo JOO_FORM_CONDITION_TEXT; ?></label>
	         <?php
			}
	         ?>
			<!-- condition -->


			<!-- price -->
			<?php
			if ($use_price) {
	        ?>
			<br />
				<label class="marketplace" for="
	        "><?php echo JOO_FORM_AD_PRICE; ?></label>
				<?php
				if ($isUpdateMode) {
				    echo "<input class='marketplace' id='ad_price' type='text' name='ad_price' size='10' maxlength='10' value='$ad_price'>";
				}
				else {
				    echo "<input class='marketplace' id='ad_price' type='text' name='ad_price' size='10' maxlength='10'>";
				}
				?>
				<label class="marketplace_right" for="ad_price_text"><?php echo JOO_FORM_AD_PRICE_TEXT; ?></label>
	         <?php
			}
	         ?>
			<!-- price -->



			<br />
			<br />
			<br />
			<label class="marketplace_center" style="width:400px;" for="ad_image_text"><?php echo JOO_FORM_AD_IMAGE_TEXT; ?></label>
			<br />
			<br />


			<?php

			// loop over configured # of images
			for ( $i = 1; $i <= $images_per_ad; $i += 1) {

				$c = chr( 96 + $i);
				$pic_jpg = "$".$c."_pic_jpg";
				$pic_png = "$".$c."_pic_png";
				$pic_gif = "$".$c."_pic_gif";


				echo "<label class='marketplace' for='ad_picture".$i."'>".$i.JOO_FORM_AD_PICTURE."</label>";
                echo "<input class='marketplace' id='ad_picture".$i."' type='file' name='ad_picture".$i."'>";

				if ($isUpdateMode) {
				    $$pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.jpg";
				    $$pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.png";
				    $$pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.gif";

				    if ( file_exists( $$pic_jpg)) {
				        echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.jpg' align='top' border='0'>";
				        echo "<input type='checkbox' name='cb_image".$i."' value='delete'>".JOO_AD_DELETE_IMAGE;
				    }
				    else {
				        if ( file_exists( $$pic_png)) {
				            echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.png' align='top' border='0'>";
				            echo "<input type='checkbox' name='cb_image".$i."' value='delete'>".JOO_AD_DELETE_IMAGE;
				        }
				        else {
				            if ( file_exists( $$pic_gif)) {
				                echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.gif' align='top' border='0'>";
				                echo "<input type='checkbox' name='cb_image".$i."' value='delete'>".JOO_AD_DELETE_IMAGE;
				            }
				        }
				    }
				}



				echo "<br />";
				echo "<br />";
			} // end loop over # of images

			echo "<br />";
			?>




			<!-- top featured commercial -->
			<?php
			if ( $isUpdateMode) { // edit these flags is only possible for admins and moderators
				if( $bAdminMode == true  || $bModeratorMode == true) { // admin or moderator
					?>

					<label class="marketplace" for="flag_top"><?php echo JOO_FLAG_TOP; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_top' name='ad_flag_top'>";
                		if( $ad_flag_top == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_top"><?php echo JOO_FORM_FLAG_TOP_TEXT; ?></label>
					<?php
		        	echo "<br />";
		        	?>

					<label class="marketplace" for="flag_featured"><?php echo JOO_FLAG_FEATURED; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_featured' name='ad_flag_featured'>";
                		if( $ad_flag_featured == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_featured"><?php echo JOO_FORM_FLAG_FEATURED_TEXT; ?></label>
					<?php
		        	echo "<br />";
		        	?>

					<label class="marketplace" for="flag_commercial"><?php echo JOO_FLAG_COMMERCIAL; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_commercial' name='ad_flag_commercial'>";
                		if( $ad_flag_commercial == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_commercial"><?php echo JOO_FORM_FLAG_COMMERCIAL_TEXT; ?></label>
					<?php
		        	echo "<br />";
		        	?>

					<br />
					<br />
					<?php
				}
				else { // no admin or moderator
					echo "<input type='hidden' name='ad_flag_top'  value='$ad_flag_top'>";
					echo "<input type='hidden' name='ad_flag_featured'  value='$ad_flag_featured'>";
					echo "<input type='hidden' name='ad_flag_commercial'  value='$ad_flag_commercial'>";
				}
			} // end if isUpdateMode
			else { // insert mode
				if ( $use_top == 1) {
					?>
					<label class="marketplace" for="flag_top"><?php echo JOO_FLAG_TOP; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_top' name='ad_flag_top'>";
                		if( $ad_flag_top == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_top"><?php echo JOO_FORM_FLAG_TOP_TEXT; ?></label>
					<?php
		        	echo "<br />";
				}

				if ( $use_featured == 1) {
		        	?>
					<label class="marketplace" for="flag_featured"><?php echo JOO_FLAG_FEATURED; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_featured' name='ad_flag_featured'>";
                		if( $ad_flag_featured == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_featured"><?php echo JOO_FORM_FLAG_FEATURED_TEXT; ?></label>
					<?php
		        	echo "<br />";
				}

				if ( $use_commercial == 1) {
		        	?>
					<label class="marketplace" for="flag_commercial"><?php echo JOO_FLAG_COMMERCIAL; ?></label>
					<?php
                	echo "<select class='marketplace' id='ad_flag_commercial' name='ad_flag_commercial'>";
                		if( $ad_flag_commercial == 1) {
                    		echo "<option value='1' selected>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0'>".JOO_FLAG_NO."</option>";
                    	}
                    	else {
                        	echo "<option value='1'>".JOO_FLAG_YES."</option>";
                        	echo "<option value='0' selected>".JOO_FLAG_NO."</option>";
                    	}
		        	echo "</select>";
		        	?>
					<label class="marketplace_left" for="flag_commercial"><?php echo JOO_FORM_FLAG_COMMERCIAL_TEXT; ?></label>
					<?php
		        	echo "<br />";
				}

		        echo "<br />";
		        echo "<br />";

			}
			?>
			<!-- top featured commercial -->



			<!-- buttons -->
				<label class="marketplace" for="ad_dummy"> </label>
				<input type="hidden" name="gflag" value="0">
				<?php
				echo "<input type='hidden' name='isUpdateMode' value='$isUpdateMode'>";
				echo "<input type='hidden' name='adid' value='$adid'>";
				echo "<input type='hidden' name='userid' value='$userid'>";
				echo "<input type='hidden' name='username' value='$username'>";
				echo "<input type='hidden' name='mode' value='db'>";

				if ( $use_paid_ads == 1 && $isUpdateMode == 0) { // display >> next for payment
					?>
					<input class="button" type="submit" name="submit" value="<?php echo JOO_FORM_SUBMIT_PAYMENT_TEXT; ?>">
					<?php
				}
				else {
					?>
					<input class="button" type="submit" name="submit" value="<?php echo JOO_FORM_SUBMIT_TEXT; ?>">
					<?php
				}
				?>
			<!-- buttons -->


		  </form>
		  <!-- form -->

		  <br />
		  <br />

	</fieldset>

		<?php
    }

    }

}
elseif ( $payment == 1) { // Bank Transfer screen

	echo "<table cellspacing='10' cellpadding='5' border='0'>";
   		echo "<tr>";
        	echo "<td width='20'>";
            	echo "&nbsp;";
            echo "</td>";

         	echo "<td>";
				echo JOO_BANK_TRANSFER_TEXT1;
				echo $offline_payment_text;
				echo JOO_BANK_TRANSFER_TEXT2;
            echo "</td>";
        echo "</tr>";
    echo "</table>";


	// mark ad as paid by offline payment
    $sql = "UPDATE #__marketplace_ads
				SET payment = '1',
					date_lastmodified = CURRENT_DATE()
				WHERE id = '$adid' AND userid = '$my->id' ";

    $database->setQuery( $sql);

    if ($database->getErrorNum()) {
    	echo $database->stderr();
    } else {
        $database->query();
    }

}

}  // user is logged in

echo "<br />";
echo "<br />";
echo "<br />";


// -------------------------------------------------------------------------------
echo "</td>";
echo "</tr>";


// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	echo "<tr>";
		echo "<td>";

			echo "<table width='100%'' border='0'>";

				// all ads
				echo "<tr>";
					echo "<td width='20' align='left'>";
						echo "<a href='".$linkTagRssAll."' >";
    					echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/feed.gif' title='RSS 2.0' alt='RSS 2.0' border='0' align='bottom'>";
						echo "</a>";
					echo "</td>";
					echo "<td>";
						echo "<a href='".$linkTagRssAll."' title='RSS 2.0'>";
						echo "All Ads";
						echo "</a>";
					echo "</td>";
				echo "</tr>";

				if ( $catid > 0) {  // no feed for my ads
					// ads from this category
					echo "<tr>";
						echo "<td width='20' align='left'>";
							echo "<a href='".$linkTagRssCat."' >";
    						echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/feed.gif' title='RSS 2.0' alt='RSS 2.0' border='0' align='bottom'>";
							echo "</a>";
						echo "</td>";
						echo "<td>";
							echo "<a href='".$linkTagRssCat."' title='RSS 2.0'>";
							echo $cat_name;
							echo "</a>";
						echo "</td>";
					echo "</tr>";
				}
			echo "</table>";


		echo "</td>";
	echo "</tr>";
}


echo "<tr>";
echo "<td class='small' align='center'>";
include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
echo "</td>";
echo "</tr>";


echo "</table>";

?>

