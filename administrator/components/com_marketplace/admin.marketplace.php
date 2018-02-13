<?php
/**
 * admin.marketplace.php
 *
 * @package com_marketplace
 * @subpackage backend
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
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_marketplace' ))) {
    mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid = mosGetParam($_REQUEST, 'cid', array(0));

$id = mosGetParam( $_REQUEST, 'cid', array(0) );
if (!is_array( $id )) {
    $id = array(0);
}

$act    = strval( mosGetParam( $_REQUEST, 'act',  '' ) );
$option = strval( mosGetParam( $_REQUEST, 'option',  '' ) );

$cb_image1  = strval( mosGetParam( $_REQUEST, 'cb_image1', '' ) );
$cb_image2  = strval( mosGetParam( $_REQUEST, 'cb_image2', '' ) );
$cb_image3  = strval( mosGetParam( $_REQUEST, 'cb_image3', '' ) );
$cb_image4  = strval( mosGetParam( $_REQUEST, 'cb_image4', '' ) );
$cb_image5  = strval( mosGetParam( $_REQUEST, 'cb_image5', '' ) );
$cb_image6  = strval( mosGetParam( $_REQUEST, 'cb_image6', '' ) );
$cb_image7  = strval( mosGetParam( $_REQUEST, 'cb_image7', '' ) );
$cb_image8  = strval( mosGetParam( $_REQUEST, 'cb_image8', '' ) );
$cb_image9  = strval( mosGetParam( $_REQUEST, 'cb_image9', '' ) );
$cb_image10  = strval( mosGetParam( $_REQUEST, 'cb_image10', '' ) );
$cb_image11  = strval( mosGetParam( $_REQUEST, 'cb_image11', '' ) );
$cb_image12  = strval( mosGetParam( $_REQUEST, 'cb_image12', '' ) );
$cb_image13  = strval( mosGetParam( $_REQUEST, 'cb_image13', '' ) );
$cb_image14  = strval( mosGetParam( $_REQUEST, 'cb_image14', '' ) );
$cb_image15  = strval( mosGetParam( $_REQUEST, 'cb_image15', '' ) );
$cb_image16  = strval( mosGetParam( $_REQUEST, 'cb_image16', '' ) );
$cb_image17  = strval( mosGetParam( $_REQUEST, 'cb_image17', '' ) );
$cb_image18  = strval( mosGetParam( $_REQUEST, 'cb_image18', '' ) );
$cb_image19  = strval( mosGetParam( $_REQUEST, 'cb_image19', '' ) );
$cb_image20  = strval( mosGetParam( $_REQUEST, 'cb_image20', '' ) );


global $mosConfig_live_site;

?>

<br />

<?php
// show menu only when on Joomla 1.0.x
if ( !class_exists( "JConfig")) {  // check if we are on Joomla 1.5
	?>
	<center>
		<table>
			<tr>
				<td>
					<div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/config.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=configuration'>Конфигурация</a>";
        				?>
    					</div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/module.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=types'>Типы</a>";
        				?>
    					</div>
						
						<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/module.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=subdomens'>Поддомены</a>";
        				?>
    					</div>


    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/categories.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=categories'>Категории</a>";
        				?>
    					</div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/media.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=ads'>Объявления</a>";
        				?>
    					</div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/users.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=users'>Пользователи</a>";
        				?>
    					</div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/query.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=keywords'>Ключевые слова</a>";
        				?>
    					</div>

    					<div style="float:left; margin-left: 20px;">
    					<?php
        					echo "<img src='".$mosConfig_live_site."/includes/js/ThemeOffice/credits.png' />";
        				?>
    					</div>
    					<div style="float:left; margin-left:5px; text-align:left;">
    					<?php
        					echo "<a href='".$mosConfig_live_site."/administrator/index2.php?option=com_marketplace&act=about'>О MarketPlace</a>";
        				?>
    					</div>

					</div>

				</td>
			</tr>
		</table>
	</center>

	<br style="clear:both;" />
	<?php
}
?>

<br />

<?php

//echo "act ".$act." task ".$task." <br />";

switch($act)
{
    case "configuration": {
        switch($task) {
            case "save": {
                saveConfiguration($option);
                break;
            }

            default: {
                listConfiguration($option);
                break;
            }
        }
        break;
    }

    case "categories": {
        switch($task) {
            case "listCategories" : {
                listCategories($option);
                break;
            }
            case "edit" : {
                editCategory( $option, $id );
                break;
            }
            case "new" : {
                $id = '';
                editCategory( $option, $id);
                break;
            }
            case "save" : {
                saveCategory($option);
                break;
            }
            case "delete" : {
                deleteCategory($option, $id);
                break;
            }
			case 'orderup':
				orderCategory( $option, $cid[0], -1 );
				break;
			case 'orderdown':
				orderCategory( $option, $cid[0], 1 );
				break;
            case "publish" : {
                publishCategory($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishCategory($option, '0', $id);
                break;
            }
            default: {
                listCategories($option);
                break;
            }
        }
        break;
    }

    case "ads": {
        switch($task) {
            case "new" : {
                editad( $option, '' );
                break;
            }
            case "edit" : {
                editad( $option, $id );
                break;
            }
            case "save" : {
                saveAd($option, $cb_image1, $cb_image2, $cb_image3, $cb_image4, $cb_image5, $cb_image6, $cb_image7, $cb_image8, $cb_image9, $cb_image10,
						$cb_image11, $cb_image12, $cb_image13, $cb_image14, $cb_image15, $cb_image16, $cb_image17, $cb_image18, $cb_image19, $cb_image20);
                break;
            }
            case "delete" : {
                deleteAd($option, $id);
                break;
            }
            case "publish" : {
                publishAd($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishAd($option, '0', $id);
                break;
            }
            default: {
                listAds($option);
                break;
            }
        }
        break;
    }

    case "types": {
        switch($task) {
            case "listTypes" : {
                listTypes($option);
                break;
            }
            case "edit" : {
                editType( $option, $id );
                break;
            }
            case "new" : {
                $id = '';
                editType( $option, $id);
                break;
            }
            case "save" : {
                saveType($option);
                break;
            }
            case "delete" : {
                deleteType($option, $id);
                break;
            }
            case "publish" : {
                publishType($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishType($option, '0', $id);
                break;
            }
            default: {
                listTypes($option);
                break;
            }
        }
        break;
    }
	
	case "subdomens": {
        switch($task) {
            case "listSubdomens" : {
                listSubdomens($option);
                break;
            }
            case "edit" : {
                editSubdomens( $option, $id );
                break;
            }
			case "downloadSubdomens" : {
                downloadSubdomens( $option, $id );
                break;
            }
			case "nowdownloadSubdomens" : {
                nowdownloadSubdomens( $option, $id );
                break;
            }
            case "new" : {
                $id = '';
                editSubdomens( $option, $id);
                break;
            }
            case "save" : {
                saveSubdomens($option);
                break;
            }
            case "delete" : {
                deleteSubdomens($option, $id);
                break;
            }
            case "publish" : {
                publishSubdomens($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishSubdomens($option, '0', $id);
                break;
            }
            default: {
                listSubdomens($option);
                break;
            }
        }
        break;
    }

    case "keywords": {
        switch($task) {
            case "listKeywords" : {
                listKeywords($option);
                break;
            }
            case "edit" : {
                editKeyword( $option, $id );
                break;
            }
            case "new" : {
                $id = '';
                editKeyword( $option, $id);
                break;
            }
            case "save" : {
                saveKeyword($option);
                break;
            }
            case "delete" : {
                deleteKeyword($option, $id);
                break;
            }
            case "publish" : {
                publishKeyword($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishKeyword($option, '0', $id);
                break;
            }
            default: {
                listKeywords($option);
                break;
            }
        }
        break;
    }

    case "users": {
        switch($task) {
            case "listUsers" : {
                listUsers($option);
                break;
            }
            case "edit" : {
                editUser( $option, $id );
                break;
            }
            case "new" : {
                $id = '';
                editUser( $option, $id);
                break;
            }
            case "save" : {
                saveUser($option);
                break;
            }
            case "delete" : {
                deleteUser($option, $id);
                break;
            }
            case "publish" : {
                publishUser($option, '1', $id);
                break;
            }
            case "unpublish" : {
                publishUser($option, '0', $id);
                break;
            }
            default: {
                listUsers($option);
                break;
            }
        }
        break;
    }

    case "about": {
        	showAbout($option);
        break;
    }



    default: {
            listAds($option);
        break;
    }

}


function saveConfiguration($option) {
    global $database;
    $row = new marketplaceConf($database);


    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect("index2.php?option=$option&act=configuration", "Configuration Saved");
}



function listConfiguration($option) {
    global $database;

    $database->setQuery("SELECT * FROM #__marketplace_config"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }
    HTML_marketplace::listConfiguration($option, $rows);
    return true;
}
/********************************************************************************************************/

