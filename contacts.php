<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
require 'inc/init.inc.php';
session_start();
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/<!--#TITLE#-->/i', 'Контакты', $buffer);
echo $buffer;
?>
<section class="contacts content__contacts">
    <h2>Контакты</h2>
    <div class="contacts__inner">
        <div class="contacts__col">
            <h3>Адрес нашего офиса:</h3>
            <p>630065, г. Новосибирск, Декабристов, 92, корп.7<br>
                Время приема заказов по телефону -</p>
            <p>с 9.30 до 18.00<br>
                Телефоны: <a href="tel:+73832551515" class="contacts__link">+7 (383) 255‒15‒15</a> ; <a href="tel:3491849" class="contacts__link">349‒18‒49</a></p>
            <h3>Магазины партнеры:</h3>
            <p><b>Москва:</b><br>
                Красный проспект, 50, стр. 1. универмаг "Московский":<br>
                1-й этаж, левое крыло пав. 71, тел.: <a href="tel:+73832393950" class="contacts__link">+7 (383) 239‒39‒50</a>;</p>
            <p><b>Санкт-Петербург:</b><br>
                <a href="https://www.president-spa.club" target="_blank" class="contacts__link">www.president-spa.club</a>, <a href="tel:+79133218354" class="contacts__link">(913) 321-83-54</a></p>
        </div>
        <div class="contacts__col">
            <h3>ООО «Компания»</h3>
            <p>Ген. директор:Иванов А.Ю.</p>
            <p>Юридический адрес: 630065, г. Новосибирск, Декабристов, 92, корп.7</p>
            <p>ИНН 7733700983; КПП 7737655901;</p>
            <p>ОГРН 1097746493754 от 15 июня 2014г.</p>
            <p>Наименование банка: ОАО «УРАЛСИБ»</p>
            <p>г. Москва БИК 042591537;<br>
                Корр. счет 31542814300000000327; Расчетный счет 40418710900020003009</p>
        </div>
    </div>
</section>
<div class="feedback">
    <h2 class="feedback__title">Форма обратной связи</h2>
    <span class="red-star">*</span> — обязательные для заполнения поля
    <?
    if (isset($_SESSION['sent'])) { ?>
        <div class="feedback__server-succsess">Ваше сообщение уже было отправлено</div> <?
    } else {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['details'])) {
            $name = clear_str($_POST['name']);
            $email = clear_str($_POST['email']);
            $details = clear_str($_POST['details']);
            $phone = clear_str($_POST['phone']);
            if (empty($name)) {
                $error .= 'Поле «Имя» должно быть заполнено<br>';
            }
            if (empty($email)) {
                $error .= 'Поле «Электронная почта» должно быть заполнено<br>';
            }
            if (empty($details)) {
                $error .= 'Поле с описанием должно быть заполнено<br>';
            }
            if ($error) { ?>
                <div class="feedback__server-errors"> <?
                    echo $error; ?>
                </div> <?
            } else {
                if (!save_form($name, $email, $phone, $details) || !send_email($name, $email, $phone, $details)) { ?>
                    <div class="feedback__server-errors">В отправке вашего сообщения произошла ошибка</div> <?
                } else { ?>
                    <div class="feedback__server-succsess">Благодарим за ваше письмо. Мы свяжемся с вами в ближайшее время</div> <?
                    $_SESSION['sent'] = 'true';
                }
            }
        } ?>
    <form action="contacts.php" method="post" class="feedback__form" id="feedback__form">
        <div class="feedback__name">
            <label for="name-field" class="feedback__label feedback__label_required">Имя</label>
            <input type="text" class="feedback__field field-empty-check" id="name-field" name="name">
        </div>
        <div class="feedback__email">
            <label for="email-field" class="feedback__label feedback__label_required">Электронная почта</label>
            <input type="text" class="feedback__field field-empty-check" id="email-field" name="email">
        </div>
        <div class="feedback__phone">
            <label for="phone-field" class="feedback__label">Телефон</label>
            <input type="text" class="feedback__field" id="phone-field" name="phone">
        </div>
        <div class="feedback__details">
            <label for="details-field" class="feedback__label feedback__label_required">Пожалуйста укажите какого рода информация вас интересует</label>
            <textarea name="details" id="details-field" class="feedback__textarea field-empty-check"></textarea>
        </div>
        <div class="feedback__actions">
            <button class="feedback__submit" type="submit">Отправить</button>
            <button class="feedback__reset" type="reset">Очистить поля</button>
        </div>
    </form>
    <? } ?>
</div>
<?
require 'inc/temp_foot.inc.php';
