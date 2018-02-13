<?php
/**
 * list.php
 *
 * Displays the ad-list (category, searchresults) as a listing with thumbnails of ad images
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
	$Itemid     		= intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );
	$nn         		= intval( mosGetParam( $_REQUEST, 'nn', '0' ) );
	$total         		= intval( mosGetParam( $_REQUEST, 'total', '0' ) );
	$limitstart    		= intval( mosGetParam( $_REQUEST, 'limitstart', '0' ) );
	$search_type      	= intval( mosGetParam( $_REQUEST, 'ad_type', '0' ) );
	$search_category    = intval( mosGetParam( $_REQUEST, 'category', '0' ) );
	$search_headline    = strval( mosGetParam( $_REQUEST, 'ad_headline', '' ) );
	$search_text        = strval( mosGetParam( $_REQUEST, 'ad_text', '' ) );
	$search_zip         = strval( mosGetParam( $_REQUEST, 'zip', '' ) );
	$search_city        = strval( mosGetParam( $_REQUEST, 'city', '' ) );
	$search_state       = strval( mosGetParam( $_REQUEST, 'state', '' ) );
	$search_country     = strval( mosGetParam( $_REQUEST, 'country', '' ) );
	$search_condition   = strval( mosGetParam( $_REQUEST, 'ad_condition', '' ) );
}
else {
	$Itemid     		= intval( JRequest::getVar( 'Itemid', '0' ) );
	$nn      			= intval( JRequest::getVar( 'nn', '0' ) );
	$total      		= intval( JRequest::getVar( 'total', '0' ) );
	$limitstart    		= intval( JRequest::getVar( 'limitstart', '0' ) );
	$search_type      	= intval( JRequest::getVar( 'ad_type', '0' ) );
	$search_category    = intval( JRequest::getVar( 'category', '0' ) );
	$search_headline	= strval( JRequest::getVar( 'ad_headline', '' ) );
	$search_text		= strval( JRequest::getVar( 'ad_text', '' ) );
	$search_zip			= strval( JRequest::getVar( 'zip', '' ) );
	$search_city		= strval( JRequest::getVar( 'city', '' ) );
	$search_state		= strval( JRequest::getVar( 'state', '' ) );
	$search_country		= strval( JRequest::getVar( 'country', '' ) );
	$search_condition	= strval( JRequest::getVar( 'ad_condition', '' ) );
}



// get marketplace user data
$dateToday = date("Y-m-d");
$database->setQuery("SELECT * FROM #__marketplace_users WHERE userid = '$my->id' AND published = '1' AND date_begin <= curdate() AND date_end >= curdate() ORDER BY date_begin ASC, date_end ASC ");
$marketplace_users = $database->loadObjectList();
$marketplace_users_entry_count = count( $marketplace_users);

$marketplace_users_isAdmin          = (int)$marketplace_users[0]->isAdmin;
$marketplace_users_categories       = (string)$marketplace_users[0]->categories;
$marketplace_users_isBlocked        = (int)$marketplace_users[0]->isBlocked;
$marketplace_users_flagTop          = (int)$marketplace_users[0]->flag_top;
$marketplace_users_flagFeatured     = (int)$marketplace_users[0]->flag_featured;
$marketplace_users_flagCommercial   = (int)$marketplace_users[0]->flag_commercial;

$bAdminMode = false; // defined start value
if ( $marketplace_users_isAdmin == 1) {
	$bAdminMode = true;
}


// default = empty where clause
$sWhereClause = "";

if ( $search_type > 0) {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE ad_type='$search_type'";
	}
}

if ( $search_category > 0) {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE category='$search_category'";
	}
	else {
		$sWhereClause .= " AND category='$search_category'";
	}
}

if ( trim( $search_headline) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE ad_headline like '%".$search_headline."%'";
	}
	else {
		$sWhereClause .= " AND ad_headline like '%".$search_headline."%'";
	}
}

if ( trim( $search_text) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE ad_text like '%".$search_text."%'";
	}
	else {
		$sWhereClause .= " AND ad_text like '%".$search_text."%'";
	}
}

if ( trim( $search_zip) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE zip like '%".$search_zip."%'";
	}
	else {
		$sWhereClause .= " AND zip like '%".$search_zip."%'";
	}
}

if ( trim( $search_city) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE city like '%".$search_city."%'";
	}
	else {
		$sWhereClause .= " AND city like '%".$search_city."%'";
	}
}

if ( trim( $search_state) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE state like '%".$search_state."%'";
	}
	else {
		$sWhereClause .= " AND state like '%".$search_state."%'";
	}
}

if ( trim( $search_country) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE country like '%".$search_country."%'";
	}
	else {
		$sWhereClause .= " AND country like '%".$search_country."%'";
	}
}

if ( trim( $search_condition) != "") {
	if ( $sWhereClause == "") { // first
		$sWhereClause .= " WHERE ad_condition like '%".$search_condition."%'";
	}
	else {
		$sWhereClause .= " AND ad_condition like '%".$search_condition."%'";
	}
}


// make sure that we only get the published ads
if ( $sWhereClause == "") {
	if( $bAdminMode == true) { // admin
		$sWhereClause .= "";
	}
	else {
		$sWhereClause .= " WHERE published=1";
	}
}
else {
	if( $bAdminMode == true) { // admin
		$sWhereClause .= "";
	}
	else {
		$sWhereClause .= " AND published=1";
	}
}



// get configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();
$show_recent5    = (int)$config[0]->show_recent5;
$use_price       = (int)$config[0]->use_price;
$rss_syndication = (int)$config[0]->rss_syndication;
$limit	 		 = (int)$config[0]->ads_per_page;



// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}



$cat_name 			= JOO_SEARCHRESULTS;
$cat_description 	= JOO_SEARCHRESULTS_TEXT;
$cat_image 			= "search.gif";
$mainframe->SetPageTitle( JOO_TITLE." - " .JOO_SEARCHRESULTS );



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


    if ( $show_recent5 == 1) {
        include($mosConfig_absolute_path.'/components/com_marketplace/recent5.php');
        echo "<br>";
        echo "<br>";
    }



    echo "<table width='100%' border='0'>";
        echo "<tr>";

            echo "<td align='center' valign='top' width='20'>";
                echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/".$cat_image."' align='center' border='0'>";
            echo "</td>";

            echo "<td width='5' align='left' valign='center'>";
                echo "&nbsp;";
            echo "</td>";

            echo "<td align='left' valign='center'>";
                echo "<b>";
                echo $cat_name;
                echo "</b>";
                echo "<font size='-2'>";
                echo "<br>".$cat_description;
                echo "</font>";
            echo "</td>";

        echo "</tr>";
    echo "</table>";


    echo "<br />";


    $count = $limit;

    // count entries
    if( $limitstart == 0) {

    	$database->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads".$sWhereClause );

        $total = $database->loadResult();

        if ($total <= $limit) {
                $limitstart = 0;
        }
    }


    $database->setQuery("SELECT id, category, user, ad_type, ad_headline, ad_text, ad_image, ad_price,
				  				date_created, views,
				  				flag_featured, flag_top, flag_commercial, published, siten, siteid
			   				FROM #__marketplace_ads".$sWhereClause." ORDER BY date_created DESC
			   				LIMIT $limitstart, $count");

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



        if ( $use_price) {
            echo "<th width='8%'  style='text-align: center;'>".JOO_PRICE."</th>";
        }

 
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
// echo "id ".$row->id;
		if ( $row->siteid > 1) {$row->id = $row->siteid ;}
  if ( strlen($row->siten) > 0) {
	  if ($row->siten <> 'reklama-31')
	  {
	  $row->siten = $row->siten.".";}
	  else {$row->siten = '';}
	 }
//	 echo $row->siten".";
        $linkTarget = sefRelToAbs( "http://".$row->siten."reklama-31.ru/index.php?option=com_marketplace&amp;page=show_ad&amp;catid=".$row->category."&amp;adid=".$row->id."&amp;Itemid=".$Itemid);

        echo "<tr>";


            // first decide what kind of ad it is
            if ($boolCommercial == 1) { // commercial ad
              //echo "<div class='jooCommercial'>";
              $sDiv = "<div class='jooCommercial'>";
            }
            else { // private ad
                if ($boolFeatured == 1) { // featured ad
                    //echo "<div class='jooFeatured'>";
                    $sDiv = "<div class='jooFeatured'>";
                }
                else { // normal ad
                    //echo "<div class='jooNormal'>";
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
 		if ( $row->siteid > 1) {
            $a_pic_jpg = "http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."a.jpg";
            $a_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a.png";
            $a_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a.gif";

            $b_pic_jpg = "http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."b.jpg";
            $b_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b.png";
            $b_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b.gif";

            $c_pic_jpg = "http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."c.jpg";
            $c_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c.png";
            $c_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c.gif";
//  echo "id ".$row->id." siteid ".$row->siteid." pic ".$a_pic_jpg;
            $boolPicFound = 0;

            if ( @fopen($a_pic_jpg, "r")) {
                echo "<a href='".$linkTarget."' target=_blank><img src='"."http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."a.jpg"."' width='300' height='250'  align='center' border='0'></a>";
                $boolPicFound = 1;
            }
            else {
                if ( file_exists( $a_pic_png)) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a.png"."' width='300' height='250' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $a_pic_gif)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a.gif"."' width='300' height='250'  align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                }
            }


            if ( $boolPicFound == 0) {
               if ( @fopen($a_pic_jpg, "r")) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='"."http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."b.jpg"."' width='300' height='250' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $b_pic_png)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b.png"."' width='300' height='250' align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                    else {
                        if ( file_exists( $b_pic_gif)) {
                            echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b.gif"."' width='300' height='250' align='center' border='0'></a>";
                            $boolPicFound = 1;
                        }
                    }
                }
            }


            if ( $boolPicFound == 0) {
               if ( @fopen($a_pic_jpg, "r")) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='"."http://".$row->siten."reklama-31.ru/components/com_marketplace/images/entries/".$row->id."c.jpg"."' width='300' height='250' align='center' border='0'></a>";
                }
                else {
                    if ( file_exists( $c_pic_png)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c.png"."' width='300' height='250' align='center' border='0'></a>";
                    }
                    else {
                        if ( file_exists( $c_pic_gif)) {
                            echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c.gif"."' width='300' height='250' align='center' border='0'></a>";
                        }
                    }
                }
            }
			}
else {
            $a_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a.jpg";
            $a_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a.png";
            $a_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."a.gif";

            $b_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b.jpg";
            $b_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b.png";
            $b_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."b.gif";

            $c_pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c.jpg";
            $c_pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c.png";
            $c_pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$row->id."c.gif";
//  echo "id ".$row->id." siteid ".$row->siteid." pic ".$a_pic_jpg;
            $boolPicFound = 0;

	if ( file_exists($a_pic_jpg)) {
                echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a.jpg"."' align='center' border='0'></a>";
                $boolPicFound = 1;
            }
            else {
                if ( file_exists( $a_pic_png)) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a.png"."' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $a_pic_gif)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."a.gif"."' align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                }
            }


            if ( $boolPicFound == 0) {
               if ( file_exists($b_pic_jpg)) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b.jpg"."' align='center' border='0'></a>";
                    $boolPicFound = 1;
                }
                else {
                    if ( file_exists( $b_pic_png)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b.png"."' align='center' border='0'></a>";
                        $boolPicFound = 1;
                    }
                    else {
                        if ( file_exists( $b_pic_gif)) {
                            echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."b.gif"."' align='center' border='0'></a>";
                            $boolPicFound = 1;
                        }
                    }
                }
            }


            if ( $boolPicFound == 0) {
               if ( file_exists($c_pic_jpg)) {
                    echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c.jpg"."' align='center' border='0'></a>";
                }
                else {
                    if ( file_exists( $c_pic_png)) {
                        echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c.png"."' align='center' border='0'></a>";
                    }
                    else {
                        if ( file_exists( $c_pic_gif)) {
                            echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$row->id."c.gif"."' align='center' border='0'></a>";
                        }
                    }
                }
            }
}
        }
        else {
            echo "<a href='".$linkTarget."' target=_blank><img src='".$mosConfig_live_site."/components/com_marketplace/images/system/nopic.gif' align='center' border='0'></a>";
        }

        echo "</center>";

        echo "</td>";

        echo "<td width='5' align='left' valign='center'>";
        echo "&nbsp;";
        echo "</td>";

        echo "<td align='left' valign='top'>";
        echo "<a href='".$linkTarget."' target=_blank>".$row->ad_headline."</a><br>";
        echo "<font size='-2'>";
        $af_text = htmlspecialchars (substr($row->ad_text, 0, 100)."...");
        echo $af_text;
        echo "</font>";
        echo "</td>";

        echo "</tr>";
        echo "</table>";


        echo "</td>";




        if ( $use_price) {
            echo "<td width='8%' align='center' valign='center'>";
                echo "<center>";
                    echo $row->ad_price;
                echo "</center>";
            echo "</td>";
        }




        echo "<td width='15%' valign='center'>";
            echo "<center>";
            echo date("d-m-Y",strtotime($row->date_created));
            echo "<br />";
            echo "<font size='-2'>";
            echo JOO_FROM;
            echo "<b>".$row->user."</b>";
            echo "</font>";

			if( $bAdminMode == true) { // admin
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

			$pagingLink = "index.php?option=com_marketplace&amp;page=list";

			// ad_type: set always
			$pagingLink .= "&amp;ad_type=$search_type";

			// category: set always
			$pagingLink .= "&amp;category=$search_category";

			// ad_headline
			if ( strlen( $search_headline) > 0) {
				$pagingLink .= "&amp;ad_headline=$search_headline";
			}

			// ad_text
			if ( strlen( $search_text) > 0) {
				$pagingLink .= "&amp;ad_text=$search_text";
			}

			// zip
			if ( strlen( $search_zip) > 0) {
				$pagingLink .= "&amp;zip=$search_zip";
			}

			// city
			if ( strlen( $search_city) > 0) {
				$pagingLink .= "&amp;city=$search_city";
			}

			// state
			if ( strlen( $search_state) > 0) {
				$pagingLink .= "&amp;state=$search_state";
			}

			// country
			if ( strlen( $search_country) > 0) {
				$pagingLink .= "&amp;country=$search_country";
			}

			// condition
			if ( strlen( $search_condition) > 0) {
				$pagingLink .= "&amp;ad_condition=$search_condition";
			}

			// total
			$pagingLink .= "&amp;total=$total";

			// Itemid
			$pagingLink .= "&amp;Itemid=$Itemid";

			echo $pageNav->writePagesLinks( $pagingLink);

		echo "</center>";
	}
	else { // J 1.5

		// use a modified version of pagination.php
		require_once("components/com_marketplace/pagination.php");
		$pagination = new JPagination( $total, $limitstart, $limit );

		// ad_type: set always
		$pagination->ad_type = $search_type;

		// category: set always
		$pagination->search_category = $search_category;


		// ad_headline
		if ( strlen( $search_headline) > 0) {
			$pagination->search_headline = $search_headline;
		}

		// ad_text
		if ( strlen( $search_text) > 0) {
			$pagination->search_text = $search_text;
		}

		// zip
		if ( strlen( $search_zip) > 0) {
			$pagination->search_zip = $search_zip;
		}

		// city
		if ( strlen( $search_city) > 0) {
			$pagination->search_city = $search_city;
		}

		// state
		if ( strlen( $search_state) > 0) {
			$pagination->search_state = $search_state;
		}

		// country
		if ( strlen( $search_country) > 0) {
			$pagination->search_country = $search_country;
		}

		// ad_condition
		if ( strlen( $search_condition) > 0) {
			$pagination->search_condition = $search_condition;
		}


		echo "<center>";
			echo $pagination->getPagesLinks();
		echo "</center>";
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