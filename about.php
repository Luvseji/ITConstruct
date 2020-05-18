<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . 'О компании' . '$3', $buffer);
echo $buffer;
?>
<h2>О компании</h2>
<p><strong>Компания "Нанотехнологии здоровья" - IT-лидер</strong> в области автоматизации ритейла и сферы услуг. По данным авторитетного аналитического агентства «Cnews Analytics», в 2017 г. компания заняла 1 место рейтинга «Крупнейшие поставщики ИТ в рознице»</p>
<p><strong>Компания "Нанотехнологии здоровья"</strong> была основана Алексеем и Ириной Макаровыми в 2001 г. "Нанотехнологии здоровья" специализируется на разработке и поставке оборудования и программного обеспечения для автоматизации front-офиса сетевого и независимого ритейла (food и non-food), кафе, ресторанов, гостиниц, сферы услуг. </p>
<p>В числе решений "Нанотехнологии здоровья":</p>
<ul>
    <li>Контрольно-кассовая техника онлайн;</li>
    <li>Смарт-терминалы и ньюджеры;</li>
    <li>Транспортные модули для Единой государственной автоматизированной системы для контроля за производством и оборотом алкоголя (ЕГАИС);</li>
    <li>POS-системы, 2D-сканеры, весовое оборудование, принтеры чеков и фискальные регистраторы;</li>
    <li>Широкий спектр программного обеспечения.</li>
</ul>
<p>Эксперты компании обладают одной из самых глубоких экспертиз в области законодательства о торговле (в т.ч. изменения в 54-ФЗ (внедрения онлайн-касс) и ЕГАИС) и регулярно выступают в СМИ и на ведущих конференц-площадках. "Нанотехнологии здоровья" регулярно организует тематические вебинары, в которых может принять участие каждый желающий.</p>
<p>Среди клиентов компании – крупнейшие представители сетевого ритейла, региональные лидеры food- и non-food розницы, ведущие сети общественного питания, большая тройка телекоммуникационных операторов, лидеры аптечного рынка и многие другие.</p>
<?
require 'inc/temp_foot.inc.php';
