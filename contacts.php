<?php
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
session_start();
$title = 'Контакты';
require 'inc/temp_head.inc.php';
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
                        <?php
                        if (isset($_POST['name'])):
                            if (!isset($_SESSION['sent'])) {
                                $name = clear_str($_POST['name']);
                                $email = clear_str($_POST['email']);
                                $phone = 0;
                                $details = clear_str($_POST['details']);
                                $error = 0;
                                if (check_empty($name) == false) {
                                    echo "<div class=\"feedback__server-errors\">\nПоле «Имя» должно быть заполнено<br>\n";
                                    $error++;
                                }
                                if (check_empty($email) == false) {
                                    if ($error == 0) {
                                        echo "<div class=\"feedback__server-errors\">\nПоле «Электронная почта» должно быть заполнено<br>\n";
                                        $error++;
                                    } else {
                                        echo "Поле «Электронная почта» должно быть заполнено<br>\n";
                                    }
                                }
                                if (check_empty($details) == false) {
                                    if ($error == 0) {
                                        echo "<div class=\"feedback__server-errors\">\nПоле с описанием должно быть заполнено<br>\n";
                                        $error++;
                                    } elseif ($error > 0) {
                                        echo "Поле с описанием должно быть заполнено<br>\n";
                                    }
                                }
                                if ($error != 0)
                                    echo "</div>\n";
                                if ($error == 0) {
                                    if (check_empty($_POST['phone']) == true)
                                        $phone = clear_int($_POST['phone']);
                                    $_SESSION['sent'] = 'true';
                                    send_email($name, $email, $phone, $details);
                                    if (!save_form($name, $email, $phone, $details))
                                        echo "<div class=\"feedback__server-errors\">\nВ отправке вашего сообщения произошла ошибка\n</div>\n";
                                    else
                                        echo "<div class=\"feedback__server-succsess\">\nБлагодарим за ваше письмо. Мы свяжемся с вами в ближайшее время\n</div>\n";
                                }
                            } else
                                echo "<div class=\"feedback__server-errors\">\nВаше сообщение уже было отправлено\n</div>\n";
                        endif; ?>
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
                    </div>
<?php
require 'inc/temp_foot.inc.php';