function listCategories($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;

    $option = mosGetParam( $_REQUEST, 'option');


    // normalize sort_order
    $database->setQuery("SELECT count(*) FROM #__marketplace_categories"  );
    $rowcount = $database->loadResult();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }
    $database->setQuery( "SELECT id FROM #__marketplace_categories ORDER BY sort_order ASC ");
    $rows = $database->loadObjectList();

    $i = 1;
    foreach( $rows as $row) {
        $update_sql = "UPDATE #__marketplace_categories SET sort_order = $i WHERE id = $row->id";

        $database->setQuery( $update_sql);

        if ($database->getErrorNum()) {
        	echo $database->stderr();
        } else {
            $database->query();
        }

        $i = $i + 1;
    }
    // normalize sort_order


    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT * FROM #__marketplace_categories ORDER BY sort_order LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();

    HTML_marketplace::listCategories($option, $rows, $pageNav);
    return true;
}



function publishCategory( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_categories SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    // AND (checked_out=0 OR (checked_out='$my->id')
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=categories" );

}


function orderCategory($option, $id, $direction) {
    global $database;

    if ( intval( $direction == -1)) { // sort up

    	// 1. check if container
		$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE id='$id' ");
		$rows_cats  = $database->loadObjectList();
		$cat_parent = $rows_cats[0]->parent;

		if ( $cat_parent == 0) { // container with subcategories

			// get previous container
			$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE parent='0' order by sort_order desc");
			$rows_cont  = $database->loadObjectList();

			$cat_to_move = null;
			$cat_previous = null;
            foreach( $rows_cont as $rowcont) {
            	if ( $rowcont->id == $id) {
					$cat_to_move = $rowcont->id;
            	}
            	else {
            		if ( $cat_to_move != null) { // found category to move
            			if ( $cat_previous == null) { // previous category not set yet
							$cat_previous = $rowcont->id;
            			}
            		}
            	}
            }

            // count subcatgories current
	        $database->setQuery("SELECT COUNT(*) AS cat_count FROM #__marketplace_categories WHERE parent='$id'");
        	$rows_current_subcats = $database->loadObjectList();
            $count_current_subcats = $rows_current_subcats[0]->cat_count;
			$count_current_all = $count_current_subcats + 1;

            // count subcatgories previous
	        $database->setQuery("SELECT COUNT(*) AS cat_count FROM #__marketplace_categories WHERE parent='$cat_previous'");
        	$rows_previous_subcats = $database->loadObjectList();
            $count_previous_subcats = $rows_previous_subcats[0]->cat_count;
			$count_previous_all = $count_previous_subcats + 1;


			if ( $cat_previous != null) { // do update only when a previous container is found
				// update sort order of previous category
            	$update_sql_previous = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + $count_current_all
                     					WHERE id = $cat_previous OR parent = $cat_previous";

            	$database->setQuery( $update_sql_previous);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}

				// update sort order of current category
            	$update_sql_current = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order - $count_previous_all
                     					WHERE id = $id OR parent = $id";

            	$database->setQuery( $update_sql_current);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}
			}

		}
		else { // subcategory

			// get previous subcategory
			$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE parent = '$cat_parent' order by sort_order desc");
			$rows_subcat  = $database->loadObjectList();

			$cat_to_move = null;
			$cat_previous = null;
            foreach( $rows_subcat as $rowsub) {
            	if ( $rowsub->id == $id) {
					$cat_to_move = $rowsub->id;
            	}
            	else {
            		if ( $cat_to_move != null) { // found category to move
            			if ( $cat_previous == null) { // previous category not set yet
							$cat_previous = $rowsub->id;
            			}
            		}
            	}
            }

			if ( $cat_previous != null) { // do update only when a previous category is found
				// update sort order of previous category
            	$update_sql_previous = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + 1
                     					WHERE id = $cat_previous";

            	$database->setQuery( $update_sql_previous);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}

				// update sort order of current category
            	$update_sql_current = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order - 1
                     					WHERE id = $id";

            	$database->setQuery( $update_sql_current);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}
			}

		}

    }
    elseif ( intval( $direction == 1)) { // sort down

    	// 1. check if container
		$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE id='$id' ");
		$rows_cats  = $database->loadObjectList();
		$cat_parent = $rows_cats[0]->parent;

		if ( $cat_parent == 0) { // container with subcategories

			// get next container
			$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE parent='0' order by sort_order asc");
			$rows_cont  = $database->loadObjectList();

			$cat_to_move = null;
			$cat_next = null;
            foreach( $rows_cont as $rowcont) {
            	if ( $rowcont->id == $id) {
					$cat_to_move = $rowcont->id;
            	}
            	else {
            		if ( $cat_to_move != null) { // found category to move
            			if ( $cat_next == null) { // next category not set yet
							$cat_next = $rowcont->id;
            			}
            		}
            	}
            }

            // count subcatgories current
	        $database->setQuery("SELECT COUNT(*) AS cat_count FROM #__marketplace_categories WHERE parent='$id'");
        	$rows_current_subcats = $database->loadObjectList();
            $count_current_subcats = $rows_current_subcats[0]->cat_count;
			$count_current_all = $count_current_subcats + 1;

            // count subcatgories next
	        $database->setQuery("SELECT COUNT(*) AS cat_count FROM #__marketplace_categories WHERE parent='$cat_next'");
        	$rows_next_subcats = $database->loadObjectList();
            $count_next_subcats = $rows_next_subcats[0]->cat_count;
			$count_next_all = $count_next_subcats + 1;



			if ( $cat_next != null) { // do update only when a next container is found
				// update sort order of next category
            	$update_sql_next = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order - $count_current_all
                     					WHERE id = $cat_next OR parent = $cat_next";

            	$database->setQuery( $update_sql_next);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}

				// update sort order of current category
            	$update_sql_current = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + $count_next_all
                     					WHERE id = $id OR parent = $id";

            	$database->setQuery( $update_sql_current);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}
			}

		}
		else { // subcategory

			// get next subcategory
			$database->setQuery( "SELECT id, parent, name FROM #__marketplace_categories WHERE parent = '$cat_parent' order by sort_order asc");
			$rows_subcat  = $database->loadObjectList();

			$cat_to_move = null;
			$cat_next = null;
            foreach( $rows_subcat as $rowsub) {
            	if ( $rowsub->id == $id) {
					$cat_to_move = $rowsub->id;
            	}
            	else {
            		if ( $cat_to_move != null) { // found category to move
            			if ( $cat_next == null) { // next category not set yet
							$cat_next = $rowsub->id;
            			}
            		}
            	}
            }

			if ( $cat_next != null) { // do update only when a next category is found
				// update sort order of next category
            	$update_sql_next = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order - 1
                     					WHERE id = $cat_next";

            	$database->setQuery( $update_sql_next);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}

				// update sort order of current category
            	$update_sql_current = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + 1
                     					WHERE id = $id";

            	$database->setQuery( $update_sql_current);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}
			}

		}

    }

    mosRedirect( "index2.php?option=$option&act=categories" );
}




