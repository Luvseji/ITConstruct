<?php
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
$title = 'Каталог';
$categories_name = select_categories_name();
if (isset($_GET['cat_id'])) {
    $cat_id = clear_int($_GET['cat_id']);
    $count_categories = get_count_categories();
    if ($cat_id and ($cat_id < 1 or $cat_id > $count_categories)) {
        $cat_id = 1;
    }
    if ($cat_id >= 1 and $cat_id <= $count_categories) {
        $cat_id--;
        $title = $categories_name[$cat_id]['name'];
        $cat_id++;
    }
}
require 'inc/temp_head.inc.php';
$per_page = 12;
$price_from = clear_int($_GET['from']);
$price_to = clear_int($_GET['to']);
if ($price_from < 0) $price_from = 0;
if ($price_to < 0) $price_to = 0;
$count_products = get_count_products($cat_id, $price_from, $price_to);
$count_pages = ceil($count_products / $per_page);
if (!$count_pages) $count_pages = 1;
if (isset($_GET['page'])) {
    $page = clear_int($_GET['page']);
    if ($page < 1) $page = 1;
}
else
    $page = 1;
if ($page > $count_pages) $page = $count_pages;
$start_pos = ($page - 1) * $per_page;
$products = select_products($cat_id, $start_pos, $per_page, $price_from, $price_to);
?>
                    <div class="path content__path">
                        <ul class="path__inner">
                            <li class="path__past">
                                <a href="index.php">Главная</a>
                            </li>
                            <?php if ($cat_id >= 1): ?>
                            <li class="path__past">
                                <a href="catalog.php">Каталог</a>
                            </li>
                            <li class="path__present">
                                <? $cat_id--; echo $categories_name[$cat_id]['name']; $cat_id++;?>
                            </li>
                            <?php else: ?>
                            <li class="path__present">
                                Каталог
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="goods">
                        <div class="price-sort goods__price-sort">
                            <form action="catalog.php" method="get">
                                <span>Цена</span>
                                <?= ($cat_id ? "<input type=\"hidden\" name=\"cat_id\" value=\"" . $cat_id . "\">" : ''); ?>
                                <input type="text" name="from" class="price-sort__field" placeholder="от">
                                <span>—</span>
                                <input type="text" name="to" class="price-sort__field" placeholder="до">
                                <div class="price-sort__apply-wrap">
                                    <button class="price-sort__apply" type="submit"><span>Применить</span></button>
                                </div>
                            </form>
                        </div>
                        <ul class="goods__list">
                           <?php foreach ($products as $item): ?>
                            <li class="goods__item-wrap">
                                <div class="goods__item">
                                    <a href="<?= 'product.php?' . $_SERVER['QUERY_STRING'] . '&prod_id=' . $item['id']?>" class="goods__link">
                                        <img src="<?= $item['image']?>" alt="" class="goods__image">
                                        <span class="goods__title"><?= $item['name']?></span>
                                    </a>
                                    <span class="goods__price"><span class="text-bold"><?= number_format($item['price'])?></span> руб.</span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <li class="goods__item-wrap"></li>
                        </ul>
                    </div>
<?php
require 'inc/temp_foot.inc.php';



