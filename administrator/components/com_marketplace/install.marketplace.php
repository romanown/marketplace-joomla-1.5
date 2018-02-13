<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_install()
{

    global $database;

	$database->setQuery( "SELECT id FROM #__components WHERE name='Marketplace' AND parent='0'" );
	$id = $database->loadResult();

	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/home.png' WHERE id='$id'");
	$database->query();

	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE parent='$id' AND name='Конфигурация'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/module.png' WHERE parent='$id' AND name='Типы'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/categories.png' WHERE parent='$id' AND name='Категории'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/media.png' WHERE parent='$id' AND name='Объявления'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/users.png' WHERE parent='$id' AND name='Пользователи'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/query.png' WHERE parent='$id' AND name='Ключевые слова'");
	$database->query();
	$database->setQuery( "UPDATE #__components SET admin_menu_img='js/ThemeOffice/credits.png' WHERE parent='$id' AND name='Информация о MarketPlace'");
	$database->query();


?>

<center>
<table width="100%" border="0">
   <tr>
      <td valign="top" align="center">
         <p>
            Спасибо за использование
         </p>

         <p>
            <b>Marketplace Версия 1.4.2 (Real Edition)</b>
         </p>

         <p>
            <em>Achim Fischer - joomster.com</em>
         </p>
      </td>
      <td valign="top" align="center">
         <p>
            Marketplace это бесплатный компонент; вы можете добавлять и/или модифицировать его
            <br>
            в соответствии с лицензией GNU GPL,
            <br>
            опубликованной компанией Free Software Foundation.
            <br>
            <br>

            Marketplace разработан в надежде, что будет полезен,
            <br>
            но БЕЗ КАКОЙ-ЛИБО ГАРАНТИИ в соответсвии с лицензией GNU GPL
                        <br>
            <br>

            Вы должны были получить копию GNU General Public License
            <br>
            вместе с компонентом Marketplace; в противном случае, напишите в Free Software
            <br>

            Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
            <br>
            <br>
         </p>
      </td>
   </tr>
</table>
</center>

<?php
}
?>