function saveCategory($option) {
    global $database;
    $row = new marketplaceCategory($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // set sort order
    if ( $row->parent == 0) { // container
		if ( $row->sort_order == null) {  // new entry - set sort order to max + 1
			$database->setQuery( "SELECT MAX(sort_order) FROM #__marketplace_categories");
    		$max_sort_order = $database->loadResult();
			$row->sort_order = $max_sort_order + 1; // set to next free value
		}
    }
    else { // subcategory

		if ( $row->sort_order == null) {  // new entry - set sort order to max subcat + 1
			$database->setQuery( "SELECT MAX(sort_order) FROM #__marketplace_categories WHERE parent = $row->parent");
    		$max_sort_order = $database->loadResult();

    		if ( $max_sort_order == null) { // no subcats available for this container
				$database->setQuery( "SELECT sort_order FROM #__marketplace_categories WHERE id = $row->parent");
    			$max_sort_order = $database->loadResult();
    		}

			$row->sort_order = $max_sort_order + 1; // set to next free value

			// increment sort order of the following categories
            $update_sql_following = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + 1
                     					WHERE sort_order > $max_sort_order";

            $database->setQuery( $update_sql_following);

            if ($database->getErrorNum()) {
                echo $database->stderr();
            } else {
                $database->query();
            }
		}
		else { // sort_order != null

			// 1. get sort_order of parent
			$database->setQuery( "SELECT sort_order FROM #__marketplace_categories WHERE id = $row->parent");
    		$parent = $database->loadResult();

			// 2. get # of subcats
			$database->setQuery( "SELECT count(*) FROM #__marketplace_categories WHERE parent = $row->parent");
    		$count = $database->loadResult();

			// 3. get max sort order of subcats (me exluded)
			$database->setQuery( "SELECT MAX(sort_order) FROM #__marketplace_categories WHERE parent = $row->parent AND id <> $row->id");
    		$max_sort_order = $database->loadResult();


			// check if I am wrong - if yes -> reorder
			if ( $row->sort_order < $parent || $row->sort_order > ( $parent + $count) ) {

    			if ( $max_sort_order == null) { // no subcats available for this container
    				$max_sort_order = $parent;
    			}
				$row->sort_order = $max_sort_order + 1; // set to next free value

				// increment sort order of the following categories
            	$update_sql_following = "UPDATE #__marketplace_categories
                     					SET sort_order = sort_order + 1
                     					WHERE sort_order > $max_sort_order";

            	$database->setQuery( $update_sql_following);

            	if ($database->getErrorNum()) {
                	echo $database->stderr();
            	} else {
                	$database->query();
            	}

			}

		}
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect("index2.php?option=$option&act=categories", "Category Saved");
}



function deleteCategory($option, $cid) {
    global $database;
    if (!is_array($cid) || count($cid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($cid))
    {
        $ids = implode(',', $cid);
        $database->setQuery("DELETE FROM #__marketplace_categories \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('"
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }
    mosRedirect("index2.php?option=$option&act=categories", "Category Deleted");
}



function editCategory($option, $uid) {
    global $database;

    $row = new marketplaceCategory($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editCategory($option, $row);
}
/********************************************************************************************************/

function listAds($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;
    $option = mosGetParam( $_REQUEST, 'option');

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $database->setQuery("SELECT count(*) FROM #__marketplace_ads"  );
    $rowcount = $database->loadResult();

    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT * FROM #__marketplace_ads ORDER BY date_created DESC, id DESC LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();

    HTML_marketplace::listAds($option, $rows, $pageNav);
    return true;
}



function publishAd( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_ads SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    // AND (checked_out=0 OR (checked_out='$my->id')
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=ads" );

}


function editAd($option, $uid) {
    global $database;

    $row = new marketplaceAd($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editAd($option, $row);
}


function saveAd($option, $cb_image1, $cb_image2, $cb_image3, $cb_image4, $cb_image5, $cb_image6, $cb_image7, $cb_image8, $cb_image9, $cb_image10,
						$cb_image11, $cb_image12, $cb_image13, $cb_image14, $cb_image15, $cb_image16, $cb_image17, $cb_image18, $cb_image19, $cb_image20) {
    global $database, $imageid;
    $row = new marketplaceAd($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }


    /* image handling here */
    manageImages( $row->id, $cb_image1, $cb_image2, $cb_image3, $cb_image4, $cb_image5, $cb_image6, $cb_image7, $cb_image8, $cb_image9, $cb_image10,
						$cb_image11, $cb_image12, $cb_image13, $cb_image14, $cb_image15, $cb_image16, $cb_image17, $cb_image18, $cb_image19, $cb_image20);

    mosRedirect("index2.php?option=$option&act=ads", "Ad Saved");
}


function deleteAd($option, $adid) {
    global $database;
    if (!is_array($adid) || count($adid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($adid))
    {
        $ids = implode(',', $adid);
        $database->setQuery("DELETE FROM #__marketplace_ads \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('"
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }

    mosRedirect("index2.php?option=$option&act=ads", "Ad Deleted");
}


function manageImages($imageid, $cb_image1, $cb_image2, $cb_image3, $cb_image4, $cb_image5, $cb_image6, $cb_image7, $cb_image8, $cb_image9, $cb_image10,
						$cb_image11, $cb_image12, $cb_image13, $cb_image14, $cb_image15, $cb_image16, $cb_image17, $cb_image18, $cb_image19, $cb_image20) {

	global $database, $mosConfig_absolute_path;

	// get configuration data
	$database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
	$config = $database->loadObjectList();

	$images_per_ad      = (int)$config[0]->images_per_ad;
	$max_image_size		= (int)$config[0]->max_image_size;


    // delete image
	for ( $i = 1; $i <= $images_per_ad; $i += 1) {
		$c = chr( 96 + $i);
		$cbi = "cb_image".$i;

        if ( $$cbi == "delete") {
        	$pict_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.jpg";
            if ( file_exists( $pict_jpg)) {
            	unlink( $pict_jpg);
            }
            $pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".jpg";
            if ( file_exists( $pic_jpg)) {
                unlink( $pic_jpg);
            }

            $pict_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.png";
            if ( file_exists( $pict_png)) {
                unlink( $pict_png);
            }
            $pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".png";
            if ( file_exists( $pic_png)) {
                unlink( $pic_png);
            }

            $pict_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.gif";
            if ( file_exists( $pict_gif)) {
                unlink( $pict_gif);
            }
            $pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".gif";
            if ( file_exists( $pic_gif)) {
                unlink( $pic_gif);
            }

            $sql = "UPDATE #__marketplace_ads
                     		SET ad_image = ad_image - 1, date_lastmodified = CURRENT_DATE()
                     		WHERE id = $imageid";

            $database->setQuery( $sql);

            if ($database->getErrorNum()) {
            	echo $database->stderr();
            } else {
                $database->query();
            }
        }
	}
    // delete image


	// loop over configured # of images
	for ( $i = 1; $i <= $images_per_ad; $i += 1) {
		$c = chr( 96 + $i);
		$adpic = "ad_picture".$i;

        // upload images
        if (isset( $_FILES[$adpic]) and !$_FILES[$adpic]['error'] ) {
        	ad_image( $imageid, $adpic, $c, $mosConfig_absolute_path, $af_info, $database, $images_per_ad, $max_image_size);
        }
	}


    return true;
}



function ad_image( $imageid, $image, $itrail, $mosConfig_absolute_path, $af_info, $database, $images_per_ad, $max_image_size) {

    $af_dir_ads = $mosConfig_absolute_path."/components/com_marketplace/images/entries/";

    $image_too_big = 0;

	// loop over configured # of images
	for ( $i = 1; $i <= $images_per_ad; $i += 1) {
		$c = chr( 96 + $i);
		$adpic = "ad_picture".$i;

        // upload images
        if (isset( $_FILES[$adpic])  ) {
        	if ( $_FILES[$adpic]['size'] > $max_image_size) {
            	$image_too_big = 1;
        	}
        }
	}


    if ( $image_too_big == 1) {
        echo "<font color='#CC0000'>";
        echo "Image too big";
        echo "</font>";
        echo "<br>";
        echo "<br>";
    }
    else {

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

        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$itrail."_t.gif")) {
            $isNewImage = 0;
        }
        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$itrail."_t.jpg")) {
            $isNewImage = 0;
        }
        if ( file_exists( $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$itrail."_t.png")) {
            $isNewImage = 0;
        }



        if ( $af_size[2] >= 1 && $af_size[2] <= 3) { // GIF, JPG or PNG

			for ( $i = 1; $i <= $images_per_ad; $i += 1) {
				$c = chr( 96 + $i);

				if ( $itrail == $c) {
        			$pict_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.jpg";
             		if ( file_exists( $pict_jpg)) {
             			unlink( $pict_jpg);
             		}
             		$pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".jpg";
             		if ( file_exists( $pic_jpg)) {
                		unlink( $pic_jpg);
             		}

             		$pict_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.png";
             		if ( file_exists( $pict_png)) {
             			unlink( $pict_png);
             		}
             		$pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".png";
             		if ( file_exists( $pic_png)) {
                		unlink( $pic_png);
             		}

             		$pict_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.gif";
             		if ( file_exists( $pict_gif)) {
                		unlink( $pict_gif);
             		}
             		$pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c.".gif";
             		if ( file_exists( $pic_gif)) {
                		unlink( $pic_gif);
             		}
				}
			}

            chmod ( $_FILES[$image]['tmp_name'], 0644);

            // copy image
            move_uploaded_file ( $_FILES[$image]['tmp_name'], $af_dir_ads.$imageid.$itrail.".".$thispicext);

            // create thumbnail
            switch ($af_size[2]) {
                case 1 : $src = ImageCreateFromGif( $af_dir_ads.$imageid.$itrail.".".$thispicext); break;
                case 2 : $src = ImageCreateFromJpeg( $af_dir_ads.$imageid.$itrail.".".$thispicext); break;
                case 3 : $src = ImageCreateFromPng( $af_dir_ads.$imageid.$itrail.".".$thispicext); break;
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

            switch ($af_size[2]) {
                case 1 : ImageGIF( $dst, $af_dir_ads.$imageid.$itrail."_t.".$thispicext); break;
                case 2 : ImageJPEG( $dst, $af_dir_ads.$imageid.$itrail."_t.".$thispicext); break;
                case 3 : ImagePNG( $dst, $af_dir_ads.$imageid.$itrail."_t.".$thispicext); break;
            }

            imagedestroy( $dst);
            imagedestroy( $src);


            // DB update
            if ( $isNewImage == 1) {
                $sql = "UPDATE #__marketplace_ads
                     SET ad_image = ad_image + 1, date_lastmodified = CURRENT_DATE()
                     WHERE id = $imageid";
            }
            else { // isNewImage==0
                $sql = "UPDATE #__marketplace_ads
                     SET date_lastmodified = CURRENT_DATE()
                     WHERE id = $imageid";
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

/********************************************************************************************************/

function listTypes($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;

    $option = mosGetParam( $_REQUEST, 'option');

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $database->setQuery("SELECT count(*) FROM #__marketplace_types"  );
    $rowcount = $database->loadResult();

    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT * FROM #__marketplace_types ORDER BY sort_order LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();

    HTML_marketplace::listTypes($option, $rows, $pageNav);
    return true;
}



function publishType( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_types SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=types" );

}






function saveType($option) {
    global $database;
    $row = new marketplaceType($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }
    mosRedirect("index2.php?option=$option&act=types", "Type Saved");
}



function deleteType($option, $cid) {
    global $database;
    if (!is_array($cid) || count($cid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($cid))
    {
        $ids = implode(',', $cid);
        $database->setQuery("DELETE FROM #__marketplace_types \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('"
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }
    mosRedirect("index2.php?option=$option&act=types", "Type Deleted");
}



function editType($option, $uid) {
    global $database;

    $row = new marketplaceType($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editType($option, $row);
}

/********************************************************************************************************/

function listSubdomens($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;

    $option = mosGetParam( $_REQUEST, 'option');

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $database->setQuery("SELECT count(*) FROM #__marketplace_subdomens"  );
    $rowcount = $database->loadResult();

    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT * FROM #__marketplace_subdomens ORDER BY sort_order LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();
	foreach ($rows as $row){
	$database->setQuery("SELECT count(*) FROM #__marketplace_ads where siten = '".$row->name."'");
	$row->countads = $database->loadResult();
	}
    HTML_marketplace::listSubdomens($option, $rows, $pageNav);
    return true;
}



function publishSubdomens( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_subdomens SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=subdomens" );

}



function saveSubdomens($option) {
    global $database;
    $row = new marketplaceSubdomens($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }
    mosRedirect("index2.php?option=$option&act=subdomens", "subdomen Saved");
}

function saveSubdomens1($option) {
    global $database;
    $row = new marketplaceSubdomens($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }
    
}



function deleteSubdomens($option, $cid) {
    global $database;
    if (!is_array($cid) || count($cid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($cid))
    {
        $ids = implode(',', $cid);
        $database->setQuery("DELETE FROM #__marketplace_subdomens \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('Ошибка "
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }
    mosRedirect("index2.php?option=$option&act=subdomens", "subdomen Deleted");
}



function editSubdomens($option, $uid) {
    global $database;
echo "editdSubdomens ".$option." ".$uid;
    $row = new marketplaceSubdomens($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editSubdomens($option, $row);
}


function downloadSubdomens($option, $uid) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;


	$row = new marketplaceSubdomens($database);
    if($uid){
        $row -> load($uid[0]);
    }
$siten = $row->name;
echo 'site name '.$siten.'<br>';	
$optionextdb = array(); //Инициализация
 
$optionextdb['driver']   = $row->basedriver;            // Имя драйвера БД
$optionextdb['host']     = $row->hostbase;    // Хост БД
$optionextdb['user']     = $row->userbase;       // Имя пользователя
$optionextdb['password'] = $row->passwordbase;   // Пароль
$optionextdb['database'] = $row->basename;      // Имя БД
$optionextdb['prefix']   = $row->prefixbase;             // префикс (может быть пустым)
// echo "host from base ".$optionextdb['host'] ;
$dbext = & JDatabase::getInstance( $optionextdb );
    	$dbext->setQuery( "SELECT COUNT(*) FROM #__marketplace_ads".$sWhereClause );
    $total = $dbext->loadResult();
//добавить проверку на правильность данных для подключения к базе
echo "Всего объявлений в источнике ".$total;
//download from external base
$sWhereClause = " where id > ".$row->lastid. " and published=1";
$textquery = "SELECT COUNT(*) FROM #__marketplace_ads".$sWhereClause ;
   	$dbext->setQuery($textquery);
      $newrow = $dbext->loadResult();
echo " новых объявлений в источнике ".$newrow;
//echo " </br> textquery  ".$textquery ;	
//$limitstart =0;
$rowcount =1000;
 //   $dbext->setQuery( "SELECT * FROM #__marketplace_ads".$sWhereClause);
   	$dbext->setQuery("SELECT id, category, user,city, state, ad_type, ad_headline, ad_text, ad_image, ad_price,
date_created, flag_top, flag_commercial FROM #__marketplace_ads".$sWhereClause." LIMIT $rowcount");

   $newrows = $dbext->loadObjectList();
    $nn = count($newrows);

echo " </br> прочитано ".$nn;
if ($nn >0) 
{
    foreach($newrows as $newrow) {

        $newid 	= $newrow->id;
		$newcategory 	= $newrow->category;
		$newuser 	= $newrow->user;
		$newcity 	= $newrow->city;
		$newstate 	= $newrow->state;
		$newad_type 	= $newrow->ad_type;
		$newad_headline 	= $newrow->ad_headline;
		$newad_text 	= $newrow->ad_text;
		$newad_image 	= $newrow->ad_image;
		$newad_price 	= $newrow->ad_price;
		$newdate_created 	= $newrow->date_created;
		$newflag_top 	= $newrow->flag_top;
		$newflag_commercial 	= $newrow->flag_commercial;
//		$new 	= $newrow->flag_featured;
	
		$databasetext="INSERT INTO #__marketplace_ads (category, user, city, state,ad_type, ad_headline, ad_text, ad_image, ad_price, date_created,  flag_top, flag_commercial,siten,siteid) VALUES ('".$newcategory."','".$newuser."','".$newcity."','".$newstate."','".$newad_type."','".$newad_headline."','".$newad_text."','".$newad_image."','".$newad_price."','".$newdate_created."','".$newflag_top."','".$newflag_commercial."','".$siten."','".$newid."')";
//echo " </br> databasetext ".$databasetext;		
$database->setQuery($databasetext);
if ($database->getErrorNum()) { echo $database->stderr(); } else { $database->query(); }	
}
	echo " </br> Новый максимальный считанный номер ".$newid;
	$row->lastid=$newid;
 if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }
}
//   	$database->setQuery("INSERT INTO #__marketplace_ads (category, user, ad_type, ad_headline, ad_text, ad_image, ad_price, date_created, views,flag_featured, flag_top, flag_commercial,siten,siteid) VALUES ()");

 // 1. insert ad
//            $sql = "INSERT INTO #__marketplace_ads (category, userid, user, name, surname, street, zip, city, state, country, phone1, phone2, email, web, ad_type, ad_headline, ad_text, ad_condition, ad_price, date_created, date_lastmodified,	flag_featured, flag_top, flag_commercial, published) VALUES ('$category', '$userid', '$username', '$name', '$surname', '$street', '$zip', '$city', '$state', '$country','$phone1', '$phone2', '$email', '$web', '$ad_type', '$ad_headline', '$ad_text',	'$ad_condition', '$ad_price', CURRENT_DATE(), CURRENT_DATE(),'$flagFeatured', '$flagTop', '$flagCommercial', '$publishAd')";

 //           $database->setQuery( $sql);

 //           if ($database->getErrorNum()) { echo $database->stderr(); } else { $database->query(); }



    HTML_marketplace::downloadSubdomens($option, $row);
    return true;
}



/********************************************************************************************************/

function listUsers($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;

    $option = mosGetParam( $_REQUEST, 'option');

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $database->setQuery("SELECT count(*) FROM #__marketplace_users"  );
    $rowcount = $database->loadResult();

    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT a.*, b.username FROM #__marketplace_users a, #__users b WHERE a.userid = b.id ORDER BY b.username, a.date_begin, a.date_end LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();

    HTML_marketplace::listUsers($option, $rows, $pageNav);
    return true;
}


function editUser($option, $uid) {
    global $database;

    $row = new marketplaceUser($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editUser($option, $row);
}


function saveUser($option) {
    global $database;
    $row = new marketplaceUser($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }


	$categories 		= mosGetParam( $_POST, 'categories', array() );
	$categories 		= implode( ',', $categories );
    $row->categories	= $categories;

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect("index2.php?option=$option&act=users", "User Saved");
}


function publishUser( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_users SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=users" );

}


function deleteUser($option, $cid) {
    global $database;
    if (!is_array($cid) || count($cid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($cid))
    {
        $ids = implode(',', $cid);
        $database->setQuery("DELETE FROM #__marketplace_users \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('"
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }
    mosRedirect("index2.php?option=$option&act=users", "User Deleted");
}



/********************************************************************************************************/
function showAbout($option) {
    HTML_marketplace::showAbout($option);
    return true;
}

/********************************************************************************************************/

function listKeywords($option) {
    global $database, $mosConfig_absolute_path, $mosConfig_list_limit, $mainframe;;

    $option = mosGetParam( $_REQUEST, 'option');

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $database->setQuery("SELECT count(*) FROM #__marketplace_keywords"  );
    $rowcount = $database->loadResult();

    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }

    require_once( $mosConfig_absolute_path . '/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $rowcount, $limitstart, $limit);

    $database->setQuery( "SELECT * FROM #__marketplace_keywords ORDER BY keyword ASC LIMIT ".$limitstart.", ".$limit);
    $rows = $database->loadObjectList();

    HTML_marketplace::listKeywords($option, $rows, $pageNav);
    return true;
}



function publishKeyword( $option, $publish=1 ,$cid )
{
    global $database;

    if (!is_array( $cid ) || count( $cid ) < 1) {
        $action = $publish ? 'publish' : 'unpublish';
        echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
        exit;
    }

    $cids = implode( ',', $cid );

    $database->setQuery( "UPDATE #__marketplace_keywords SET published='$publish'"
    . "\nWHERE id IN ($cids)"
    );
    if (!$database->query()) {
        echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
        exit();
    }

    mosRedirect( "index2.php?option=$option&act=keywords" );

}






function saveKeyword($option) {
    global $database;
    $row = new marketplaceKeyword($database);

    // bind it to the table
    if (!$row -> bind($_POST)) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }

    // store it in the db
    if (!$row -> store()) {
        echo "<script> alert('"
        .$row -> getError()
        ."'); window.history.go(-1); </script>\n";
        exit();
    }
    mosRedirect("index2.php?option=$option&act=keywords", "Keyword Saved");
}



function deleteKeyword($option, $cid) {
    global $database;
    if (!is_array($cid) || count($cid) < 1) {
        echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
        exit();
    }

    if (count($cid))
    {
        $ids = implode(',', $cid);
        $database->setQuery("DELETE FROM #__marketplace_keywords \nWHERE id IN ($ids)");
    }
    if (!$database->query()) {
        echo "<script> alert('"
        .$database -> getErrorMsg()
        ."'); window.history.go(-1); </script>\n";
    }
    mosRedirect("index2.php?option=$option&act=keywords", "Keyword Deleted");
}



function editKeyword($option, $uid) {
    global $database;

    $row = new marketplaceKeyword($database);
    if($uid){
        $row -> load($uid[0]);
    }

    HTML_marketplace::editKeyword($option, $row);
}


?>
