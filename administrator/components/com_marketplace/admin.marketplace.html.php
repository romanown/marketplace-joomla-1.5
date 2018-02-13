<?php
/**
 * admin.marketplace.html.php
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
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_marketplace {


    function listConfiguration($option, $rows) {
        global $mosConfig_absolute_path;
        $tabs = new mosTabs(2);
        ?>

    <table class="adminheading">
       <tr>
          <th>Конфигурация MarketPlace</th>
       </tr>
    </table>
	<br />

	<?php
	$row = $rows[0];
	?>



	<form action="index2.php" method="post" name="adminForm">

	<?php
	$tabs->startPane("settings");
	$tabs->startTab( "Общие", "page1");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Продолжительность</td>
		<td><input type="text" name="duration" value=<?php echo $row->duration ?> /></td>
		<td>Продолжительность жизни объявлений</td>
	</tr>

	<tr>
		<td>Объявлений на странице</td>
		<td><input type="text" name="ads_per_page" value=<?php echo $row->ads_per_page ?> /></td>
		<td>Количество объявлений в списке</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Количество фото на 1 объявление: </td>
		<td>
		<?php
        $cur = array();
        $cur[] = mosHTML::makeOption( '1', '1' );
        $cur[] = mosHTML::makeOption( '2', '2' );
        $cur[] = mosHTML::makeOption( '3', '3' );
        $cur[] = mosHTML::makeOption( '4', '4' );
        $cur[] = mosHTML::makeOption( '5', '5' );
        $cur[] = mosHTML::makeOption( '6', '6' );
        $cur[] = mosHTML::makeOption( '7', '7' );
        $cur[] = mosHTML::makeOption( '8', '8' );
        $cur[] = mosHTML::makeOption( '9', '9' );
        $cur[] = mosHTML::makeOption( '10', '10' );
        $cur[] = mosHTML::makeOption( '11', '11' );
        $cur[] = mosHTML::makeOption( '12', '12' );
        $cur[] = mosHTML::makeOption( '13', '13' );
        $cur[] = mosHTML::makeOption( '14', '14' );
        $cur[] = mosHTML::makeOption( '15', '15' );
        $cur[] = mosHTML::makeOption( '16', '16' );
        $cur[] = mosHTML::makeOption( '17', '17' );
        $cur[] = mosHTML::makeOption( '18', '18' );
        $cur[] = mosHTML::makeOption( '19', '19' );
        $cur[] = mosHTML::makeOption( '20', '20' );
		$html = mosHTML::selectList( $cur, 'images_per_ad', 'size="1" class="inputbox"', 'value', 'text', $row->images_per_ad);
		echo $html;
		?>
		</td>
		<td>Выберите сколько можно добавить изображений к объявлению</td>
	</tr>

	<tr>
		<td>Колонки для фото: </td>
		<td>
		<?php
        $cur = array();
        $cur[] = mosHTML::makeOption( '1', '1' );
        $cur[] = mosHTML::makeOption( '2', '2' );
		$html = mosHTML::selectList( $cur, 'image_columns', 'size="1" class="inputbox"', 'value', 'text', $row->image_columns);
		echo $html;
		?>
		</td>
		<td>В скольки колонках отображать фото</td>
	</tr>

	<tr>
		<td>Максимальный размер изображения</td>
		<td><input type="text" name="max_image_size" value=<?php echo $row->max_image_size ?> /></td>
		<td>Максимальный размер изображения в байтах</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Отображение 5-ти последних предложений</td>
		<td><?php echo mosHTML::yesnoSelectList( "show_recent5", "", $row->show_recent5 ); ?></td>
		<td>Выберите <b>Да</b> чтобы отображать 5 последних спецпредложений, или <b>Нет</b> чтобы их не отображать</td>
	</tr>

	<tr>
		<td>Показывать контейнер</td>
		<td><?php echo mosHTML::yesnoSelectList( "show_container", "", $row->show_container ); ?></td>
		<td>Выберите <b>Да</b> чтобы отображать родительский контейнер в категории- или <b>Нет</b> чтобы не отображать</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Публикация объявлений</td>
		<td><?php echo mosHTML::yesnoSelectList( "ad_default", "", $row->ad_default ); ?></td>
		<td>Выберите <b>Да</b> если хотите чтобы объявление публиковалось автоматически, после написания, или <b>Нет</b> если хотите чтобы объявление ожидало одобрения Администратора</td>
	</tr>

	<tr>
		<td>Показывать детали контакта только зарегистрированным пользователям</td>
		<td><?php echo mosHTML::yesnoSelectList( "ad_contact_registered_only", "", $row->ad_contact_registered_only ); ?></td>
		<td>Выберите <b>Да</b> если хотите чтобы детали контакта были видны только зарегестрированным пользователям, или <b>Нет</b> если хотите чтобы такая информация была доступна всем</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Включить Slimbox</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_slimbox", "", $row->use_slimbox ); ?></td>
		<td>Выберите <b>Да</b> включить Slimbox для показа картинок <b>Нет</b> если не использовать всплывающие картинки</td>
	</tr>

	<tr>
		<td>Встроить Mootools Javascript</td>
		<td><?php echo mosHTML::yesnoSelectList( "include_mootools", "", $row->include_mootools ); ?></td>
		<td>Выберите <b>да</b> встроить Mootools скрипт, выберите <b>Нет</b> если в ваш шаблон уже включен этот скрипт</td>
	</tr>

	<tr>
		<td>Встроить Slimbox Javascript</td>
		<td><?php echo mosHTML::yesnoSelectList( "include_slimbox", "", $row->include_slimbox ); ?></td>
		<td>Выберите <b>Да</b> встроить Slimbox скрипт, выберите, <b>Нет</b> если в ваш шаблон уже включен этот скрипт</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>

	<?php
	$tabs->endTab();
	$tabs->startTab( "Поля объявления", "page2");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Использовать поле "Top"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_top", "", $row->use_top ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Похожие"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_featured", "", $row->use_featured ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Коммерческое"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_commercial", "", $row->use_commercial ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Фамилия"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_surname", "", $row->use_surname ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Улица"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_street", "", $row->use_street ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Индекс"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_zip", "", $row->use_zip ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Город"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_city", "", $row->use_city ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Край/Область"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_state", "", $row->use_state ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Страна"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_country", "", $row->use_country ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Телефон"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_phone1", "", $row->use_phone1 ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Мобильный"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_phone2", "", $row->use_phone2 ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Web-сайт"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_web", "", $row->use_web ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Условия"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_condition", "", $row->use_condition ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td>Использовать поле "Цена"</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_price", "", $row->use_price ); ?></td>
		<td>Выберите <b>Да</b> чтобы это поле было доступно при написании или редактировании объявления</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>


	<?php
	$tabs->endTab();
	$tabs->startTab( "Email", "page3");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td colspan="3">
			<b>Отправка E-mail</b>
		</td>
	</tr>

	<tr>
		<td>Email&nbsp;От</td>
		<td><input type="text" name="email_from" value="<?php echo $row->email_from; ?>" /></td>
		<td>Адрес электронной почты отправителя для уведомлений</td>
	</tr>

	<tr>
		<td>Email&nbsp;От&nbsp;Имя</td>
		<td><input type="text" name="email_from_name" value="<?php echo $row->email_from_name; ?>" /></td>
		<td>Имя отправителя для уведомлений. Моежете использовать название Вашего сайта.</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
			<b>Уведомление Администратора/Модератора</b>
		</td>
	</tr>

	<tr>
		<td>Уведомлять&nbsp;Администратора</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_admin_email_notification", "", $row->use_admin_email_notification ); ?></td>
		<td>Если выберите <b>Да</b>, то Администратор Marketplace будет уведомлен о новом объявлении по электронной почте</td>
	</tr>

	<tr>
		<td>Уведомлять&nbsp;Модератора</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_moderator_email_notification", "", $row->use_moderator_email_notification ); ?></td>
		<td>Если выберите <b>Да</b>, то Модераторы Marketplace будут уведомлены о новом объявлении по электронной почте</td>
	</tr>

	<tr>
		<td>Уведомления&nbsp;Email&nbsp;Тема</td>
		<td><input type="text" name="notification_email_subject" value="<?php echo $row->notification_email_subject; ?>" /></td>
		<td>Тема письма уведомления</td>
	</tr>

	<tr>
		<td valign="top">Уведомления&nbsp;Email&nbsp;Текст</td>
		<td>
		<textarea name="notification_email_text" cols="40" rows="5" wrap="VIRTUAL"><?php echo $row->notification_email_text; ?></textarea>
		</td>
		<td valign="top">
		      Текст письма уведомления.<br />Используйте <b>[LINK_TO_AD]</b> для вставки кликабельной ссылки на объявление.
		</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
			<b>Уведомление автора</b>
		</td>
	</tr>

	<tr>
		<td>Уведомлять&nbsp;Автора</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_author_email_notification", "", $row->use_author_email_notification ); ?></td>
		<td>Если выберите <b>Yes</b>, то автор объявления получит уведомление о том, когда срок действия его объявления истекает</td>
	</tr>

	<tr>
		<td>Окончание&nbsp;Email&nbsp;Тема</td>
		<td><input type="text" name="expiry_email_subject" value="<?php echo $row->expiry_email_subject; ?>" /></td>
		<td>Тема письма уведомления об истечении срока действия объявления</td>
	</tr>

	<tr>
		<td valign="top">Окончание&nbsp;Email&nbsp;Текст</td>
		<td>
		<textarea name="expiry_email_text" cols="40" rows="5" wrap="VIRTUAL"><?php echo $row->expiry_email_text; ?></textarea>
		</td>
		<td valign="top">
		      Текст письма уведомления об истечении срока действия объявления.
		      <br />Используйте <b>[USERNAME]</b> чтобы использовать имя пользователя.
		</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>




	<?php
	$tabs->endTab();
	$tabs->startTab( "Приватные сообщения", "page4");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>Использовать Primezilla</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_primezilla", "", $row->use_primezilla ); ?></td>
		<td>Выберите <b>Да</b> если хотите использовать приватные сообщения Primezzila для Marketplace</td>
	</tr>

	<tr>
		<td>Использовать Primezilla для контакта</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_primezillaforcontact", "", $row->use_primezillaforcontact ); ?></td>
		<td>Выберите <b>Да</b> покажет ссылку Primezilla вместо e-mail адреса в поле "Контакт"</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>

	<?php
	$tabs->endTab();
	$tabs->startTab( "RSS", "page5");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td>RSS-рассылка</td>
		<td><?php echo mosHTML::yesnoSelectList( "rss_syndication", "", $row->rss_syndication ); ?></td>
		<td>Выберите <b>Да</b> и Ваш Marketplace будет активен для RSS-рассылок</td>
	</tr>

	<tr>
		<td>Количество RSS</td>
		<td><input type="text" name="rss_count" value=<?php echo $row->rss_count; ?> /></td>
		<td>Сколько объявлений вы хотите сделать доступными для RSS</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>

	<?php
	$tabs->endTab();
	$tabs->startTab( "Платные объявления", "page6");
	?>

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
		<td colspan="3">
			<b>Общие настройки</b>
		</td>
	</tr>

	<tr>
		<td>Включить платные объявления</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_paid_ads", "", $row->use_paid_ads ); ?></td>
		<td>Установить <b>Да</b> чтобы включить платные объявления.</td>
	</tr>

	<tr>
		<td>Валюта: </td>
		<td>
		<?php
        $cur = array();
        $cur[] = mosHTML::makeOption( 'AUD', 'Австралийский доллар' );
        $cur[] = mosHTML::makeOption( 'CAD', 'Канадский доллар' );
        $cur[] = mosHTML::makeOption( 'CHF', 'Щвейцарский франк' );
        $cur[] = mosHTML::makeOption( 'CZK', 'Чешская крона' );
        $cur[] = mosHTML::makeOption( 'DKK', 'Датская крона' );
        $cur[] = mosHTML::makeOption( 'EUR', 'Евро' );
        $cur[] = mosHTML::makeOption( 'GBP', 'Фунты стерлингов' );
        $cur[] = mosHTML::makeOption( 'HKD', 'Конг-конгский доллар' );
        $cur[] = mosHTML::makeOption( 'HUF', 'Венгерский форинт' );
        $cur[] = mosHTML::makeOption( 'JPY', 'Японская Йена' );
        $cur[] = mosHTML::makeOption( 'NOK', 'Норвежская крона' );
        $cur[] = mosHTML::makeOption( 'NZD', 'Новозеландский доллар' );
        $cur[] = mosHTML::makeOption( 'PLN', 'Польский злотый' );
        $cur[] = mosHTML::makeOption( 'SEK', 'Шведская крона' );
        $cur[] = mosHTML::makeOption( 'SGD', 'Сингапурский доллар' );
        $cur[] = mosHTML::makeOption( 'USD', 'Доллар США' );
		$html = mosHTML::selectList( $cur, 'paid_ads_currency', 'size="1" class="inputbox"', 'value', 'text', $row->paid_ads_currency);
		echo $html;
		?>
		</td>
		<td>Валюты поддерживаемые PayPal</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
			<b>Цены</b>
		</td>
	</tr>

	<tr>
		<td>Основное платное объявление</td>
		<td><input type="text" name="paid_ads_price_basic" value=<?php echo $row->paid_ads_price_basic; ?> /></td>
		<td>Цена для основного платного объявления без дополнительных функций</td>
	</tr>

	<tr>
		<td>Цена Top объявления</td>
		<td><input type="text" name="paid_ads_price_top" value=<?php echo $row->paid_ads_price_top; ?> /></td>
		<td>Цена для <b>Top</b> объявление</td>
	</tr>

	<tr>
		<td>Цена похожего объявления</td>
		<td><input type="text" name="paid_ads_price_featured" value=<?php echo $row->paid_ads_price_featured; ?> /></td>
		<td>Цена для <b>Похожего</b> объявления</td>
	</tr>

	<tr>
		<td>Цена коммерческого объявления</td>
		<td><input type="text" name="paid_ads_price_commercial" value=<?php echo $row->paid_ads_price_commercial; ?> /></td>
		<td>Цена для <b>Коммерческое</b> объявление</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
			<b>Оплата офлайн</b>
		</td>
	</tr>

	<tr>
		<td>Включить офлайн оплату</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_offline_payment", "", $row->use_offline_payment ); ?></td>
		<td>Установить <b>Да</b> чтобы включить возможность оплаты офлайн через банковский перевод</td>
	</tr>

	<tr>
		<td valign="top">Офлайн&nbsp;Оплата&nbsp;Текст</td>
		<td>
		<textarea name="offline_payment_text" cols="40" rows="5" wrap="VIRTUAL"><?php echo $row->offline_payment_text; ?></textarea>
		</td>
		<td valign="top">Текст который будет показан если пользователь выберет офлайн оплату. Введите данные вашего Банковского аккаунта здесь.</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
			<b>Оплата PayPal</b>
		</td>
	</tr>

	<tr>
		<td>Включить оплату PayPal</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_paypal_payment", "", $row->use_paypal_payment ); ?></td>
		<td>Установить <b>Да</b> чтобы включить оплату PayPal </td>
	</tr>

	<tr>
		<td>Запустить оплату PayPal в тестовом режиме?</td>
		<td><?php echo mosHTML::yesnoSelectList( "use_paypal_testmode", "", $row->use_paypal_testmode ); ?></td>
		<td>Установить <b>Да</b> включить тестовый режим для оплаты по PayPal</td>
	</tr>

	<tr>
		<td>PayPal Business Id</td>
		<td><input type="text" name="paypal_businessid" value=<?php echo $row->paypal_businessid; ?> /></td>
		<td>Ваш PayPal Merchant Id (email)</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	</table>

	<?php
	$tabs->endTab();
	$tabs->endPane();
	?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="id" value=<?php echo $row->id; ?> />
	<input type="hidden" name="act" value="configuration" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }



    function listCategories($option, $rows, $pageNav) {
        global $mosConfig_absolute_path;
	?>

	<table class="adminheading">
       <tr>
          <th>Категории Marketplace</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	<th class="title" width="5%">Id</th>
	<th class="title" width="5%">Родитель</th>

	<th class="title" width="15%">Категория</th>
	<th class="title" width="25%">Описание</th>

	<th class="title" width="10%">Изображение</th>
	<th class="title" width="10%">Изображение 2</th>
	<th class="title" width="10%">Имеет записи</th>
	<th class="title" width="10%">Пересортировка</th>
	<th class="title" width="10%">Сортировка</th>


	<th width="5%">Опубликовано</th>
	</tr>


	<?php
	$k = 0;
	$n = count( $rows );
	for($i=0; $i < count( $rows ); $i++) {
	    $row = $rows[$i];

    	if($row->parent==0){?>
       		<tr bgcolor="#E5EEFF"><?php
    	}else{?>
			<tr class="<?php echo "row$k"; ?>">
    	<?php }?>

		<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		<td><?php echo $row->id; ?></td>
		<td><?php echo $row->parent; ?></td>


		<td>
			<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
				<?php
				if( $row->has_entries==0) {
					echo $row->name;
				}
				else {
					echo $row->name;
				}
				?>
			</a>
		</td>

		<td><?php echo $row->description; ?></td>

		<td><?php echo $row->image; ?></td>

		<td><?php echo $row->image2; ?></td>

    	<td><?php echo ($row->has_entries==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

		<td>
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td width="15">
						<?php
							echo $pageNav->orderUpIcon( $i );
						?>
					</td>
					<td width="15">
						<?php
							echo $pageNav->orderDownIcon( $i, $n );
						?>
					</td>
				</tr>
			</table>
		</td>

		<td><?php echo $row->sort_order; ?></td>


		<td align="center">
   		<?php
   		if ($row->published == "1") {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		} else {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		}
   		?>
		</td>
		<?php $k = 1 - $k; ?>
		</tr>
	<?php }

	?>
	</table>

	<?php echo $pageNav->getListFooter(); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="categories" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include( $mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }



    function editCategory( $option, $row ) {
        global $database, $mosConfig_absolute_path;

        $categories = array();
        $categories[] = mosHTML::makeOption( '0', 'Top' );
        $database->setQuery( "SELECT id AS value, name AS text FROM #__marketplace_categories WHERE parent=0 ORDER BY sort_order" );
        $categories = array_merge( $categories, $database->loadObjectList() );
	?>

    <table class="adminheading">
       <tr>
          <th>Категории Marketplaces</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Родитель: </td>
	<td><?php

	if( $row->id > 0) {
	    $select_id=$row->parent;
	}
	else {
	    $select_id=0;
	}

	$html = mosHTML::selectList( $categories, 'parent', 'size="1" class="inputbox"', 'value', 'text', $select_id);
	echo $html;
 	?></td>
	<td>Родительская категория, 'Top' если нет родителя</td>
	</tr>

	<tr>
	<td>Имеет записи: </td>
	<td><?php echo mosHTML::yesnoSelectList( "has_entries", "", $row->has_entries ); ?></td>
	<td>Выберите "Нет" для Категории без объявлений (раздел для других категорий), или "Да" для категорий с объявлениями</td>
	</tr>

	<tr>
		<td>Автопубликация?</td>
		<td>
			<?php
			$pub = array();
			$pub[] = mosHTML::makeOption( '-1', 'Общие' );
			$pub[] = mosHTML::makeOption( '0', 'Нет' );
			$pub[] = mosHTML::makeOption( '1', 'Да' );
			$html = mosHTML::selectList( $pub, 'ad_default', 'size="1" class="inputbox"', 'value', 'text', $row->ad_default);
			echo $html;
			?>
		</td>
		<td>Выберите to <b>Да</b>, чтобы объявление сразу публиковалось, <b>Нет</b> после проверки администратором. <b>Общие</b> настройки по умолчанию.</td>
	</tr>

	<tr>
		<td>Разрешить платные объявления:</td>
		<td>
			<?php
			$paid = array();
			$paid[] = mosHTML::makeOption( '-1', 'Общие' );
			$paid[] = mosHTML::makeOption( '0', 'Нет' );
			$paid[] = mosHTML::makeOption( '1', 'Да' );
			$html = mosHTML::selectList( $paid, 'use_paid_ads', 'size="1" class="inputbox"', 'value', 'text', $row->use_paid_ads);
			echo $html;
			?>
		</td>
		<td>Выберите <b>Да</b> чтобы разрешить платные объявления, выберите <b>Нет</b> для бесплатных объявлений в этой категории. <b>Общие</b> настройки по умолчанию.</td>
	</tr>

	<tr>
		<td>Изменить цену основного объявления?</td>
		<td><?php echo mosHTML::yesnoSelectList( "overwrite_paid_ads_price_basic", "", $row->overwrite_paid_ads_price_basic ); ?></td>
		<td>Выберите <b>Да</b> чтобы использовать цену из поля ниже, <b>Нет</b> чтобы использовать базовую цену (Общие настройки)</td>
	</tr>

	<tr>
		<td>Основное платное объявление:</td>
		<td><input type="text" name="paid_ads_price_basic" value=<?php echo $row->paid_ads_price_basic; ?> /></td>
		<td>Цена для основного платного объявления без дополнительных функций</td>
	</tr>

	<tr>
		<td>Изменить цену Top объявления?</td>
		<td><?php echo mosHTML::yesnoSelectList( "overwrite_paid_ads_price_top", "", $row->overwrite_paid_ads_price_top ); ?></td>
		<td>Выберите <b>Да</b> чтобы использовать цену из поля ниже, <b>Нет</b> чтобы использовать базовую цену (Общие настройки)</td>
	</tr>

	<tr>
		<td>Цена Top объявления:</td>
		<td><input type="text" name="paid_ads_price_top" value=<?php echo $row->paid_ads_price_top; ?> /></td>
		<td>Цена для <b>Top</b> объявления</td>
	</tr>

	<tr>
		<td>Изменить цену похожего объявления?</td>
		<td><?php echo mosHTML::yesnoSelectList( "overwrite_paid_ads_price_featured", "", $row->overwrite_paid_ads_price_featured ); ?></td>
		<td>Выберите <b>Да</b> чтобы использовать цену из поля ниже, <b>Нет</b> чтобы использовать базовую цену (Общие настройки)</td>
	</tr>

	<tr>
		<td>Цена похожего объявления:</td>
		<td><input type="text" name="paid_ads_price_featured" value=<?php echo $row->paid_ads_price_featured; ?> /></td>
		<td>Цена для <b>Похожего</b> объявления</td>
	</tr>

	<tr>
		<td>Изменить цену коммерческого объявления?</td>
		<td><?php echo mosHTML::yesnoSelectList( "overwrite_paid_ads_price_commercial", "", $row->overwrite_paid_ads_price_commercial ); ?></td>
		<td>Выберите <b>Да</b> чтобы использовать цену из поля ниже, <b>Нет</b> чтобы использовать базовую цену (Общие настройки)</td>
	</tr>

	<tr>
		<td>Цена коммерческого объявления:</td>
		<td><input type="text" name="paid_ads_price_commercial" value=<?php echo $row->paid_ads_price_commercial; ?> /></td>
		<td>Цена для <b>Коммерческого</b> объявления</td>
	</tr>


	<tr>
	<td>Название: </td>
	<td><input type="text" size="50" maxsize="100" name="name" value="<?php echo $row->name; ?>" /></td>
	<td>Название категории</td>
	</tr>

	<tr>
	<td>Описание: </td>
	<td><input size="50" name="description" value="<?php echo $row->description; ?>"></td>
	<td>Описание категории</td>
	</tr>

	<tr>
	<td>Изображение: </td>
	<td><input size="50" name="image" value="<?php echo $row->image; ?>"></td>
	<td>Напишите 'default.gif' для стандартного символа</td>
	</tr>

	<tr>
	<td>Изображение 2: </td>
	<td><input size="50" name="image2" value="<?php echo $row->image2; ?>"></td>
	<td>Второе изображение для использования в модулях</td>
	</tr>

	</table>

	<input type="hidden" name="sort_order" value="<?php echo $row->sort_order; ?>" />
	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="categories" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }




    function listAds($option, $rows, $pageNav) {
        global $database, $mosConfig_absolute_path;
	?>

    <table class="adminheading">
       <tr>
          <th>Объявления</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	<th class="title" width="5%">Id</th>

	<th class="title" width="25%">Заголовок</th>
	<th width="15%">Категория</th>
	<th width="5%">Изображения</th>
	<th width="10%">Тип</th>

	<th width="5%">Создано</th>
	<th width="5%">Отредактировано</th>

	<th width="5%">Top</th>
	<th width="5%">Похожее</th>
	<th width="5%">Коммерч.</th>
	<th width="5%">Платное</th>
	<th width="5%">Опубликовано</th>
	</tr>


	<?php
	$k = 0;
	for($i=0; $i < count( $rows ); $i++) {
	    $row = $rows[$i]; ?>

			<tr class="<?php echo "row$k"; ?>">

		<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		<td><?php echo $row->id; ?></td>

		<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $row->ad_headline; ?></a></td>

		<?php
		$database->setQuery( "SELECT name FROM #__marketplace_categories WHERE id='$row->category'");
		$afCategory = $database->loadResult();
        ?>

		<td align="center"><?php echo $afCategory; ?></td>

		<td align="center"><?php echo $row->ad_image; ?></td>

		<td align="center">
			<?php
            // get ad type from db
            $database->setQuery( "SELECT name FROM #__marketplace_types WHERE id='$row->ad_type'");
            $sAdType = $database->loadResult();
            echo $sAdType;
            ?>
        </td>

		<td align="center"><?php echo $row->date_created; ?></td>

		<td align="center"><?php echo $row->date_lastmodified; ?></td>

    	<td align="center"><?php echo ($row->flag_top==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

    	<td align="center"><?php echo ($row->flag_featured==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

    	<td align="center"><?php echo ($row->flag_commercial==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

		<td align="center">
			<?php
			switch ( $row->payment) {
				case 1: { // Bank Transfer
					echo "BT";
					break;
				}
				case 2: { // Paypal
					echo "PP";
					break;
				}
				default: { // default
					echo "--";
					break;
				}
			}
			?>
		</td>

		<td align="center">
   		<?php
   		if ($row->published == "1") {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		} else {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		}
   		?>
		</td>
		<?php $k = 1 - $k; ?>
		</tr>

		<?php }

	   ?>
	</table>

	<?php echo $pageNav->getListFooter(); ?>


	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="ads" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }




    function editAd( $option, $row ) {

        global $database, $mosConfig_absolute_path, $mosConfig_live_site, $my;

        if ($row->id == '') {
            $database->setQuery( "SELECT CURRENT_DATE()");
            $date_created = $database->loadResult();
        }
        $database->setQuery( "SELECT CURRENT_DATE()");
        $date_lastmodified = $database->loadResult();

        // get configuration data
        $database->setQuery("SELECT * FROM #__marketplace_config LIMIT 1");
        $config = $database->loadObjectList();

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
		$images_per_ad = (int)$config[0]->images_per_ad;

        $categories = array();
        $database->setQuery( "SELECT id AS value, name AS text FROM #__marketplace_categories WHERE has_entries > 0 ORDER BY sort_order" );
        $categories = array_merge( $categories, $database->loadObjectList() );

        // get ad types
        $database->setQuery("SELECT id, name FROM #__marketplace_types WHERE published='1' ORDER BY sort_order");
        $rows_type = $database->loadObjectList();

        $types = array();
        foreach( $rows_type as $rowtype) {
            $types[] = mosHTML::makeOption( $rowtype->id, $rowtype->name );
        }

	?>

    <table class="adminheading">
       <tr>
          <th>Объявления</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" name="adminForm" method="post" enctype="multipart/form-data">

	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<td>Id: </td>
	<td>
		<?php
		echo "<b>".$row->id."</b>";
 		?>
 	</td>
	<td>ID объявления</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	<td>Top-объявление: </td>
	<td><?php echo mosHTML::yesnoSelectList( "flag_top", "", $row->flag_top ); ?></td>
	<td>Top-объявления отображаются вверху списка, после них идут "обычные" объявления</td>
	</tr>

	<tr>
	<td>Похожее объявление: </td>
	<td><?php echo mosHTML::yesnoSelectList( "flag_featured", "", $row->flag_featured ); ?></td>
	<td>Похожие объявления отображаются особым образом (средствами CSS)</td>
	</tr>

	<tr>
	<td>Коммерческое объявление: </td>
	<td><?php echo mosHTML::yesnoSelectList( "flag_commercial", "", $row->flag_commercial ); ?></td>
	<td>Похожие объявления отображаются особым образом (средствами CSS)</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>


	<tr>
	<td>ID пользователя/Пользователь: </td>
	<td>
	<?php
	if( $row->userid == '') {
	?>
	   <input type="text" size="5" maxsize="10" name="userid" value="<?php echo $my->id; ?>" />
	   &nbsp;&nbsp;
	   <input type="text" size="40" maxsize=40" name="user" value="<?php echo $my->username; ?>" />
	<?php
	}
	else {
	?>
	   <input type="text" size="5" maxsize="10" name="userid" value="<?php echo $row->userid; ?>" />
	   &nbsp;&nbsp;
	   <input type="text" size="40" maxsize=40" name="user" value="<?php echo $row->user; ?>" />
	<?php
	}
	?>
	</td>
	<td>ID пользователя и имя пользователя</td>
	</tr>


	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	<td>Имя: </td>
	<td><input type="text" size="50" maxsize="50" name="name" value="<?php echo $row->name; ?>" />&nbsp;(обязательно)</td>
	<td>Имя</td>
	</tr>

	<?php
	if ($use_surname) {
	?>
	   <tr>
	   <td>Фамилия: </td>
	   <td><input type="text" size="50" maxsize="50" name="surname" value="<?php echo $row->surname; ?>" /></td>
	   <td>Фамилия</td>
	   </tr>
	<?php
	}
	?>


	<?php
	if ($use_street) {
	?>
	<tr>
	<td>Улица: </td>
	<td><input type="text" size="50" maxsize="50" name="street" value="<?php echo $row->street; ?>" /></td>
	<td>Улица</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_zip) {
	?>
	<tr>
	<td>Индекс: </td>
	<td><input type="text" size="5" maxsize="10" name="zip" value="<?php echo $row->zip; ?>" /></td>
	<td>Индекс</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_city) {
	?>
	<tr>
	<td>Город: </td>
	<td><input type="text" size="50" maxsize="50" name="city" value="<?php echo $row->city; ?>" /></td>
	<td>Город</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_state) {
	?>
	<tr>
	<td>Край/Область: </td>
	<td><input type="text" size="50" maxsize="50" name="state" value="<?php echo $row->state; ?>" /></td>
	<td>Край/Область</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_country) {
	?>
	<tr>
	<td>Страна: </td>
	<td><input type="text" size="50" maxsize="50" name="country" value="<?php echo $row->country; ?>" /></td>
	<td>Страна</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_phone1) {
	?>
	<tr>
	<td>Телефон: </td>
	<td><input type="text" size="50" maxsize="50" name="phone1" value="<?php echo $row->phone1; ?>" /></td>
	<td>Телефон</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_phone2) {
	?>
	<tr>
	<td>Мобильный: </td>
	<td><input type="text" size="50" maxsize="50" name="phone2" value="<?php echo $row->phone2; ?>" /></td>
	<td>Мобильный</td>
	</tr>
	<?php
	}
	?>


	<tr>
	<td>Email: </td>
	<td><input type="text" size="50" maxsize="50" name="email" value="<?php echo $row->email; ?>" />&nbsp;(обязательно)</td>
	<td>Email для связи</td>
	</tr>


	<?php
	if ($use_web) {
	?>
	<tr>
	<td>Сайт: </td>
	<td><input type="text" size="50" maxsize="80" name="web" value="<?php echo $row->web; ?>" /></td>
	<td>Web-сайт</td>
	</tr>
	<?php
	}
	?>


	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>


	<tr>
	<td>Категория: </td>
	<td>
	<?php
	$html = mosHTML::selectList( $types, 'ad_type', 'size="1" class="inputbox"', 'value', 'text', $row->ad_type);
	echo $html;
	?>

	&nbsp;&nbsp;

	<?php
	if( $row->category > 0) {
	    $select_id=$row->category;
	}
	else {
	    $select_id=0;
	}

	$html = mosHTML::selectList( $categories, 'category', 'size="1" class="inputbox"', 'value', 'text', $select_id);
	echo $html;
	?>
	</td>
	<td>Категория объявления</td>
	</tr>


	<tr>
	<td>Заголовок: </td>
	<td><input type="text" size="50" maxsize="80" name="ad_headline" value="<?php echo htmlspecialchars($row->ad_headline, ENT_QUOTES); ?>" />&nbsp;(обязательно)</td>
	<td>Заголовок объявления</td>
	</tr>


	<tr>
	<td align="left" valign="top">Текст: </td>
	<td align="left" valign="top">
		<?php
		echo "<textarea name='ad_text' cols='60' rows='10' wrap='VIRTUAL'>$row->ad_text</textarea>";
		?>
		&nbsp;(обязательно)
	</td>
	<td align="left" valign="top">Текст объявления</td>
	</tr>


	<?php
	if ($use_condition) {
	?>
	<tr>
	<td>Условия: </td>
	<td><input type="text" size="50" maxsize="80" name="ad_condition" value="<?php echo $row->ad_condition; ?>" /></td>
	<td>Условия</td>
	</tr>
	<?php
	}
	?>


	<?php
	if ($use_price) {
	?>
	<tr>
	<td>Цена: </td>
	<td><input type="text" size="50" maxsize="50" name="ad_price" value="<?php echo $row->ad_price; ?>" /></td>
	<td>Цена</td>
	</tr>
	<?php
	}
	?>


	<tr>
		<td colspan="3">
			<br />
			<?php
	   		$imageid=$row->id;
	   		?>
		</td>
	</tr>



	<?php

	// loop over configured # of images
	for ( $i = 1; $i <= $images_per_ad; $i += 1) {

		$c = chr( 96 + $i);

		echo "<tr>";
			echo "<td valign='top'>Image".$i.":</td>";
			echo "<td colspan='2'>";

                echo "<input class='marketplace' id='ad_picture$i' type='file' name='ad_picture$i'>";

				if ($imageid <> '') { // update
				    $pic_jpg = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.jpg";
				    $pic_png = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.png";
				    $pic_gif = $mosConfig_absolute_path."/components/com_marketplace/images/entries/".$imageid.$c."_t.gif";

				    if ( file_exists( $pic_jpg)) {
				        echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$imageid.$c."_t.jpg' align='top' border='0'>";
				        echo "<input type='checkbox' name='cb_image$i' value='delete'>"." Delete";
				    }
				    else {
				        if ( file_exists( $pic_png)) {
				            echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$imageid.$c."_t.png' align='top' border='0'>";
				            echo "<input type='checkbox' name='cb_image$i' value='delete'>"." Delete";
				        }
				        else {
				            if ( file_exists( $pic_gif)) {
				                echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/entries/".$imageid.$c."_t.gif' align='top' border='0'>";
				                echo "<input type='checkbox' name='cb_image$i' value='delete'>"." Delete";
				            }
				        }
				    }
				}


			echo "</td>";
		echo "</tr>";

	}
	?>


	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="ads" />
	<input type="hidden" name="imageid" value="<?php echo $imageid; ?>" />

	<?php
	if ($row->id == '') {
	?>
	   <input type="hidden" name="date_created" value="<?php echo $date_created; ?>" />
	<?php
	}
	?>
	<input type="hidden" name="date_lastmodified" value="<?php echo $date_lastmodified; ?>" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }




    function listTypes($option, $rows, $pageNav) {
        global $mosConfig_absolute_path;
	?>

	<table class="adminheading">
       <tr>
          <th>Типы</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	<th class="title" width="5%">Id</th>

	<th class="title" width="80%">Название</th>
	<th class="title" width="10%">сортировка</th>

	<th width="5%">Публикация</th>
	</tr>


	<?php
	$k = 0;
	for($i=0; $i < count( $rows ); $i++) {
	    $row = $rows[$i];
        ?>

		<tr class="<?php echo "row$k"; ?>">


		<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		<td><?php echo $row->id; ?></td>

		<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $row->name; ?></a></td>

		<td><?php echo $row->sort_order; ?></td>


		<td align="center">
   		<?php
   		if ($row->published == "1") {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		} else {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		}
   		?>
		</td>
		<?php $k = 1 - $k; ?>
		</tr>
	<?php }

	?>
	</table>

	<?php echo $pageNav->getListFooter(); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="types" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include( $mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }



    function editType( $option, $row ) {
        global $database, $mosConfig_absolute_path;

	?>

    <table class="adminheading">
       <tr>
          <th>Типы</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Наименование: </td>
	<td><input type="text" size="50" maxsize="100" name="name" value="<?php echo $row->name; ?>" /></td>
	<td>Наименование типа объявления</td>
	</tr>


	<tr>
	<td>Сортировка: </td>
	<td><input size="10" name="sort_order" value="<?php echo $row->sort_order; ?>"></td>
	<td>Порядок сортировки</td>
	</tr>

	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="types" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }
	
// Subdomens
  function listSubdomens($option, $rows, $pageNav) {
        global $mosConfig_absolute_path;
	?>

	<table class="adminheading">
       <tr>
          <th>Поддомены</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	<th class="title" width="5%">Id</th>

	<th class="title" width="17%">Название</th>
	<th class="title" width="20%">Описание</th>
	<th class="title" width="23%">Количество строк</th>
	<th class="title" width="20%">Наибольший номер</th>
	<th class="title" width="10%">сортировка</th>

	<th width="5%">Публикация</th>
	</tr>


	<?php
	$k = 0; $totalads = 0;
	for($i=0; $i < count( $rows ); $i++) {
	    $row = $rows[$i];
        ?>

		<tr class="<?php echo "row$k"; ?>">


		<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		<td><?php echo $row->id; ?></td>

		<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $row->name; ?></a></td>
		
		<td><?php echo $row->description; ?></td>
		<td><?php $totalads = $totalads + $row->countads; echo $row->countads; ?></td>
		<td><?php echo $row->lastid; ?></td>

		<td><?php echo $row->sort_order; ?></td>


		<td align="center">
   		<?php
   		if ($row->published == "1") {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		} else {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		}
   		?>
		</td>
		<?php $k = 1 - $k; ?>
		</tr>
	<?php }

	?>
	</table>
	<?php echo '<p>Всего объявлений '.$totalads; ?>
	

	<?php echo $pageNav->getListFooter(); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="subdomens" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include( $mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }



    function editSubdomens( $option, $row ) {
        global $database, $mosConfig_absolute_path;

	?>

    <table class="adminheading">
       <tr>
          <th>Поддомены</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Наименование: </td>
	<td><input type="text" size="50" maxsize="100" name="name" value="<?php echo $row->name; ?>" /></td>
	<td>Наименование субдомена</td>
	</tr>

	<tr>
	<td>driver: </td>
	<td><input type="text" size="50" maxsize="100" name="basedriver" value="<?php echo $row->basedriver; ?>" /></td>
	<td>Драйвер базы</td>
	</tr>
	
	<tr>
	<td>host: </td>
	<td><input type="text" size="50" maxsize="100" name="hostbase" value="<?php echo $row->hostbase; ?>" /></td>
	<td>Сервер базы</td>
	</tr>
	
	<tr>
	<td>base: </td>
	<td><input type="text" size="50" maxsize="100" name="basename" value="<?php echo $row->basename; ?>" /></td>
	<td>Наименование базы</td>
	</tr>
	
	<tr>
	<td>username: </td>
	<td><input type="text" size="50" maxsize="100" name="userbase" value="<?php echo $row->userbase; ?>" /></td>
	<td>Наименование пользователя базы</td>
	</tr>
	
	<tr>
	<td>password: </td>
	<td><input type="password" size="50" maxsize="100" name="passwordbase" value="<?php echo $row->passwordbase; ?>" /></td>
	<td>Пароль базы</td>
	</tr>

	<tr>
	<td>prefix: </td>
	<td><input type="text" size="50" maxsize="100" name="prefixbase" value="<?php echo $row->prefixbase; ?>" /></td>
	<td>префикс базы</td>
	</tr>

	<tr>
	<td>Описание: </td>
	<td><input size="50" name="description" value="<?php echo $row->description; ?>"></td>
	<td>Назначение поддомена</td>
	</tr>
	
		<tr>
	<td>Наибольший номер: </td>
	<td><input size="10" name="lastid" value="<?php echo $row->lastid; ?>"></td>
	<td>Наибольший номер считанной записи</td>
	</tr>
	
		<tr>
	<td>Сортировка: </td>
	<td><input size="10" name="sort_order" value="<?php echo $row->sort_order; ?>"></td>
	<td>Порядок сортировки</td>
	</tr>

	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="subdomens" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }

	function downloadSubdomens( $option, $row ) {
        global $database, $mosConfig_absolute_path;
//echo "downloadSubdomens1 ".$option." ".$row[0]." ".$row;
	?>

    <table class="adminheading">
       <tr>
          <th>Поддомены downloads</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Наименование: </td>
	<td><?php echo $row->name; ?></td>
	<td>Наименование субдомена</td>
	</tr>

	<tr>
	<td>driver: </td>
	<td><?php echo $row->basedriver; ?></td>
	<td>Драйвер базы</td>
	</tr>
	
	<tr>
	<td>host: </td>
	<td><?php echo $row->hostbase; ?></td>
	<td>Сервер базы</td>
	</tr>
	
	<tr>
	<td>base: </td>
	<td><?php echo $row->basename; ?></td>
	<td>Наименование базы</td>
	</tr>
	
	<tr>
	<td>username: </td>
	<td><?php echo $row->userbase; ?></td>
	<td>Наименование пользователя базы</td>
	</tr>
	
	<tr>
	<td>password: </td>
	<td>********</td>
	<td>Пароль базы</td>
	</tr>

	<tr>
	<td>prefix: </td>
	<td><?php echo $row->prefixbase; ?></td>
	<td>префикс базы</td>
	</tr>


	<tr>
	<td>Описание: </td>
	<td><?php echo $row->description; ?></td>
	<td>Назначение поддомена</td>
	</tr>
	
		<tr>
	<td>Наибольший номер: </td>
	<td><?php echo $row->lastid; ?></td>
	<td>Наибольший номер считанной записи</td>
	</tr>
	
		<tr>
	<td>Сортировка: </td>
	<td><?php echo $row->sort_order; ?></td>
	<td>Порядок сортировки</td>
	</tr>

	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="subdomens" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }

		function nowdownloadSubdomens( $option, $row ) {
        global $database, $mosConfig_absolute_path;
echo "nowdownloadSubdomens1 ".$option." ".$row[0]." ".$row;
	?>
	<br style="clear:both" />
	<br />

	   <table class="adminheading">
       <tr>
          <th>Поддомены downloads</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Наименование: </td>
	<td><?php echo $row->name; ?></td>
	<td>Наименование субдомена</td>
	</tr>

			<tr>
	<td>base: </td>
	<td><input type="text" size="50" maxsize="100" name="basename" value="<?php echo $row->basename; ?>" /></td>
	<td>Наименование базы</td>
	</tr>
	
	<tr>
	<td>host: </td>
	<td><input type="text" size="50" maxsize="100" name="hostbase" value="<?php echo $row->hostbase; ?>" /></td>
	<td>Сервер базы</td>
	</tr>
	
	<tr>
	<td>base: </td>
	<td><input type="text" size="50" maxsize="100" name="basename" value="<?php echo $row->basename; ?>" /></td>
	<td>Наименование базы</td>
	</tr>
	
	<tr>
	<td>username: </td>
	<td><input type="text" size="50" maxsize="100" name="userbase" value="<?php echo $row->userbase; ?>" /></td>
	<td>Наименование пользователя базы</td>
	</tr>
	
	<tr>
	<td>password: </td>
	<td><input type="password" size="50" maxsize="100" name="passwordbase" value="<?php echo $row->passwordbase; ?>" /></td>
	<td>Пароль базы</td>
	</tr>

	<tr>
	<td>prefix: </td>
	<td><input type="text" size="50" maxsize="100" name="prefixbase" value="<?php echo $row->prefixbase; ?>" /></td>
	<td>префикс базы</td>
	</tr>


	<tr>
	<td>Описание: </td>
	<td><input size="50" name="description" value="<?php echo $row->description; ?>"></td>
	<td>Назначение поддомена</td>
	</tr>
	
		<tr>
	<td>Наибольший номер: </td>
	<td><input size="10" name="lastid" value="<?php echo $row->lastid; ?>"></td>
	<td>Наибольший номер считанной записи</td>
	</tr>
	
		<tr>
	<td>Сортировка: </td>
	<td><input size="10" name="sort_order" value="<?php echo $row->sort_order; ?>"></td>
	<td>Порядок сортировки</td>
	</tr>

	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="subdomens" />

	</form>

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }	
	
    function listUsers($option, $rows, $pageNav) {
       global $database, $mosConfig_absolute_path;
	   ?>

	   <table class="adminheading">
           <tr>
               <th>Пользователи</th>
           </tr>
       </table>
	   <br />

       <form action="index2.php" method="post" name="adminForm">
	       <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	           <tr>
	               <th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
	               <th class="title">Username</th>
	               <th class="title" width="5%" style="text-align: center;">Блокировано</th>
	               <th class="title" width="5%" style="text-align: center;">Админист.</th>
	               <th class="title" width="5%" style="text-align: center;">Модератор</th>

	               <th class="title" width="5%" style="text-align: center;">Top</th>
	               <th class="title" width="5%" style="text-align: center;">Похожее</th>
	               <th class="title" width="5%" style="text-align: center;">Коммерчес.</th>

	               <th class="title" width="10%" style="text-align: center;">Дата&nbsp;Начала</th>
	               <th class="title" width="10%" style="text-align: center;">Дата&nbsp;Завершения</th>

	               <th width="5%">Публикация</th>
	           </tr>

	           <?php
	           $k = 0;
	           for($i=0; $i < count( $rows ); $i++) {
	               $row = $rows[$i];
                    ?>
		           <tr class="<?php echo "row$k"; ?>">

		              <td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		              <td>
		                  <?php
                          $database->setQuery( "SELECT username FROM #__users WHERE id='".$row->userid."'");
                          $username = $database->loadResult();
		                  ?>
		                  <a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $username; ?></a>
		              </td>



    	              <td align="center"><?php echo ($row->isBlocked==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

    	              <td align="center"><?php echo ($row->isAdmin==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>
    	              <td align="center"><?php echo ($row->isModerator==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

    	              <td align="center"><?php echo ($row->flag_top==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>
    	              <td align="center"><?php echo ($row->flag_featured==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>
    	              <td align="center"><?php echo ($row->flag_commercial==1 ? "<img src=\"images/tick.png\">" : "<img src=\"images/publish_x.png\">"); ?></td>

		              <td align="center"><?php echo $row->date_begin; ?></td>
		              <td align="center"><?php echo $row->date_end; ?></td>


		              <td align="center">
   		                   <?php
   		                   if ($row->published == "1") {
   		                       echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		                   } else {
   		                       echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		                   }
   		                   ?>
		              </td>

		              <?php $k = 1 - $k; ?>
		          </tr>
	           <?php
	           }
	           ?>
	       </table>

	       <?php echo $pageNav->getListFooter(); ?>

	       <input type="hidden" name="option" value="<?php echo $option; ?>" />
	       <input type="hidden" name="task" value="" />
	       <input type="hidden" name="boxchecked" value="0" />
	       <input type="hidden" name="act" value="users" />
	   </form>

	   <br style="clear:both" />
	   <br />

	   <?php
	echo "<center>";
	   echo "<table>";
	       echo "<tr>";
	           echo "<td>";
	               include( $mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	           echo "</td>";
	       echo "</tr>";
	   echo "</table>";
	echo "</center>";
    }

/*****************************************************************************/
    function editUser( $option, $row ) {
        global $database, $mosConfig_absolute_path;

        $userid = (int) $row->userid;
        ?>

        <link rel="stylesheet" type="text/css" media="all" href="<?php echo $mosConfig_live_site.'/components/com_marketplace/jscalendar/calendar-system.css'; ?>" title="win2k-1" />
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/components/com_marketplace/jscalendar/calendar.js"></script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/components/com_marketplace/jscalendar/calendar-en.js"></script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/components/com_marketplace/jscalendar/calendar-setup.js"></script>


        <table class="adminheading">
            <tr>
                <th>Пользователи</th>
            </tr>
        </table>
	   <br />

	   <form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	   <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	   <td width="150">Имя пользователя: </td>
       <?php
	   if ( $userid > 0) { // edit mode
            $database->setQuery( "SELECT username FROM #__users WHERE id='".$userid."'");
            $username = $database->loadResult();
		    echo "<td width='200'><b>".$username."</b></td>";
       }
       else {  // new user
 	   ?>
	       <td>
	           <?php
               $users = array();
               $database->setQuery( "SELECT id AS value, username AS text FROM #__users WHERE block='0' ORDER BY username ASC" );
               $userlist = array_merge( $users, $database->loadObjectList() );
	           $html = mosHTML::selectList( $userlist, 'userid', 'size="1" class="inputbox"', 'value', 'text');
	           echo $html;
               ?>
	       </td>
	   <?php
       }
       ?>
	   <td>&nbsp;</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	   <td>Заблокирован: </td>
	   <td><?php echo mosHTML::yesnoSelectList( "isBlocked", "", $row->isBlocked ); ?></td>
	   <td>Выберите <b>Да</b>, чтобы заблокировать пользователя. Тогда он не сможет писать объявления в Marketplace, <b>Нет</b> = пользователь может писать объявления</td>
	</tr>

	<tr>
	   <td>Администратор: </td>
	   <td><?php echo mosHTML::yesnoSelectList( "isAdmin", "", $row->isAdmin ); ?></td>
	   <td>Выберите <b>Да</b>, чтобы сделать пользователя Администратором(!). Как Администратор он сможет удалять и редактировать все объявления в Marketplace, <b>Нет</b> = нет привелегий Администратора</td>
	</tr>

	<tr>
	   <td>Модератор: </td>
	   <td><?php echo mosHTML::yesnoSelectList( "isModerator", "", $row->isModerator ); ?></td>
	   <td>Выберите <b>Да</b> чтобы сделать пользователя Модератором(!) для одной или нескольких категорий. Как Модератор он сможет удалять и редактировать объявления из определенной категории, <b>Нет</b> = нет привелегий Модератора</td>
	</tr>

	<tr>
	   <td valign="top">Категории: </td>
	   <td valign="top">
		    <?php
            $catlist = array();
            $database->setQuery( "SELECT id AS value, name AS text FROM #__marketplace_categories WHERE has_entries='1'" );
            $catlist = array_merge( $catlist, $database->loadObjectList() );

            $selected_cats = explode( ',', $row->categories );
			foreach( $selected_cats as $selected_cat ) {
			    $selected[] = mosHTML::makeOption( $selected_cat, $selected_cat );
			}

            echo mosHTML::selectList( $catlist, 'categories[]', 'size="5" class="inputbox" multiple="true"', 'value', 'text', $selected);
            ?>
	   </td>
	   <td valign="top">Категории для модерации для этого пользователя. В поле <b>Модератор</b> должно быть значение <b>Да</b></td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	   <td>Отметить как "Top": </td>
	   <td><?php echo mosHTML::yesnoSelectList( "flag_top", "", $row->flag_top ); ?></td>
	   <td>Выберите <b>Да</b> чтобы отметить все объявления этого пользователя как "Top" </td>
	</tr>

	<tr>
	   <td>Отметить как "Похожее": </td>
	   <td><?php echo mosHTML::yesnoSelectList( "flag_featured", "", $row->flag_featured ); ?></td>
	   <td>Выберите <b>Да</b> чтобы отметить все объявления этого пользователя как "Похожие" </td>
	</tr>

	<tr>
	   <td>Отметить как "Коммерческое": </td>
	   <td><?php echo mosHTML::yesnoSelectList( "flag_commercial", "", $row->flag_commercial ); ?></td>
	   <td>Выберите <b>Да</b> чтобы отметить все объявления этого пользователя как "Коммерческие" </td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	   <td>Дата начала: </td>
	   <td width="200">
	       <?php
            if( $userid > 0) {  // edit user
               ?>
               <input size="10" type="text" name="date_begin" id="f_date_begin" value="<?php echo $row->date_begin; ?>"/><button type="reset" id="f_trigger_a">...</button>
	           <?php
            }
            else {  // new user
                ?>
               <input size="10" type="text" name="date_begin" id="f_date_begin" value="<?php echo date("Y-m-d"); ?>"/><button type="reset" id="f_trigger_a">...</button>
	           <?php
            }
            ?>
               <script type="text/javascript">
                    Calendar.setup({
                        inputField     :    "f_date_begin",  // id of the input field
                        ifFormat       :    "%Y-%m-%d",      // format of the input field
                        showsTime      :    false,           // will display a time selector
                        button         :    "f_trigger_a",   // trigger for the calendar (button ID)
                        singleClick    :    true,            // double-click mode
                        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
                    });
               </script>
	   </td>
	   <td>Начальная дата для этой записи. Формат: ГГГГ-ММ-ДД</td>
	</tr>

	<tr>
	   <td>Дата завершения: </td>
	   <td width="200">
	       <?php
            if( $userid > 0) {  // edit user
               ?>
               <input size="10" type="text" name="date_end" id="f_date_end" value="<?php echo $row->date_end; ?>"/><button type="reset" id="f_trigger_b">...</button>
	           <?php
            }
            else {  // new user
                ?>
               <input size="10" type="text" name="date_end" id="f_date_end" value="<?php echo date("Y-m-d"); ?>"/><button type="reset" id="f_trigger_b">...</button>
	           <?php
            }
            ?>
               <script type="text/javascript">
                    Calendar.setup({
                        inputField     :    "f_date_end",    // id of the input field
                        ifFormat       :    "%Y-%m-%d",      // format of the input field
                        showsTime      :    false,           // will display a time selector
                        button         :    "f_trigger_b",   // trigger for the calendar (button ID)
                        singleClick    :    true,            // double-click mode
                        step           :    1                // show all years in drop-down boxes (instead of every other year as default)
                    });
               </script>
	   </td>
	   <td>Дата завершения для этой записи. Формат: ГГГГ-ММ-ДД</td>
	</tr>

	<tr>
		<td colspan="3">
			<br />
		</td>
	</tr>

	<tr>
	   <td>Публикация: </td>
	   <td><?php echo mosHTML::yesnoSelectList( "published", "", $row->published ); ?></td>
	   <td>Публиковать/Снять с публикации эту запись </td>
	</tr>





	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="users" />

	</form>

	<br style="clear:both" />
	<br />


	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }




function showAbout($option) {
	global $mosConfig_absolute_path, $mosConfig_live_site;
    ?>

    <center>

    <table class="adminheading">
       <tr>
          <th>Информация о Marketplace</th>
       </tr>
    </table>
	<br />


	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
		<td align="center">
            <h3>Классификатор объявлений - Marketplace</h3>
            <h4>Version 1.4.6</h4>
            <br />
            <b>Разработчик Codingfish, изменение для многосайтов Роман</b>
            <br />
            <br />

			<a href="#" target="_blank" title="Codingfish Limited" style="text-decoration:none;">
            	<?php
            	echo "<img src='".$mosConfig_live_site."/components/com_marketplace/images/system/codingfish.png' width='175' height='60' border='0'>";
            	?>
            </a>
            	<br />
            	<br />
			<a href="#" target="_blank" title="Codingfish Limited">
            	Codingfish Limited
            </a>
            <br />
            <br />

            Achim Fischer
            <br />
            <br />

		</td>
	</tr>

	<tr>
		<td align="center">
            <b>Список участников</b>
            <br />
            <br />

            Hans Paas <a href="http://anonym.to/?http://www.eurodomein.net/" target="_blank">www.eurodomein.net</a> - Dutch language translation
            <br />
            <br />

            Mika Salo <a href="http://anonym.to/?http://www.rakshop.net/" target="_blank">www.rakshop.net</a> - Finnish language translation
            <br />
            <br />

            Thomas Mallie <a href="http://anonym.to/?http://www.airlibre.be/" target="_blank">www.airlibre.be</a> - French language translation
            <br />
            <br />

            Andreas Sotirakopoulos - Greek language translation
            <br />
            <br />

            Andrea Marucci <a href="http://anonym.to/?http://www.shift.it/" target="_blank">www.shift.it</a> - Italian language translation
            <br />
            <br />

            Emanuel Robu <a href="http://anonym.to/?http://www.robii.com/" target="_blank">www.robii.com</a> - Romanian language translation
            <br />
            <br />

            Enrique F. Becerra <a href="http://anonym.to/?http://www.beza.com.ar/" target="_blank">www.beza.com.ar</a> - Spanish language translation
            <br />
            <br />

            Bilal Arslan - Turkish language translation
            <br />
            <br />

		</td>
	</tr>

	<tr>
		<td align="center">

		    <b>Libraries / Icon Sets</b>
            <br />
            <br />

            MooTools by Valerio Proietti <a href="http://anonym.to/?http://mootools.net/" target="_blank">mootools.net</a>
            <br />
            <br />

            Slimbox by Christophe Beyls <a href="http://anonym.to/?http://www.digitalia.be/" target="_blank">www.digitalia.be</a>
            <br />
            <br />

            FamFamFam Silk Icon Set by Mark James <a href="http://anonym.to/?http://www.famfamfam.com/" target="_blank">www.famfamfam.com</a>
            <br />
            <br />

            DHTML Calendar Widget by Mihai Bazon <a href="http://anonym.to/?http://www.dynarch.com/" target="_blank">www.dynarch.com</a>
            <br />
            <br />

		</td>
	</tr>


	</table>

    </center>


	<br style="clear:both" />
    <br />

	<?php
	echo "<center>";
	echo "<table>";
	   echo "<tr>";
	       echo "<td>";
	           include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	       echo "</td>";
	   echo "</tr>";
	echo "</table>";
	echo "</center>";
}



    function listKeywords($option, $rows, $pageNav) {
        global $mosConfig_absolute_path;
	?>

	<table class="adminheading">
       <tr>
          <th>Ключевые слова</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">

	<tr>
	<th class="title" width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	<th class="title" width="5%">Id</th>

	<th class="title" width="20%">Ключевое слово</th>
	<th class="title" width="15%">Действие</th>
	<th class="title" width="50%">Информация</th>

	<th width="5%">Публикация</th>
	</tr>


	<?php
	$k = 0;
	for($i=0; $i < count( $rows ); $i++) {
	    $row = $rows[$i];
        ?>

		<tr class="<?php echo "row$k"; ?>">


		<td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>

		<td><?php echo $row->id; ?></td>

		<td><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $row->keyword; ?></a></td>

		<td>
		<?php
		  switch ( $row->action) {
		      case 1: {
		          echo "information";
		          break;
		      }
		      case 2: {
		          echo "warning";
		          break;
		      }
		      case 3: {
		          echo "block";
		          break;
		      }
		      default: {
		          echo "n.a.";
		          break;
		      }
		  }
		?>
		</td>

		<td><?php echo $row->infotext; ?></td>


		<td align="center">
   		<?php
   		if ($row->published == "1") {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','unpublish')\"><img src=\"images/publish_g.png\" border=\"0\" /></a>";
   		} else {
   		    echo "<a href=\"javascript: void(0);\" onClick=\"return listItemTask('cb$i','publish')\"><img src=\"images/publish_x.png\" border=\"0\" /></a>";
   		}
   		?>
		</td>
		<?php $k = 1 - $k; ?>
		</tr>
	<?php }

	?>
	</table>

	<?php echo $pageNav->getListFooter(); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="act" value="keywords" />
	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include( $mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }



    function editKeyword( $option, $row ) {
        global $database, $mosConfig_absolute_path;

	?>

    <table class="adminheading">
       <tr>
          <th>Ключевые слова</th>
       </tr>
    </table>
	<br />

	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">


	<tr>
	<td>Ключевое слово: </td>
	<td><input type="text" size="100" maxsize="100" name="keyword" value="<?php echo $row->keyword; ?>" /></td>
	<td>Введите здесь ключевое слово</td>
	</tr>


	<tr>
	<td>Действие: </td>
	<td>
	<?php

    $actions = array();
    $actions[] = mosHTML::makeOption( 1, "information" );
    $actions[] = mosHTML::makeOption( 2, "warning" );
    $actions[] = mosHTML::makeOption( 3, "block" );

	if( $row->action > 0) {
	    $select_id=$row->action;
	}
	else {
	    $select_id=0;
	}

	$html = mosHTML::selectList( $actions, 'action', 'size="1" class="inputbox"', 'value', 'text', $select_id);
	echo $html;
	?>
	</td>
	<td>Действие при обнаружении ключевого слова</td>
	</tr>


	<tr>
	<td>Информация: </td>
	<td><input type="text" size="100" maxsize="100" name="infotext" value="<?php echo $row->infotext; ?>"></td>
	<td>Этот текст будет показан пользователю</td>
	</tr>


	<tr>
	   <td>Публикация: </td>
	   <td><?php echo mosHTML::yesnoSelectList( "published", "", $row->published ); ?></td>
	   <td>Публиковать/Снять с публикации это ключевое слово </td>
	</tr>



	</table>

	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="keywords" />

	</form>

	<br style="clear:both" />
	<br />

	<?php
	echo "<center>";
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	include($mosConfig_absolute_path.'/components/com_marketplace/footer.php');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</center>";
    }







}
?>
