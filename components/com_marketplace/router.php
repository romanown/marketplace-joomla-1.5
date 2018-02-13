<?php
/**
 * router.php
 *
 * responsible for SEF URLs in Joomla 1.5
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


function MarketplaceBuildRoute( &$query) {

    $segments = array();

    $count = 0;

    if (isset($query['page'])) {
        $segments[$count] = "page";
        $count++;
        $segments[$count] = $query['page'];
        $count++;

        unset($query['page']);
    }

    if (isset($query['catid'])) {
        $segments[$count] = "catid";
        $count++;
        $segments[$count] = $query['catid'];
        $count++;

        unset($query['catid']);
    }

    if (isset($query['adid'])) {
        $segments[$count] = "adid";
        $count++;
        $segments[$count] = $query['adid'];
        $count++;

        unset($query['adid']);
    }

    if (isset($query['mode'])) {
        $segments[$count] = "mode";
        $count++;
        $segments[$count] = $query['mode'];
        $count++;

        unset($query['mode']);
    }

    if (isset($query['format'])) {
        $segments[$count] = "format";
        $count++;
        $segments[$count] = $query['format'];
        $count++;

        unset($query['format']);
    }

    if (isset($query['itemid'])) {
        $segments[$count] = "itemid";
        $count++;
        $segments[$count] = $query['itemid'];
        $count++;

        unset($query['itemid']);
    }

    return $segments;
}



function MarketplaceParseRoute( $segments) {

	// Count route segments
	$count = count( $segments);

    $query = array();


	for ( $i=0; $i<$count; $i+=2) {

		switch ( $segments[$i]) { // check parameter

			case "page": {
				$query['page'] = $segments[$i+1];
				break;
			}

			case "catid": {
				$query['catid'] = $segments[$i+1];
				break;
			}

			case "adid": {
				$query['adid'] = $segments[$i+1];
				break;
			}

			case "mode": {
				$query['mode'] = $segments[$i+1];
				break;
			}

			case "format": {
				$query['format'] = $segments[$i+1];
				break;
			}

			case "itemid": {
				$query['itemid'] = $segments[$i+1];
				break;
			}

			default: {
				break;
			}

		}

	}


    return $query;
}




?>