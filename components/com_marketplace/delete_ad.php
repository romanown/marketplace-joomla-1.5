<?php
/**
 * delete.php
 *
 * deletes ads and ad-images
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

$mode         = strval( mosGetParam( $_REQUEST, 'mode', '' ) );

$picext = array('gif', 'jpg', 'png');


// set page title
$mainframe->SetPageTitle( JOO_TITLE." - " .JOO_AD_DELETE );



// get configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();

$images_per_ad          	= (int)$config[0]->images_per_ad;



// get marketplace ad
$database->setQuery("SELECT category, userid, ad_headline FROM #__marketplace_ads WHERE id=$adid");
$rows = $database->loadObjectList();

$ad_category        = $rows[0]->category;
$ad_userid		    = $rows[0]->userid;
$ad_headline 	    = $rows[0]->ad_headline;



// get marketplace user data
$database->setQuery("SELECT * FROM #__marketplace_users WHERE userid = '$my->id' AND published = '1' AND date_begin <= curdate() AND date_end >= curdate() ORDER BY date_begin ASC, date_end ASC");
$marketplace_users = $database->loadObjectList();
$marketplace_users_entry_count = count( $marketplace_users);

$marketplace_users_isAdmin          = $marketplace_users[0]->isAdmin;
$marketplace_users_isModerator      = $marketplace_users[0]->isModerator;
$marketplace_users_categories       = $marketplace_users[0]->categories;





echo "<table width='100%'>";
  echo "<tr>";
    echo "<td align='left'>";

      include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');
      // -------------------------------------------------------------------------------

    $username=strtolower($my->username);
    $userid=strtolower($my->id);

    if ($userid == "0") { // user not logged in
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
						echo JOO_DELETE_NOTALLOWED;
					echo "</td>";
				 echo "</tr>";
			   echo "</table>";
			   echo "<br />";
			   echo "<br />";
			   echo "<br />";
			   echo "<br />";
    }
    else {  // user logged in

		if ( $mode=="db") {

		    // check if user has permission to delete this ad
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

			    $sql = "DELETE FROM #__marketplace_ads WHERE id=$adid";

			    $database->setQuery( $sql);

			    if ($database->getErrorNum()) {
					echo $database->stderr();
			    } else {
				    $database->query();
				}



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


		   	    echo "<br />";
		   	    echo "<br />";


                echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                     echo "<tr>";
                         echo "<td width=\"20\">";
                             echo "&nbsp;";
                         echo "</td>";
                         echo "<td>";
                             echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/success.gif\" border=\"0\" align=\"center\">";
                         echo "</td>";
                         echo "<td>";
                             echo JOO_DELETE_OK;
                         echo "</td>";
                     echo "</tr>";
                 echo "</table>";

            }
            else {
		   	     echo "<br />";
		   	     echo "<br />";

                 echo "<table cellspacing=\"10\" cellpadding=\"5\">";
                     echo "<tr>";
                         echo "<td width=\"20\">";
                             echo "&nbsp;";
                         echo "</td>";
                         echo "<td>";
                             echo "<img src=\"".$mosConfig_live_site."/components/com_marketplace/images/system/warning.gif\" border=\"0\" align=\"center\">";
                         echo "</td>";
                         echo "<td>";
                             echo JOO_NO_DELETE_PERMISSION;
                         echo "</td>";
                     echo "</tr>";
                 echo "</table>";

            }


		}
		else {

			echo "<br>";
			echo "<font color='#990000'>";
				echo "&nbsp;&nbsp;&nbsp;".JOO_CAUTION." <b>".$my->username."</b> ".JOO_CAUTION_DELETE1."<b>".$adid."</b>".JOO_CAUTION_DELETE2." (".$ad_headline.")";
    		echo "</font>";
			echo "<br />";
			echo "<br />";
			echo "<br />";
			echo "<br />";

        	echo "<table class=\"marketplace_header\">";
          	echo "<tr class=\"marketplace_header\">";

            	echo "<td class=\"marketplace_header\">";
            		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            	echo "</td>";

            	echo "<td class=\"marketplace_header\">";
            		echo "<a href=".sefRelToAbs( "index.php?option=com_marketplace&amp;page=delete_ad&amp;adid=$adid&amp;mode=db&amp;Itemid=$Itemid").">".JOO_YES_DELETE."</a>";
            	echo "</td>";

            	echo "<td class=\"marketplace_header\">";
            		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            	echo "</td>";

            	echo "<td class=\"marketplace_header\">";
					echo "<a href=".sefRelToAbs( "index.php?option=com_marketplace&amp;Itemid=$Itemid").">".JOO_NO_DELETE."</a>";
            	echo "</td>";

          	echo "</tr>";
        	echo "</table>";

    	}


    } // user logged in

	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

      // -------------------------------------------------------------------------------
    echo "</td>";
  echo "</tr>";

  echo "<tr>";
    echo "<td class='small' align='center'>";
      include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
    echo "</td>";
  echo "</tr>";


echo "</table>";


?>
