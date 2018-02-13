<?php
/**
 * show_ad.php
 *
 * Displays the single ad and its details
 *
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

<script language="JavaScript">
<!--
function jooImage(pic,w,h) {
    var win;
    var parms;

    w=w+20;
    h=h+30;

    parms="width="+w+",height="+h+",screenX=50,screenY=50,resizeable=yes,locationbar=no,status=no,menubar=no";
    win=window.open( pic, "imagePopup", parms);
}

-->
</script>



<?php
global $database;

$Itemid  = intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );
$catid   = intval( mosGetParam( $_REQUEST, 'catid', '0' ) );
$adid    = intval( mosGetParam( $_REQUEST, 'adid', '0' ) );


// set page title
if ( $catid > 0) {
        // get category-name: #__marketplace_category
        $database->setQuery( "SELECT name FROM #__marketplace_categories WHERE published='1' AND id=$catid");
        $tcatname = $database->loadResult();

        $database->setQuery( "SELECT ad_headline FROM #__marketplace_ads WHERE published='1' AND id=$adid");
        $tadsubject = $database->loadResult();

        $mainframe->SetPageTitle( JOO_TITLE." - " .JOO_CATEGORY." - ".$tcatname." - ".$tadsubject );
}
else {
        $mainframe->SetPageTitle( JOO_TITLE." - " .JOO_MY_ADS." - ".$tadsubject );
}


// get configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();

$show_recent5               = (int)$config[0]->show_recent5;
$show_container             = (int)$config[0]->show_container;
$ad_contact_registered_only = (int)$config[0]->ad_contact_registered_only;
$use_surname                = (int)$config[0]->use_surname;
$use_street                 = (int)$config[0]->use_street;
$use_zip                    = (int)$config[0]->use_zip;
$use_city                   = (int)$config[0]->use_city;
$use_state                  = (int)$config[0]->use_state;
$use_country                = (int)$config[0]->use_country;
$use_web                    = (int)$config[0]->use_web;
$use_phone1                 = (int)$config[0]->use_phone1;
$use_phone2                 = (int)$config[0]->use_phone2;
$use_condition              = (int)$config[0]->use_condition;
$use_price                  = (int)$config[0]->use_price;
$use_primezilla             = (int)$config[0]->use_primezilla;
$use_primezillaforcontact   = (int)$config[0]->use_primezillaforcontact;
$rss_syndication            = (int)$config[0]->rss_syndication;
$use_slimbox             	= (int)$config[0]->use_slimbox;
$include_mootools        	= (int)$config[0]->include_mootools;
$include_slimbox         	= (int)$config[0]->include_slimbox;
$images_per_ad          	= (int)$config[0]->images_per_ad;
$image_columns          	= (int)$config[0]->image_columns;


if ($include_mootools == 1) {
	$headerTagMootools = "<script language='javascript' src='".$mosConfig_live_site."/components/com_marketplace/mootools/mootools-release-1.11.js' type='text/javascript'></script>";
	$mainframe->addCustomHeadTag( $headerTagMootools);
}
if ($include_slimbox == 1) {
  	$headerTagSlimbox = "<script language='javascript' src='".$mosConfig_live_site."/components/com_marketplace/slimbox/js/slimbox.js' type='text/javascript'></script>";
	$mainframe->addCustomHeadTag( $headerTagSlimbox);

    $headerTagSlimboxCss = "<link href='".$mosConfig_live_site."/components/com_marketplace/slimbox/css/slimbox.css' rel='stylesheet' type='text/css' />";
	$mainframe->addCustomHeadTag( $headerTagSlimboxCss);
}


// get marketplace user data
$database->setQuery("SELECT * FROM #__marketplace_users WHERE userid = '$my->id' AND published = '1' AND date_begin <= curdate() AND date_end >= curdate() ORDER BY date_begin ASC, date_end ASC");
$marketplace_users = $database->loadObjectList();
$marketplace_users_entry_count = count( $marketplace_users);

$marketplace_users_isAdmin          = $marketplace_users[0]->isAdmin;
$marketplace_users_isModerator      = $marketplace_users[0]->isModerator;
$marketplace_users_categories       = $marketplace_users[0]->categories;


echo "<table width='100%' border='0'>";
echo "<tr>";
echo "<td align='left'>";

include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');

//if ( $show_recent5 == 1) {
//    include($mosConfig_absolute_path.'/components/com_marketplace/recent5.php');
//    echo "<br>";
//    echo "<br>";
//}



// get category-name: #__marketplace_category
if ( $catid > 0) {
    // get category-name: #__marketplace_category
    $database->setQuery("SELECT id, parent, name, description, image FROM #__marketplace_categories WHERE published='1' AND id=$catid");
    $rows_categories = $database->loadObjectList();

    $cat_parent 	 = $rows_categories[0]->parent;
    $cat_name 		 = $rows_categories[0]->name;
    $cat_description = $rows_categories[0]->description;
    $cat_image 		 = $rows_categories[0]->image;

	// get name, description and image of parent
	if ( $cat_parent > 0) {
        $database->setQuery( "SELECT name, description, image  FROM #__marketplace_categories WHERE published='1' AND id=$cat_parent");
        $rows_parents 	= $database->loadObjectList();

        $par_name 		 	= $rows_parents[0]->name;
        $par_description  	= $rows_parents[0]->description;
        $par_image 			= $rows_parents[0]->image;
	}
	else { // parent == 0
        $par_name 		 	= "";
        $par_description  	= "";
        $par_image 			= "";
	}

}
else { // catid=0 -> my ads
    $cat_name 			= JOO_MY_ADS;
    $cat_description 	= JOO_MY_ADS_TEXT;
    $cat_image 			= "default.gif";
}


// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}


if ( $show_container == 1) {
    echo "<table width='100%' border='0'>";
    	echo "<tr>";
        	if ( strlen( trim($par_image)) > 0) {  // if image is set
                echo "<td align='center' valign='top' width='20'>";
                    echo "<center>";
                        echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/categories/".$par_image."' align='center' border='0'>";
                    echo "</center>";
                echo "</td>";
        		echo "<td width='5' align='left' valign='center'>";
                    echo "&nbsp;";
                echo "</td>";
        	}
        	echo "<td align='left' valign='center'>";
        		echo "<b>".$par_name."</b><br>";
        		echo "<font size='-2'>";
        		echo $par_description;
        		echo "</font>";
        	echo "</td>";
        echo "</tr>";
    echo "</table>";
	echo "<br />";
}

$linkTarget = sefRelToAbs( "index.php?option=com_marketplace&amp;page=show_category&amp;catid=".$catid."&amp;Itemid=".$Itemid);

echo "<table width='100%' border='0'>";
    echo "<tr>";

        echo "<td align='center' valign='top' width='20'>";
            echo "<a href='".$linkTarget."'>";
            echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/categories/".$cat_image."' align='center' border='0'>";
            echo "</a>";
        echo "</td>";

        echo "<td width='5' align='left' valign='center'>";
            echo "&nbsp;";
        echo "</td>";

        echo "<td align='left' valign='center'>";
            echo "<b>";
            echo "<a href='".$linkTarget."'>";
            echo $cat_name;
            echo "</a>";
            echo "</b>";
            echo "<font size='-2'>";
            echo "<br>".$cat_description;
            echo "</font>";
        echo "</td>";

    echo "</tr>";
echo "</table>";
echo "<br>";
echo "<br>";



// build ad-page: marketplace_ads
$database->setQuery("SELECT id, category, userid, user, name, surname, street, zip, city, state, country, phone1, phone2, email, web, ad_type, ad_headline, ad_text, ad_condition, ad_price, ad_image, date_format(date_created, '%d.%m.%Y' ) as date_cr, flag_featured, flag_top, flag_commercial, published FROM #__marketplace_ads WHERE id=$adid");
$rows = $database->loadObjectList();

if ( $rows == null) {  // got no ad -> redirect to marketplace index
	mosRedirect( sefRelToAbs( 'index.php?option=com_marketplace&Itemid='.$Itemid));
}



$ad_id    		    = $rows[0]->id;
$ad_category        = $rows[0]->category;
$ad_userid		    = $rows[0]->userid;
$ad_user     	    = $rows[0]->user;
$ad_name     	    = $rows[0]->name;
$ad_surname    	    = $rows[0]->surname;
$ad_street 		    = $rows[0]->street;
$ad_zip 		    = $rows[0]->zip;
$ad_city 		    = $rows[0]->city;
$ad_state 	        = $rows[0]->state;
$ad_country 	    = $rows[0]->country;
$ad_phone1 		    = $rows[0]->phone1;
$ad_phone2 		    = $rows[0]->phone2;
$ad_email 		    = $rows[0]->email;
$ad_web 		    = $rows[0]->web;
$ad_type 	        = $rows[0]->ad_type;
$ad_headline 	    = $rows[0]->ad_headline;
$ad_text 		    = $rows[0]->ad_text;
$ad_text 		    = strip_tags( $ad_text);
$ad_text 		    = nl2br( $ad_text);
$ad_condition 	    = $rows[0]->ad_condition;
$ad_price 		    = $rows[0]->ad_price;
$ad_image 		    = $rows[0]->ad_image;
$date_created	    = $rows[0]->date_cr;
$flag_featured      = $rows[0]->flag_featured;
$flag_top           = $rows[0]->flag_top;
$flag_commercial    = $rows[0]->flag_commercial;
$published		    = $rows[0]->published;


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


// if not published show ad only to owner or admin/moderator
if ( $published == 0) { // ad is not published
	if( $my->id == $ad_userid  || $bAdminMode == true  || $bModeratorMode == true) { // owner or admin or moderator of this category
		// do nothing - these guys should see the unpublished ad
	}
	else { // not owner, no admin/moderator - no access to unpublished ad
		mosRedirect( sefRelToAbs( 'index.php?option=com_marketplace&Itemid='.$Itemid));
	}
}


// get ad type from db
$database->setQuery( "SELECT id, name FROM #__marketplace_types WHERE id='$ad_type' ");
$rows_types = $database->loadObjectList();
$sAdType    = $rows_types[0]->name;

echo "<br />";

echo "<table class=\"jooTable\" cellspacing='1'>";

    echo "<tr>";

        echo "<th width='20%' style='text-align: center;'>";
            echo "<b>".$sAdType."</b>";
        echo "</th>";

        echo "<th width='15%' style='text-align: center;'>";
            if ( $flag_commercial) {
                    echo "<b>".JOO_COMMERCIAL."</b>";
            }
            else {
                    echo "<b>".JOO_PRIVATE."</b>";
            }
        echo "</th>";

        echo "<th width='15%' style='text-align: center;'>";
            echo "Id: <b>".$ad_id."</b>";
        echo "</th>";

        echo "<th width='20%' style='text-align: center;'>";
            echo $date_created;
        echo "</th>";

        echo "<th width='30%' style='text-align: center;'>";

                        echo "<center>";
							echo "<table border='0' cellspacing='0' cellpadding='0'>";
								echo "<tr>";

									echo "<td align='left' valign='center' style='font-weight: bold;'>";
										echo JOO_FROM."&nbsp;";
									echo "</td>";

									echo "<td align='left' valign='center' style='font-weight: bold;'>";
										echo $ad_user."&nbsp;&nbsp;";
									echo "</td>";

									if ( $my->id > 0 && $use_primezilla == true) {  // logged in and primezilla=true

                                        $sAltTag = JOO_PM_SEND_TO." ";
                                        $sSubject = JOO_PM_SUBJECT_PREFIX.$ad_headline;

                                        $database->setQuery( "SELECT id FROM #__menu WHERE link LIKE '%com_primezilla%' AND published='1' ");
                                        $pzItemid = $database->loadResult();
                                        if ( strlen( $pzItemid) > 0 ) {
                                            $pzItemidLink = "&amp;Itemid=".$pzItemid;
                                        }
                                        else {
                                            $pzItemidLink = "";
                                        }

									   echo "<td align='left' valign='center' >";
									       // call to primezilla private messaging
									       $linkPrimezilla = sefRelToAbs( "index.php?option=com_primezilla&amp;page=write&amp;uname=".$ad_user."&amp;subject=".$sSubject.$pzItemidLink);
										   echo " <a href='".$linkPrimezilla."'>";
										   echo "<img src='".$mosConfig_live_site."/components/com_primezilla/images/messagenew.gif' align='center' border='0' alt='$sAltTag $ad_user' title='$sAltTag $ad_user' >";
										   echo "</a>";
									   echo "</td>";
									}

								echo "</tr>";
							echo "</table>";
                        echo "</center>";

        echo "</th>";

    echo "</tr>";



    if ( $flag_commercial) {
        $sClassId = "class=\"jooCommercial\" id=\"jooAdHeader\"";
    }
    else {
        if( $flag_featured) {
            $sClassId = "class=\"jooFeatured\" id=\"jooAdHeader\"";
        }
        else {
            $sClassId = "class=\"jooNormal\" id=\"jooAdHeader\"";
        }
    }

    echo "<tr>";
        echo "<td colspan='5' ".$sClassId." >";
            echo  htmlspecialchars ($ad_headline);
        echo "</td>";
    echo "</tr>";



    echo "<tr>";
        echo "<td width='70%' colspan='4' class='jooNormal' id='jooAdText'>";
            echo $ad_text;
        echo "</td>";


        if ( $use_condition || $use_price ) {
            echo "<td width='30%' rowspan='3' class='jooNormal' id='jooAdImage'>";
        }
        else {
            echo "<td width='30%' rowspan='2' class='jooNormal' id='jooAdImage'>";
        }

            if ( $ad_image > 0) {
                echo "<font size='-2'>";
                echo JOO_CLICKONIMAGE;
                echo "</font>";
                echo "<br>";


                echo "<table width='100%' cellpadding='1' cellspacing='10' border='0'>";

                $iColumn = 1;

				// loop over configured # of images
				for ( $i = 1; $i <= $images_per_ad; $i += 1) {
					$c = chr( 96 + $i);

					$pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.jpg";
                	$pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.png";
                	$pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c."_t.gif";


                	if ( $image_columns == 2) {
                		if ( $iColumn == 1) {
                			echo "<tr>";
                		}
                	}
                	else { // 1 column
                		echo "<tr>";
                	}


                			echo "<td align='center'>";
								echo "<center>";

                	if ( file_exists( $pic_jpg)) {
                    	$piclink 	= $mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".jpg";
                    	$img = ImageCreateFromJpeg( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c.".jpg");
                    	$img_width  = ImageSx( $img);
                    	$img_height = ImageSy( $img);

                    	if ( $use_slimbox == 1) { // use slimbox for image display
                    		echo "<a href='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".jpg' title='".$ad_headline."' rel='lightbox[".$ad_id."]'>";
                        		echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.jpg' align='center' border='0'>";
                        	echo "</a>";
                    	}
                    	else { // normal popup
                        	echo "<a href=javascript:jooImage('$piclink',$img_width,$img_height);>";
                        		echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.jpg' align='center' border='0'>";
                        	echo "</a>";
                    	}

                	}
                else {
                    if ( file_exists( $pic_png)) {
                        $piclink 	= $mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".png";
                        $img = ImageCreateFromPng( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c.".png");
                        $img_width  = ImageSx( $img);
                        $img_height = ImageSy( $img);

                        if ( $use_slimbox == 1) { // use slimbox for image display
                        	echo "<a href='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".png' title='".$ad_headline."' rel='lightbox[".$ad_id."]'>";
                        		echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.png' align='center' border='0'>";
                        	echo "</a>";
                        }
                        else { // normal popup
                        	echo "<a href=javascript:jooImage('$piclink',$img_width,$img_height);>";
                        		echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.png' align='center' border='0'>";
                        	echo "</a>";
                        }

                    }
                    else {
                        if ( file_exists( $pic_gif)) {
                            $piclink 	= $mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".gif";
                            $img = ImageCreateFromGif( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$ad_id.$c.".gif");
                            $img_width  = ImageSx( $img);
                            $img_height = ImageSy( $img);

                        	if ( $use_slimbox == 1) { // use slimbox for image display
                        		echo "<a href='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c.".gif' title='".$ad_headline."' rel='lightbox[".$ad_id."]'>";
                        			echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.gif' align='center' border='0'>";
                        		echo "</a>";
                        	}
                        	else { // normal popup
                        		echo "<a href=javascript:jooImage('$piclink',$img_width,$img_height);>";
                        			echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$ad_id.$c."_t.gif' align='center' border='0'>";
                        		echo "</a>";
                        	}

                        }
                    }
                }


								echo "</center>";

                			echo "</td>";


                	if ( $image_columns == 2) {
                		if ( $iColumn == 2) {
                			echo "</tr>";
                		}

                		if ( $iColumn == 1) {
                			$iColumn = 2;
                		}
                		else {
                			$iColumn = 1;
                		}
                	}
                	else { // 1 column
                		echo "</tr>";
                	}



				} // end loop # of images

                echo "</table>";



        } // if image > 0
        else {
            echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/nopic.gif' align='center' border='0'>";
        }

        echo "</td>";
    echo "</tr>";


    if ( $use_condition || $use_price ) {
        echo "<tr>";
            echo "<td colspan='4' class='jooNormal' id='jooAdInfo' >";
                if ($use_condition) {
                    echo "<b>";
                    echo JOO_FORM_CONDITION.": ".$ad_condition;
                    echo "</b>";
                }

                if ($use_price) {
                    if ( $use_condition ) {
                        echo "<br />";
                        echo "<br />";
                    }
                    echo "<b>";
                    echo JOO_PRICE.": ".$ad_price;
                    echo "</b>";
                }
            echo "</td>";
        echo "</tr>";
    }

    echo "<tr>";
        echo "<td colspan='4' class='jooNormal' id='jooAdInfo' >";
            echo "<b>";
            echo JOO_CONTACT.": ";
            echo "</b>";

            echo "<br />";
            if ($use_surname) {
                echo $ad_surname." ";
            }
            echo $ad_name;
            echo "<br />";

            if ($use_street) {
                echo $ad_street;
                echo "<br />";
            }

            if ($use_zip) {
                echo $ad_zip." ";
            }
            if ($use_city) {
                echo $ad_city;
                echo "<br />";
            }

            if ($use_state) {
                echo $ad_state;
                echo "<br />";
            }

            if ($use_country) {
                echo $ad_country;
                echo "<br />";
            }

            echo "<br />";

            if ( $use_primezillaforcontact == true) {  // logged in and primezillaforcontact=true

			     if ( $my->id > 0 && $use_primezilla == true) {  // logged in and primezilla=true
			        echo "<table>";
					   echo "<tr>";
				        echo "<td align='left' valign='center' >";
					       // call to primezilla private messaging
						   $linkPrimezilla = sefRelToAbs( "index.php?option=com_primezilla&amp;page=write&amp;uname=".$ad_user."&amp;subject=".$sSubject.$pzItemidLink);
						   echo " <a href='".$linkPrimezilla."'>";
					       echo "<img src='".$mosConfig_live_site."/components/com_primezilla/images/messagenew.gif' align='center' border='0' alt='$sAltTag $ad_user' title='$sAltTag $ad_user' >";
					       echo "</a>";
					   echo "</td>";
				       echo "<td align='left' valign='center' >";
					       // call to primezilla private messaging
						   echo " <a href='".$linkPrimezilla."'>";
					       echo "&nbsp;".JOO_PM_SEND_TO." ".$ad_user;
					       echo "</a>";
					   echo "</td>";


					   echo "</tr>";
			        echo "</table>";
				 }
				 else {
					   echo JOO_PM_LOGIN." ".$ad_user;
                       echo "<br />";
				 }


            }
            else {

                if ( $ad_contact_registered_only==1 && $my->id==0) {
                    echo JOO_CONTACT_DETAILS;
                    echo "<br />";
                }
                else {
                    if ($use_phone1) {
                        echo JOO_FORM_PHONE1.": ".$ad_phone1;
                        echo "<br />";
                    }
                    if ($use_phone2) {
                        echo JOO_FORM_PHONE2.": ".$ad_phone2;
                        echo "<br />";
                    }
                    if ( strlen($ad_phone1) > 3 || strlen($ad_phone2) > 3) {
                        echo "<br />";
                    }


                    echo "<table border='0' cellpadding='5' cellspacing='0'>";
                        echo "<tr>";
                            echo "<td>";
                                echo JOO_FORM_EMAIL.": ";
                            echo "</td>";
                            echo "<td>";
                                echo "&nbsp;";
                                echo mosHTML::emailcloaking( $ad_email);
                            echo "</td>";
                        echo "<tr>";

                        if ($use_web) {
                            echo "<tr>";
                                echo "<td>";
                                    echo JOO_FORM_WEB.": ";
                                echo "</td>";
                                echo "<td>";
                                    echo "&nbsp;<a href='http://".str_replace("http://", "", $ad_web)."' target='_blank'>".str_replace("http://", "", $ad_web)."</a>";
                                echo "</td>";
                            echo "</tr>";
                        }

                    echo "</table>";

                }
            }

            echo "</td>";
        echo "</tr>";



        if( $my->id == $ad_userid  || $bAdminMode == true  || $bModeratorMode == true) { // owner or admin or moderator of this category

            echo "<tr>";
                echo "<td colspan='5' class='jooNormal' id='jooAdToolbar' >";
                    $linkEditAd    = sefRelToAbs( "index.php?option=com_marketplace&amp;page=write_ad&amp;adid=".$ad_id."&amp;Itemid=".$Itemid);
                    $linkDeleteAd  = sefRelToAbs( "index.php?option=com_marketplace&amp;page=delete_ad&amp;adid=".$ad_id."&amp;Itemid=".$Itemid);

                    echo "<table cellspacing='0' border='0'>";
                        echo "<tr>";
                            echo "<td valign='center' style='padding-top: 4px;'>";

                                echo "<span style='margin-right: 20px;'>";
        						if ( $published == 1) {
    								echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/published.gif' title='".JOO_PUBLISHED."' alt='".JOO_PUBLISHED."' border='0' align='bottom'>";
        						}
        						else {
    								echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/unpublished.gif' title='".JOO_UNPUBLISHED."' alt='".JOO_UNPUBLISHED."' border='0' align='bottom'>";
        						}
                                echo "</span>";
                            echo "</td>";


                            echo "<td valign=\"center\">";
                                echo "<a href=".$linkEditAd.">";
                                echo "<span>";
                                    echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/editad.gif\" border=\"0\" align=\"top\" >";
                                echo "</span>";
                                echo "<span>";
                                    echo "&nbsp;&nbsp;&nbsp;".JOO_AD_EDIT;
                                echo "</span>";
                                echo "</a>";
                            echo "</td>";

                            echo "<td valign=\"center\">";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            echo "</td>";

                            echo "<td valign=\"center\">";
                                echo "<a href=".$linkDeleteAd.">";
                                echo "<span>";
                                    echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/deletead.gif\" border=\"0\" align=\"top\" >";
                                echo "</span>";
                                echo "<span>";
                                    echo "&nbsp;&nbsp;&nbsp;".JOO_AD_DELETE;
                                echo "</span>";
                                echo "</a>";
                            echo "</td>";


                            if ( $bAdminMode == true) {
                                echo "<td valign=\"center\">";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "</td>";

                                echo "<td valign='center'>";
                                    echo "<span>";
                                    echo JOO_ADMIN_MODE;
                                    echo "</span>";
                                echo "</td>";
                            }
                            elseif ( $bModeratorMode == true) {
                                echo "<td valign=\"center\">";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                echo "</td>";

                                echo "<td valign='center'>";
                                    echo "<span>";
                                    echo JOO_MODERATOR_MODE;
                                    echo "</span>";
                                echo "</td>";
                            }


                        echo "</tr>";
                    echo "</table>";

                echo "</td>";

            echo "</tr>";

    }
    // end user/admin-toolbar





    echo "</table>";



    // increment views. views from ad author are not counted to prevent highclicking views of own ad
    if ( $my->id <> $ad_userid) {
        $sql = "UPDATE #__marketplace_ads SET views = LAST_INSERT_ID(views+1) WHERE id = $adid";
        $database->setQuery( $sql);

        if ($database->getErrorNum()) {
            echo $database->stderr();
        } else {
            $database->query();
        }
    }
if ( $show_recent5 == 1) {
    include($mosConfig_absolute_path.'/components/com_marketplace/recent5.php');
    echo "<br>";
    echo "<br>";
}

echo "</td>";
echo "</tr>";

// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	echo "<tr>";
		echo "<td>";
			echo "<br />";
			echo "<br />";
			echo "<br />";

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
echo "<br>";
echo "<br>";
include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
echo "</td>";
echo "</tr>";


echo "</table>";

?>