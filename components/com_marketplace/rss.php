<?php
/**
 * rss.php
 *
 * included by all frontend files,
 * gets version info from the database and displays it in the page-footer
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

	// all ads
	if ( !class_exists( "JConfig")) {  // Joomla 1.0.x
		$linkRssPart = sefRelToAbs( "index2.php?option=com_marketplace&page=rss&Itemid=".$Itemid);
		$linkTagRssAll = $linkRssPart;
	}
	else {  // we are on 1.5.x
		$linkRssPart = sefRelToAbs( "index.php?option=com_marketplace&page=rss&format=raw&Itemid=".$Itemid);
		$linkTagRssAll = $linkRssPart;
	}

	$headerTagRssAll = "<link rel='alternate' type='application/rss+xml' title='Marketplace Classifieds Ads - All ads' href='".$linkTagRssAll."' />";
	$mainframe->addCustomHeadTag( $headerTagRssAll);


	// category ads
	if ( $catid > 0) {  // no feed for my ads
		if ( !class_exists( "JConfig")) {  // Joomla 1.0.x
			$linkRssPart = sefRelToAbs( "index2.php?option=com_marketplace&page=rss&catid=".$catid."&Itemid=".$Itemid);
			$linkTagRssCat = $linkRssPart;
		}
		else {   // we are on 1.5.x
			$linkRssPart = sefRelToAbs( "index.php?option=com_marketplace&page=rss&catid=".$catid."&format=raw&Itemid=".$Itemid);
			$linkTagRssCat = $linkRssPart;
		}

    	$headerTagRssCat = "<link rel='alternate' type='application/rss+xml' title='Marketplace Classifieds Ads - ".$cat_name."' href='".$linkTagRssCat."' />";
		$mainframe->addCustomHeadTag( $headerTagRssCat);
	}

?>
