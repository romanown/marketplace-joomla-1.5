<?php
/**
 * marketplace.php
 *
 * This file controls the frontend calls
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


$page    = strval( mosGetParam( $_REQUEST, 'page', '' ) );
$catid   = intval( mosGetParam( $_REQUEST, 'catid', '0' ) );
$Itemid  = intval( mosGetParam( $_REQUEST, 'Itemid', '0' ) );


// get language for marketplace
if(file_exists($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/'.$mainframe->getCfg('lang').'.php')) {
  require_once($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/'.$mainframe->getCfg('lang').'.php');
}
else {
  require_once($mainframe->getCfg('absolute_path').'/components/com_marketplace/language/english.php');
}

$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
$marketplace_config 	= $database->loadObjectList();
$rss_syndication 		= (int)$marketplace_config[0]->rss_syndication;
$rss_count       		= (int)$marketplace_config[0]->rss_count;
$paypal_businessid  	= (string)$marketplace_config[0]->paypal_businessid;
$use_paypal_testmode	= (int)$marketplace_config[0]->use_paypal_testmode;


switch ($page) {


  case 'show_category': {
    include($mosConfig_absolute_path.'/components/com_marketplace/show_category.php');
    break;
  }

  case 'show_rules': {
    include($mosConfig_absolute_path.'/components/com_marketplace/show_rules.php');
    break;
  }

  case 'show_ad': {
    include($mosConfig_absolute_path.'/components/com_marketplace/show_ad.php');
    break;
  }

  case 'write_ad': {
    include($mosConfig_absolute_path.'/components/com_marketplace/write_ad.php');
    break;
  }

  case 'delete_ad': {
    include($mosConfig_absolute_path.'/components/com_marketplace/delete_ad.php');
    break;
  }

  case 'search': {
    include($mosConfig_absolute_path.'/components/com_marketplace/search.php');
    break;
  }

  case 'list': {
    include($mosConfig_absolute_path.'/components/com_marketplace/list.php');
    break;
  }

  case 'ipn': {
		paypal_ipn( $option, $paypal_businessid, $use_paypal_testmode);
    break;
  }

  case 'rss': {
    if ( $rss_syndication == 1) {
        $no_html = 1;
        header("Content-Type: text/xml");
        rss( $catid, $rss_count, $Itemid);
    }
    break;
  }

  default: {
    echo "<!-- ".$marketplace_config[0]->company." ".$marketplace_config[0]->author." ";
    echo $marketplace_config[0]->extension." ".$marketplace_config[0]->version." -->";
    include($mosConfig_absolute_path.'/components/com_marketplace/show_index.php');
    echo "<a href='http://".$marketplace_config[0]->company_url."' target='_blank'>&nbsp;</a>";
    break;
  }

}


function paypal_ipn( $option, $paypal_businessid, $use_paypal_testmode) {
	global $database;
	global $mosConfig_absolute_path;

	$checkBusinessId	= 1;  // check ID for security reason

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';

	foreach ( $_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}

	// post back to PayPal system to validate
	$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

	if( $use_paypal_testmode == 1) {
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
	} else {
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
	}

	// assign posted variables to local variables
	$item_number 		= intval( $_POST['item_number']);
	$item_name 			= $_POST['item_name'];
	$payment_status 	= $_POST['payment_status'];
	$payment_amount 	= $_POST['mc_gross'];
	$payment_currency 	= $_POST['mc_currency'];
	$txn_id 			= $_POST['txn_id'];
	$receiver_email 	= $_POST['receiver_email'];
	$payer_email 		= $_POST['payer_email'];


    // create log entry
    $sql = "INSERT INTO #__marketplace_log_paypal (
						item_number, item_name, payment_status, payment_amount, payment_currency,
						txn_id, receiver_email, payer_email, date_created, time_created
					)
					VALUES (
						'$item_number', '$item_name', '$payment_status', '$payment_amount', '$payment_currency',
						'$txn_id', '$receiver_email', '$payer_email', CURRENT_DATE(), CURRENT_TIME()
					)";

    $database->setQuery( $sql);

    if ($database->getErrorNum()) {
    	echo $database->stderr();
    } else {
        $database->query();
    }


	if ( !$fp) {
		// HTTP ERROR
	} else {
		fputs ( $fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp ($res, "VERIFIED") == 0) {

				// check the payment_status is Completed
				if ( strcmp( $payment_status, 'Completed') == 0 ) {

					// check that receiver_email is your Primary PayPal email
					if (strcmp( $receiver_email, $paypal_businessid) == 0) {

						// publish ad
						// payment 0=none, 1=offline, 2=paypal
            			$sql = "UPDATE #__marketplace_ads
								 	SET published 			= '1',
								 		payment				= '2',
									 	date_lastmodified 	= CURRENT_DATE()
								 	WHERE id = $item_number ";

            			$database->setQuery( $sql);

            			if ($database->getErrorNum()) {
                			echo $database->stderr();
            			} else {
                			$database->query();
            			}

					}

				}

				// check that payment_amount/payment_currency are correct
				// process payment
			}
			else if (strcmp ($res, "INVALID") == 0) {
				// log for manual investigation
			}
		}
		fclose ($fp);
	}


}


function rss( $catid, $rss_count, $Itemid) {
	global $mosConfig_sitename;
	global $mosConfig_live_site;
	global $database;

	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<rss version="2.0">';

	echo '<channel>';

	echo "\n<title>".$mosConfig_sitename." - ".JOO_TITLE."</title>";

	echo "\n<link>$mosConfig_live_site</link>";

	echo "\n<description>".$mosConfig_sitename." - ".JOO_TITLE."</description>";

	echo "\n<copyright>(c) ".$mosConfig_sitename."</copyright>";


	if ( $catid == 0) { // all ads
		$query = "SELECT id, category, user, ad_headline, ad_text FROM #__marketplace_ads WHERE published ='1' ORDER BY date_created DESC, id DESC LIMIT ".$rss_count;
	}
	else {
		$query = "SELECT id, category, user, ad_headline, ad_text FROM #__marketplace_ads WHERE category='".$catid."' AND published ='1' ORDER BY date_created DESC, id DESC LIMIT ".$rss_count;
	}
	$database->setQuery( $query);
	$rows = $database->loadObjectList();

	if ( count( $rows) > 0) {
		foreach( $rows as $row) {

			echo "\n<item>";
				$linkTitle = htmlspecialchars( $row->ad_headline);
				echo "\n<title>$linkTitle</title>";

				echo "\n<description>";
				    echo htmlspecialchars( $row->ad_text);
				echo '</description>';


				$linkTarget = sefRelToAbs( "index.php?option=com_marketplace&amp;page=show_ad&amp;catid=".$row->category."&amp;adid=".$row->id ."&amp;Itemid=".$Itemid);
				echo "\n<link>";
				    echo $linkTarget;
				echo "</link>";

				echo "\n<author>";
				    echo $row->user;
				echo '</author>';

				echo "\n<guid isPermaLink='false'>";
				    echo $row->id;
				echo "</guid>";

                echo "\n<category>";
                    $database->setQuery( "SELECT name FROM #__marketplace_categories WHERE published='1' AND id=$row->category");
                    $category_name = $database->loadResult();
				    echo $category_name;
				echo '</category>';

			echo '</item>';

		}
	}
	echo "\n</channel>";
	echo "\n</rss>";
}

?>

