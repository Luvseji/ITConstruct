<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
require 'inc/init.inc.php';
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/<!--#TITLE#-->/i', 'Главная', $buffer);
echo $buffer;
?>
<div class="category">
    <ul class="category__inner">
        <? foreach ($categories as $item): ?>
        <li class="category__item-wrap">
            <div class="category__item">
                <a href="catalog.php?cat_id=<?= $item['id']?>" class="category__link">
                    <img src="<?= $item['image']?>" alt="" class="category__image">
                    <span class="category__title"><?= $item['name']?></span>
                </a>
            </div>
        </li>
        <? endforeach; ?>
        <li class="category__item-wrap"></li>
    </ul>
</div>
<?
require 'inc/temp_foot.inc.php';
