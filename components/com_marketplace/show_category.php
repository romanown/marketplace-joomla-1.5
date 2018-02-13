<?php
/**
 * show_category.php
 *
 * Displays the selected category as a listing with thumbnails of ad images
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

<?php

global $database;


if ( !class_exists( "JConfig")) {  // we are on 1.0.x
	$Itemid     	= intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );
	$catid      	= intval( mosGetParam( $_REQUEST, 'catid', '0' ) );
	$total      	= intval( mosGetParam( $_REQUEST, 'total', '0' ) );
	$limitstart    	= intval( mosGetParam( $_REQUEST, 'limitstart', '0' ) );
	$ad_type        = intval( mosGetParam( $_REQUEST, 'ad_type', '0' ) );
	$searchtext     = strval( mosGetParam( $_REQUEST, 'searchtext', '' ) );
}
else { // J 1.5.x
	$Itemid     	= intval( JRequest::getVar( 'Itemid', '0' ) );
	$catid      	= intval( JRequest::getVar( 'catid', '0' ) );
	$total      	= intval( JRequest::getVar( 'total', '0' ) );
	$limitstart    	= intval( JRequest::getVar( 'limitstart', '0' ) );
	$ad_type        = intval( JRequest::getVar( 'ad_type', '0' ) );
	$searchtext     = strval( JRequest::getVar( 'searchtext', '' ) );
}


// get configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();

$show_recent5    	= (int)$config[0]->show_recent5;
$show_container    	= (int)$config[0]->show_container;
$use_price       	= (int)$config[0]->use_price;
$rss_syndication 	= (int)$config[0]->rss_syndication;
$limit	 			= (int)$config[0]->ads_per_page;



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

$bAdminMode = false; // defined start value
if ( $marketplace_users_isAdmin == 1) {
	$bAdminMode = true;
}

$bModeratorMode = false; // defined start value
if ( $marketplace_users_isModerator == 1) {
	$token = strtok( $marketplace_users_categories, ',');
    while( $token){
    	if ( $token == $catid) {
        	$bModeratorMode = true;
        }
        $token = strtok( ',');
    }
}




//  get category info and set page title
if ( $catid > 0) {
        // get category-name: #__marketplace_category
        $database->setQuery( "SELECT id, parent, name, description, image  FROM #__marketplace_categories WHERE published='1' AND id=$catid");
        $rows_categories 	= $database->loadObjectList();

        $cat_parent 		= $rows_categories[0]->parent;
        $cat_name 		 	= $rows_categories[0]->name;
        $cat_description  	= $rows_categories[0]->description;
        $cat_image 			= $rows_categories[0]->image;

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

        $mainframe->SetPageTitle( JOO_TITLE." - " .$cat_name );
}
else {
        $cat_name 			= JOO_MY_ADS;
        $cat_description 	= JOO_MY_ADS_TEXT;
        $cat_image 			= "default.gif";
        $mainframe->SetPageTitle( JOO_TITLE." - " .JOO_MY_ADS );
}


// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}


// get language for marketplace
if(file_exists($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/'.$mainframe->getCfg('lang').'.php')) {
  require_once($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/'.$mainframe->getCfg('lang').'.php');
}
else {
  require_once($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/english.php');
}



echo "<table width='100%'>";
echo "<tr>";
echo "<td align='left'>";

include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');


$username=$my->username;
$userid=$my->id;

if ( $catid == "0" && $userid == "0") {
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
    echo JOO_MY_ADS_NOTALLOWED;
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}
else {  // user is logged in

    if ( $show_recent5 == 1) {
        include($mosConfig_absolute_path.'/components/com_marketplace/recent5.php');
        echo "<br>";
        echo "<br>";
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





    // count entries
	if( $bAdminMode == true  || $bModeratorMode == true) { // admin or moderator
		$pubWhere = " ";
	}
	else {
		$pubWhere = " AND published='1'";
	}


    if( $limitstart==0) {

        if ($catid > 0) { // "normal" ads

            if ($ad_type=="0") {
                if ( strlen( $searchtext) < 1) { // no search text
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE category=$catid".$pubWhere);
                }
                else { // searchtext
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE category=$catid".$pubWhere." AND
			   							       (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							           OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')");
                }
            }
            else {
                if ( strlen( $searchtext) < 1) { // no search text
                	$sql = "SELECT COUNT(*) FROM #__marketplace_ads WHERE category=$catid AND ad_type='$ad_type'".$pubWhere;
                    $database->setQuery( $sql);
                }
                else {
                	$sql = "SELECT COUNT(*) FROM #__marketplace_ads WHERE category=$catid AND ad_type='$ad_type'".$pubWhere." AND
			   							       (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							           OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')";

                    $database->setQuery( $sql);
                }
            }

        }
        else {  // my ads

            if ( $ad_type == "0") {
                if ( strlen( $searchtext) < 1) { // no search text
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE userid=$userid");
                }
                else {
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE userid=$userid AND
			   							       (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							           OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')");
                }
            }
            else {
                if ( strlen( $searchtext) < 1) { // no search text
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE userid=$userid AND ad_type='$ad_type'");
                }
                else {
                    $database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads WHERE userid=$userid AND ad_type='$ad_type' AND
			   							       (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							           OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')");
                }
            }

        }

        $total = $database->loadResult();

        if ($total <= $limit) {
                $limitstart = 0;
        }
    }
    // count entries




    if (!isset( $ad_type)) {
        $ad_type = "0";
    }


    // cut whitespaces from searchtext
    $searchtext = trim( $searchtext);


    echo "<br />";
    echo "<table id=\"select_table\" border=\"0\">";
    echo "<tr>";

    $action = sefRelToAbs( "index.php?option=com_marketplace&page=show_category&catid=$catid&Itemid=$Itemid");
    echo "<form class='marketplace' action='$action' method='post' name='adsearch'>";

      echo "<td width=\"100\">";
        echo "<input class='marketplace_search' id='searchtext' type='text' name='searchtext' value=\"".$searchtext."\">";
      echo "</td>";
      echo "<td width=\"100\">";
        echo "<input class='button' type='submit' name='submit_search' value=\"".JOO_FORM_SUBMIT_SEARCH_TEXT."\">";
      echo "</td>";

      echo "<input type='hidden' name='ad_type' value='$ad_type'>";
      echo "<input type='hidden' name='total' value='$total'>";
    echo "</form>";


      echo "<td>";
        echo "&nbsp;";
      echo "</td>";


    $action = sefRelToAbs( "index.php?option=com_marketplace&page=show_category&catid=$catid&Itemid=$Itemid");
    echo "<form class='marketplace' action='$action' method='post' name='adselect'>";
      echo "<td  width=\"100\">";

        // get ad types
        $database->setQuery("SELECT id, name FROM #__marketplace_types WHERE published='1' ORDER BY sort_order");
        $rows_type = $database->loadObjectList();

        echo "<select name='ad_type'>";
            echo "<option value='0' selected>".JOO_ALL."</option>";
            foreach( $rows_type as $rowtype) {
                if( $rowtype->id == $ad_type) {
                    echo "<option value='$rowtype->id' selected>$rowtype->name</option>";
                }
                else {
                    echo "<option value='$rowtype->id'>$rowtype->name</option>";
                }
            }
		echo "</select>";
      echo "</td>";
      echo "<td width=\"100\" align=\"right\">";
		echo " <input class='button' type='submit' name='submit_refresh' value=\"".JOO_FORM_SUBMIT_REFRESH_TEXT."\">";
      echo "</td>";

      echo "<input type='hidden' name='searchtext' value='$searchtext'>";
    echo "</form>";

    echo "</tr>";
    echo "</table>";
    echo "<br />";






    $count = $limit;

    if ($catid > 0) { // "normal" ads

        if ($ad_type=="0") {

          if ( strlen( $searchtext) < 1) { // no search text
            $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE category=$catid".$pubWhere."
			   							ORDER BY flag_top desc, id DESC
			   							LIMIT $limitstart, $count");
          }
          else { // search text entered
            $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE category=$catid".$pubWhere." AND
			   							   (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							       OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')
			   							ORDER BY flag_top desc, id DESC
			   							LIMIT $limitstart, $count");
          }



        }
        else {  // ad_type <> 0 (all)
          if ( strlen( $searchtext) < 1) { // no search text
            $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE category=$catid AND ad_type='$ad_type'".$pubWhere."
			   							ORDER BY flag_top desc, id DESC
			   							LIMIT $limitstart, $count");
          }
          else { // search text entered
            $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE category=$catid AND ad_type='$ad_type'".$pubWhere." AND
			   							   (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							       OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')
			   							ORDER BY flag_top desc, id DESC
			   							LIMIT $limitstart, $count");
          }
        }
    }
    else {  // my ads

        if ($ad_type=="0") {
            if ( strlen( $searchtext) < 1) { // no search text
                $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE userid=$userid
			   							ORDER BY id DESC
			   							LIMIT $limitstart, $count");
            }
            else {
                $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE userid=$userid AND
			   							   (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							       OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')
			   							ORDER BY id DESC
			   							LIMIT $limitstart, $count");
            }
        }
        else {
            if ( strlen( $searchtext) < 1) { // no search text
                $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE userid=$userid AND ad_type='$ad_type'
			   							ORDER BY id DESC
			   							LIMIT $limitstart, $count");
            }
            else {
                $database->setQuery("SELECT id, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  								date_format(date_created, '%d.%m.%Y' ) as date_created, views,
				  								flag_featured, flag_top, flag_commercial, published
			   							FROM #__marketplace_ads
			   							WHERE userid=$userid AND ad_type='$ad_type' AND
			   							   (ad_headline LIKE '%$searchtext%' OR ad_text LIKE '%$searchtext%'
			   							       OR city LIKE '%$searchtext%' OR zip LIKE '%$searchtext%' OR country LIKE '%$searchtext%')
			   							ORDER BY id DESC
			   							LIMIT $limitstart, $count");

            }
        }

    }

    $rows = $database->loadObjectList();
    $nn = count($rows);


    echo "<br>";
    echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
    echo "<tr>";
    echo "<td align='left'>";
    if ( $total > 0) {
        echo "&nbsp;".JOO_ENTRIES1." ".($limitstart+1)." ".JOO_ENTRIES2." ".($limitstart+$nn)." ".JOO_ENTRIES3." ".$total;
    }
    else {
        echo "&nbsp;".JOO_NOENTRIES;
    }
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<br>";



    echo "<table class=\"jooTable\" cellpadding='0' cellspacing='1'>";

    echo "<tr>";

        if ( $use_price) {
            echo "<th width='55%' style='text-align: left;'>".JOO_AD."</th>";
        }
        else {
            echo "<th width='47%' style='text-align: left;'>".JOO_AD."</th>";
        }

        echo "<th width='5%'  style='text-align: center;'>".JOO_VIEWS."</th>";

        if ( $use_price) {
            echo "<th width='8%'  style='text-align: center;'>".JOO_PRICE."</th>";
        }

        echo "<th width='7%'  style='text-align: center;'>".JOO_TYPE."</th>";
        echo "<th width='15%' style='text-align: center;'>".JOO_DATE."</th>";
    echo "</tr>";

    $boolTopStart = 1;
    $boolLastTop = 0;

    foreach($rows as $row) {

        $boolFeatured 	= $row->flag_featured;
        $boolTop 		= $row->flag_top;
        $boolCommercial	= $row->flag_commercial;
		$boolPublished  = $row->published;

        // top-ad handling
        if ( $catid > 0) { // don't show when displaying "my ads"
            if ( $boolTop == 1) {
                if ( $boolTopStart == 1) {
                    echo "<tr>";
                        echo "<td id=\"jooTopTextTop\" colspan='5'>";
                            echo "<br />";
                            echo JOO_TOPAD;
                        echo "</td>";
                    echo "</tr>";
                }
                $boolLastTop = 1;
            }
            else {
                if ( $boolLastTop == 1) {
                    echo "<tr>";
                        echo "<td id='jooTopTextBottom' colspan='5'>";
                            echo JOO_TOPAD_TEXT;
                            echo "<br />";
                            echo "<br />";
                        echo "</td>";
                    echo "</tr>";
                }
                $boolLastTop = 0;
            }
        }


        $linkTarget = sefRelToAbs( "index.php?option=com_marketplace&amp;page=show_ad&amp;catid=".$catid."&amp;adid=".$row->id."&amp;Itemid=".$Itemid);

        echo "<tr>";


            // first decide what kind of ad it is
            if ($boolCommercial == 1) { // commercial ad
              $sDiv = "<div class='jooCommercial'>";
            }
            else { // private ad
                if ($boolFeatured == 1) { // featured ad
                    $sDiv = "<div class='jooFeatured'>";
                }
                else { // normal ad
                    $sDiv = "<div class='jooNormal'>";
                }
            }
            echo "<td colspan='5'>";

            echo $sDiv;
            echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
            echo "<tr>";



        if ( $use_price) {
            echo "<td width='55%' valign='top' align='left'>";
        }
        else {
            echo "<td width='47%' valign='top' align='left'>";
        }

        echo "<table width='100%' border='0'>";
        echo "<tr>";
        echo "<td align='center' valign='top' width='100'>";
          echo "<center>";

        if ( $row->ad_image > 0) {

            $a_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a_t.jpg";
            $a_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a_t.png";
            $a_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a_t.gif";

            $b_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b_t.jpg";
            $b_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b_t.png";
            $b_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b_t.gif";

            $c_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c_t.jpg";
            $c_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c_t.png";
            $c_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c_t.gif";


            $boolPicFound = 0;
            if ( file_exists( $a_pic_jpg)) {
                echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a_t.jpg"."' align='center' border='0'></a>";
                $boolPicFound = 1;
            }
            else {
                if ( file_exists( $a_pic_png)) {
                    echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a_t.png"."' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $a_pic_gif)) {
                        echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a_t.gif"."' align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                }
            }


            if ( $boolPicFound == 0) {
                if ( file_exists( $b_pic_jpg)) {
                    echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b_t.jpg"."' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $b_pic_png)) {
                        echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b_t.png"."' align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                    else {
                        if ( file_exists( $b_pic_gif)) {
                            echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b_t.gif"."' align='center' border='0'></a>";
                            $boolPicFound = 1;
                        }
                    }
                }
            }


            if ( $boolPicFound == 0) {
                if ( file_exists( $c_pic_jpg)) {
                    echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c_t.jpg"."' align='center' border='0'></a>";
                }
                else {
                    if ( file_exists( $c_pic_png)) {
                        echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c_t.png"."' align='center' border='0'></a>";
                    }
                    else {
                        if ( file_exists( $c_pic_gif)) {
                            echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c_t.gif"."' align='center' border='0'></a>";
                        }
                    }
                }
            }

        }
        else {
            echo "<a href='".$linkTarget."'><img src='".$mosConfig_live_site."/components/com_marketplace/images/system/nopic.gif' align='center' border='0'></a>";
        }

        echo "</center>";

        echo "</td>";

        echo "<td width='5' align='left' valign='center'>";
        	echo "&nbsp;";
        echo "</td>";

        echo "<td align='left' valign='top'>";
        	echo "<a href='".$linkTarget."'>".$row->ad_headline."</a><br>";
        	echo "<font size='-2'>";
        		$af_text = htmlspecialchars (substr($row->ad_text, 0, 100)."...");
        		echo $af_text;
        	echo "</font>";
        echo "</td>";

        echo "</tr>";
        echo "</table>";


        echo "</td>";


        echo "<td width='5%' valign='center' style='text-align: center;'>";
                echo $row->views;
        echo "</td>";

        if ( $use_price) {
            echo "<td width='8%' align='center' valign='center'>";
                echo "<center>";
                    echo $row->ad_price;
                echo "</center>";
            echo "</td>";
        }

        echo "<td width='10%' align='center' valign='center'>";
            // get ad type from db
            $database->setQuery( "SELECT id, name FROM #__marketplace_types WHERE id='$row->ad_type'");
            $rows_types = $database->loadObjectList();
            $sAdType    = $rows_types[0]->name;

            echo "<center>";
                echo "<div id='jooAdType$row->ad_type'>";
                    echo $sAdType;
                echo "</div>";
            echo "</center>";
        echo "</td>";


        echo "<td width='15%' valign='center'>";
            echo "<center>";
            echo $row->date_created;
            echo "<br />";
            echo "<font size='-2'>";
            echo JOO_FROM;
            echo "<b>".$row->user."</b>";
            echo "</font>";

			if( $bAdminMode == true  || $bModeratorMode == true || ($catid == 0)) { // admin or moderator or own
            	echo "<br />";
        		if ( $boolPublished == 1) {
    				echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/published.gif' title='".JOO_PUBLISHED."' alt='".JOO_PUBLISHED."' border='0' align='bottom'>";
        		}
        		else {
    				echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/unpublished.gif' title='".JOO_UNPUBLISHED."' alt='".JOO_UNPUBLISHED."' border='0' align='bottom'>";
        		}
			}

            echo "</center>";
        echo "</td>";

echo "</tr>";
echo "</table>";
echo "</div>";

echo "</td>";


        echo "</tr>";  // tr loop

        $boolTopStart = 0;

    }

    echo "</table>";
    echo "<br />";



    echo "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
    echo "<tr>";
    echo "<td align='left'>";
    if ( $total > 0) {
        echo "&nbsp;".JOO_ENTRIES1." ".($limitstart+1)." ".JOO_ENTRIES2." ".($limitstart+$nn)." ".JOO_ENTRIES3." ".$total;
    }
    else {
        echo "&nbsp;".JOO_NOENTRIES;
    }
    echo "</td>";
    echo "</tr>";
    echo "</table>";

    echo "<br />";



	// paging
	if ( !class_exists( "JConfig")) {  // we are on 1.0.x
		require_once("includes/pageNavigation.php");
		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		echo "<center>";
			if ( strlen( $searchtext) >= 1) {
				echo $pageNav->writePagesLinks("index.php?option=com_marketplace&amp;page=show_category&amp;catid=$catid&amp;Itemid=$Itemid&amp;total=$total&amp;ad_type=$ad_type&amp;searchtext=$searchtext");
			}
			else {
				echo $pageNav->writePagesLinks("index.php?option=com_marketplace&amp;page=show_category&amp;catid=$catid&amp;Itemid=$Itemid&amp;total=$total&amp;ad_type=$ad_type");
			}
		echo "</center>";
	}
	else { // J 1.5
		// use a modified version of pagination.php
		require_once("components/com_marketplace/pagination.php");
		$pagination = new JPagination( $total, $limitstart, $limit );
		$pagination->ad_type = $ad_type;

		if ( strlen( $searchtext) > 0) {
			$pagination->searchtext = $searchtext;
		}

		echo "<center>";
			echo $pagination->getPagesLinks();
		echo "</center>";
	}

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