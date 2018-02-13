<?php
/**
 * search.php
 *
 * advanced search in ads,
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



// set page title
$mainframe->SetPageTitle( JOO_TITLE." - " .JOO_SEARCH );


// get marketplace configuration data
$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$config = $database->loadObjectList();
$ad_default    = $config[0]->ad_default;
$use_surname   = $config[0]->use_surname;
$use_street    = $config[0]->use_street;
$use_zip       = $config[0]->use_zip;
$use_city      = $config[0]->use_city;
$use_state     = $config[0]->use_state;
$use_country   = $config[0]->use_country;
$use_web       = $config[0]->use_web;
$use_phone1    = $config[0]->use_phone1;
$use_phone2    = $config[0]->use_phone2;
$use_condition = $config[0]->use_condition;
$use_price     = $config[0]->use_price;
$rss_syndication            = (int)$config[0]->rss_syndication;


// set news feed icon if rss syndication is enabled
if( $rss_syndication == 1) {
	include($mosConfig_absolute_path.'/components/com_marketplace/rss.php');
}



$cat_name 			= JOO_SEARCHFORM;
$cat_description 	= JOO_SEARCHFORM_TEXT;
$cat_image 			= "search.gif";
$mainframe->SetPageTitle( JOO_TITLE." - " .JOO_SEARCHFORM );



echo "<table width='100%' border='0'>";
echo "<tr>";
echo "<td align='left'>";

include($mosConfig_absolute_path.'/components/com_marketplace/topmenu.php');
// -------------------------------------------------------------------------------

$username=$my->username;
$userid=$my->id;



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
    echo "<br />";


    $action = sefRelToAbs( "index.php?option=com_marketplace&page=list&Itemid=".$Itemid);
	?>

    <!-- form -->
    <form class="marketplace" action="<?php echo $action;?>" method="post" name="search" enctype="multipart/form-data">



			<br />

			<!-- ad headline -->
				<label class="marketplace" for="ad_headline"><?php echo JOO_FORM_AD_HEADLINE; ?></label>
				<?php
				    echo "<input class='marketplace' id='ad_headline' type='text' name='ad_headline' maxlength='80'>";
				?>
			<!-- ad headline -->



			<!-- zip -->
			<?php
			if ($use_zip) {
	        ?>
				<br />
				<label class="marketplace" for="zip"><?php echo JOO_FORM_ZIP; ?></label>
					<?php
				    echo "<input class='marketplace' id='zip' type='text' name='zip' maxlength='10'>";
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
				    echo "<input class='marketplace' id='city' type='text' name='city'>";
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
				    echo "<input class='marketplace' id='state' type='text' name='state'>";
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
				    echo "<input class='marketplace' id='country' type='text' name='country'>";
			}
	        ?>
			 <!-- country -->



			<br />




			<!-- condition -->
			<?php
			if ($use_condition) {
	        ?>
				<br />
				<label class="marketplace" for="ad_condition"><?php echo JOO_FORM_CONDITION; ?></label>
				<?php
				    echo "<input class='marketplace' id='ad_condition' type='text' name='ad_condition' maxlength='50'>";
			}
	        ?>
			<!-- condition -->



			<br />
			<br />


			<!-- buttons -->
				<label class="marketplace" for="ad_dummy"> </label>
				<input type="hidden" name="gflag" value="0">
				<?php
				echo "<input type='hidden' name='isUpdateMode' value='$isUpdateMode'>";
				echo "<input type='hidden' name='adid' value='$adid'>";
				echo "<input type='hidden' name='userid' value='$userid'>";
				echo "<input type='hidden' name='username' value='$username'>";
				echo "<input type='hidden' name='mode' value='db'>";
				echo "<input type='hidden' name='ad_type' value='0'>";
				echo "<input type='hidden' name='category' value='0'>";
				echo "<input type='hidden' name='ad_text' value=''>";
				?>
				<input class="button" type="submit" name="submit" value=<?php echo JOO_FORM_SEARCH; ?>>
			<!-- buttons -->


		  </form>
		  <!-- form -->




<?php


echo "<br />";
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
include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
echo "</td>";
echo "</tr>";


echo "</table>";

?>

