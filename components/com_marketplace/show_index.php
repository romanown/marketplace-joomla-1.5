<?php
/**
 * show_index.php
 *
 * Displays the frontend main screen with all available categories
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

$Itemid       = intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );

$picext = array('gif', 'jpg', 'png');


// set page title
$mainframe->SetPageTitle( JOO_TITLE." - " .JOO_OVERVIEW );

// get configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();

$duration      						= (int)$config[0]->duration;
$date_deleted  						= $config[0]->date_deleted;
$show_recent5  						= (int)$config[0]->show_recent5;
$rss_syndication 					= (int)$config[0]->rss_syndication;
$emailFrom                        	= (string)$config[0]->email_from;
$emailFromName                    	= (string)$config[0]->email_from_name;
$use_author_email_notification    	= (int)$config[0]->use_author_email_notification;
$expiry_email_subject             	= (string)$config[0]->expiry_email_subject;
$expiry_email_text                	= (string)$config[0]->expiry_email_text;
$images_per_ad          			= (int)$config[0]->images_per_ad;



// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}


$database->setQuery( "SELECT CURRENT_DATE()");
$date_current = $database->loadResult();

if ( $date_current > $date_deleted) {

    $sql = "SELECT id, userid, user FROM #__marketplace_ads WHERE date_created < DATE_SUB( '$date_current', INTERVAL $duration DAY)";
    $database->setQuery( $sql);
    $rows = $database->loadObjectList();

    // delete all images from outdated ads
    foreach($rows as $row) {
        $adid = $row->id;


		// loop over configured # of images
		for ( $i = 1; $i <= $images_per_ad; $i += 1) {
			$c = chr( 96 + $i);

        	for($extid = 0, $nbext = sizeof($picext) ; $extid < $nbext ; $extid++) {

				// image delete
				$pict = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c."_t.".$picext[$extid];
				if ( file_exists( $pict)) {
					unlink( $pict);
				}
				$pic = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$adid.$c.".".$picext[$extid];
				if ( file_exists( $pic)) {
					unlink( $pic);
				}

        	}

		} // # of images


        // notification email to author
        if ( $use_author_email_notification == 1) {

            $database->setQuery( "SELECT email FROM #__users WHERE id='".$row->userid."'");
            $authorEmail        = $database->loadResult();
            $authorEmailSubject = $expiry_email_subject;
            $authorEmailText    = str_replace("[USERNAME]", $row->user, $expiry_email_text);

            // send email to author
            mosMail( $emailFrom, $emailFromName, $authorEmail, $authorEmailSubject, $authorEmailText);

        }

    }

    // now delete all outdated ads
    $sql = "DELETE FROM #__marketplace_ads WHERE date_created < DATE_SUB( '$date_current', INTERVAL $duration DAY)";

    $database->setQuery( $sql);

    if ($database->getErrorNum()) {
        echo $database->stderr();
    } else {
        $database->query();
    }

    // set delete marker on today
    $sql = "UPDATE #__marketplace_config SET date_deleted = CURRENT_DATE()";

    $database->setQuery( $sql);
    if ($database->getErrorNum()) {
        echo $database->stderr();
    } else {
        $database->query();
    }
}



// get marketplace user data
$dateToday = date("Y-m-d");
$database->setQuery("SELECT * FROM #__marketplace_users WHERE userid = '$my->id' AND published = '1' AND date_begin <= curdate() AND date_end >= curdate() ORDER BY date_begin ASC, date_end ASC ");
$marketplace_users = $database->loadObjectList();
$marketplace_users_entry_count = count( $marketplace_users);

$marketplace_users_isAdmin          = (int)$marketplace_users[0]->isAdmin;
$marketplace_users_isModerator      = (int)$marketplace_users[0]->isModerator;
$marketplace_users_categories       = (string)$marketplace_users[0]->categories;

$bAdminMode = false; // defined start value
if ( $marketplace_users_isAdmin == 1) {
	$bAdminMode = true;
}



echo "<table width='100%'>";
echo "<tr>";
echo "<td align='left'>";

include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');

if ( $show_recent5 == 1) {
    include($mosConfig_absolute_path.'/components/com_marketplace/recent5.php');
    echo "<br>";
    echo "<br>";
}


// build index-page: marketplace_categories
$database->setQuery("SELECT * FROM #__marketplace_categories WHERE published='1' ORDER BY sort_order");
$rows = $database->loadObjectList();


echo "<table class=\"jooTable\" cellspacing='1'>";

echo "<tr>";
    echo "<th width='65%'>".JOO_CATEGORY."</th>";
    echo "<th width='10%' style='text-align: center;'>".JOO_ENTRIES."</th>";
    echo "<th width='25%' style='text-align: center;'>".JOO_LASTENTRY."</th>";
echo "</tr>";


foreach($rows as $row) {
    if($row->has_entries == 0) {
        echo "<tr id=\"category_tablerow\">";
    }
    else {
        $linkTarget = sefRelToAbs( "index.php?option=com_marketplace&amp;page=show_category&amp;catid=".$row->id."&amp;Itemid=".$Itemid);
        echo "<tr id=\"category_tablerow\">";
    }

    if($row->has_entries == 0) {
        echo "<td id='index_tablecell_noentries' valign='top' align='left' colspan='3'>";
    }
    else {
        echo "<td id='index_tablecell' valign='top' align='left'>";
    }

    if($row->has_entries == 0) {
        echo "<br>";
        echo "<table width='100%' border='0'>";

        	echo "<tr>";

        		if ( strlen( trim($row->image)) > 0) {  // if image is set

                	echo "<td align='center' valign='top' width='20'>";
                    	echo "<center>";
                        	echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/categories/".$row->image."' align='center' border='0'>";
                    	echo "</center>";
                	echo "</td>";

        			echo "<td width='5' align='left' valign='center'>";
                    	echo "&nbsp;";
                	echo "</td>";

        		}

        		echo "<td align='left' valign='center'>";
        			echo "<b>".$row->name."</b><br>";
        			echo "<font size='-2'>";
        			echo $row->description;
        			echo "</font>";
        		echo "</td>";

        	echo "</tr>";

        echo "</table>";
    }
    else {
        echo "<table width='100%' border='0'>";
            echo "<tr>";

                echo "<td align='center' valign='top' width='20'>";
                    echo "<center>";
                      echo "<a href='$linkTarget'>";
                        echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/categories/".$row->image."' align='center' border='0'>";
                      echo "</a>";
                    echo "</center>";
                echo "</td>";

                echo "<td width='5' align='left' valign='center'>";
                    echo "&nbsp;";
                echo "</td>";

                echo "<td align='left' valign='center'>";
                    echo "<a href='$linkTarget'>".$row->name."</a><br>";
                    echo "<font size='-2'>";
                    echo $row->description;
                    echo "</font>";
                echo "</td>";

            echo "</tr>";
        echo "</table>";
    }
    echo "</td>";

    if($row->has_entries > 0) {
        echo "<td id='index_tablecellcenter' valign='center' align='center'>";

        // number of entries ttt
        // check if user is moderator of this category
		$bModeratorMode = false; // defined start value
		if ( $marketplace_users_isModerator == 1) {
			$token = strtok( $marketplace_users_categories, ',');
    		while( $token){
    			if ( $token == $row->id) {
        			$bModeratorMode = true;
        		}
        		$token = strtok( ',');
    		}
		}

		if( $bAdminMode == true  || $bModeratorMode == true) { // admin or moderator
	        $database->setQuery("SELECT COUNT(*) AS ad_count
                             				FROM #__marketplace_ads
                             				WHERE category='$row->id'");
		}
		else {
	        $database->setQuery("SELECT COUNT(*) AS ad_count
                             				FROM #__marketplace_ads
                             				WHERE category='$row->id' AND published='1'");
		}


        $rows_ads = $database->loadObjectList();

        foreach($rows_ads as $row_ad) {
            $ad_count = $row_ad->ad_count;
        }
        echo $ad_count;
        echo "</td>";
    }

    if($row->has_entries > 0) {
        echo "<td id='index_tablecellcenter' valign='center' align='center'>";

        // last entry

		if( $bAdminMode == true  || $bModeratorMode == true) { // admin or moderator
        	$database->setQuery("	SELECT user, date_format(date_created, '%d.%m.%Y' ) as date_cr
                                		FROM #__marketplace_ads
                             			WHERE category='$row->id'
				    					ORDER BY date_created DESC, id DESC
                                    	LIMIT 1");
		}
        else {
        	$database->setQuery("	SELECT user, date_format(date_created, '%d.%m.%Y' ) as date_cr
                                		FROM #__marketplace_ads
                             			WHERE category='$row->id' AND published='1'
				    					ORDER BY date_created DESC, id DESC
                                    	LIMIT 1");
        }


        $rows_date = $database->loadObjectList();

        $datum = "-";
        foreach($rows_date as $row_date) {
            $datum = $row_date->date_cr;
            $ad_username = $row_date->user;
        }
        echo $datum;

        if ( $ad_count > 0) {
            echo "<br />";
            echo "<font size='-2'>";
            echo JOO_FROM;
            echo "<b>".$ad_username."</b>";
            echo "</font>";
        }
        echo "</td>";
    }

    echo "</tr>";

}

echo "</table>";

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