<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
require 'inc/init.inc.php';
$title = 'Каталог';
if (isset($_GET['cat_id'])) {
    $cat_id = ((int) $_GET['cat_id'] >= 1) ? ((int)$_GET['cat_id']) : 0;
    if (!$cat_id) {
        header('Location: err404.php');
    }
    foreach ($categories as $key => $item) {
        if ($item['id'] == $cat_id) {
            $cat_id_key = $key;
        }
    }
    if (!isset($cat_id_key)) {
        header('Location: err404.php');
    } else {
        $title = $categories[$cat_id_key]['name'];
    }
}
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/<!--#TITLE#-->/i', $title, $buffer);
echo $buffer;
$price_from = ((int) $_GET['from'] >= 0) ? ((int)$_GET['from']) : 0;
$price_to = ((int) $_GET['to'] >= 0) ? ((int)$_GET['to']) : 0;
$query_page = ((int) $_GET['page'] >= 1) ? ((int)$_GET['page']) : 1;
$sql_count = "SELECT COUNT(*) FROM ";
$sql_product = "SELECT id, name, image, price FROM product ";
if (!$cat_id && !$price_from && !$price_to) {// default
    $sql_count .= "product";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif ($cat_id && !$price_from && !$price_to) {// categories without sort
    $sql_count .= "product_category_is WHERE category_id=($cat_id)";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif (!$cat_id && !$price_from && $price_to) {// default with sort where price_from empty
    $sql_count .= "product WHERE price BETWEEN $price_from AND $price_to";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "WHERE price <= $price_to ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif (!$cat_id && $price_from && $price_to) {// default with sort
    $sql_count .= "product WHERE price BETWEEN $price_from AND $price_to";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "WHERE price BETWEEN $price_from AND $price_to ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif ($cat_id && !$price_from && $price_to) {// categories with sort where price_from empty
    $sql_count .= "product p JOIN product_category_is i ON p.id = i.product_id WHERE i.category_id=($cat_id) AND p.price BETWEEN $price_from AND $price_to";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) AND price <= $price_to ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif ($cat_id && $price_from && $price_to) {// categories with sort
    $sql_count .= "product p JOIN product_category_is i ON p.id = i.product_id WHERE i.category_id=($cat_id) AND p.price BETWEEN $price_from AND $price_to";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) AND price BETWEEN $price_from AND $price_to ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif (!$cat_id && $price_from && !$price_to) { // default with sort where price_to empty
    $sql_count .= "product WHERE price >= $price_from";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "WHERE price >= $price_from ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
elseif ($cat_id && $price_from && !$price_to) {// categories with sort where price_to empty
    $sql_count .= "product p JOIN product_category_is i ON p.id = i.product_id WHERE i.category_id=($cat_id) AND p.price >= $price_from";
    $page_info = get_page_info($sql_count, $query_page);
    $sql_product .= "p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) AND price >= $price_from ORDER BY price LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
}
if (!$result = mysqli_query($link, $sql_product)) {
    $products = [];
} else {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}
if (count($products)) : ?>
<div class="path content__path">
    <ul class="path__inner">
        <li class="path__past">
            <a href="index.php">Главная</a>
        </li>
        <? if (isset($cat_id_key)): ?>
        <li class="path__past">
            <a href="catalog.php">Каталог</a>
        </li>
        <li class="path__present">
            <?= $categories[$cat_id_key]['name'] ?>
        </li>
        <? else: ?>
        <li class="path__present">
            Каталог
        </li>
        <? endif; ?>
    </ul>
</div>
<div class="goods">
    <div class="price-sort goods__price-sort">
        <form action="catalog.php" method="get">
            <span>Цена</span>
            <?= ($cat_id ? "<input type=\"hidden\" name=\"cat_id\" value=\"" . $cat_id . "\">" : ''); ?>
            <input type="text" name="from" class="price-sort__field" placeholder="от"<?= (isset($_GET['from']) && $_GET['from'] != 0 ? " value=\"$price_from\"" : ''); ?>>
            <span>—</span>
            <input type="text" name="to" class="price-sort__field" placeholder="до"<?= (isset($_GET['to']) && $_GET['to'] != 0 ? " value=\"$price_to\"" : ''); ?>>
            <div class="price-sort__apply-wrap">
                <button class="price-sort__apply" type="submit"><span>Применить</span></button>
            </div>
        </form>
    </div>
    <ul class="goods__list">
        <? foreach ($products as $item): ?>
        <li class="goods__item-wrap">
            <div class="goods__item">
                <a href="<?= 'product.php?' . 'prod_id=' . $item['id']; if (isset($_GET['cat_id'])) {echo '&cat_id=' . $cat_id;} ?>" class="goods__link">
                    <img src="<?= $item['image']?>" alt="" class="goods__image">
                    <span class="goods__title"><?= $item['name']?></span>
                </a>
                <span class="goods__price"><span class="text-bold"><?= number_format($item['price'])?></span> руб.</span>
            </div>
        </li>
        <? endforeach; ?>
        <li class="goods__item-wrap"></li>
    </ul>
</div>
    <? if ($page_info['count_pages'] > 1) : ?>
<div class="pages">
    <ul class="pages__inner">
        <li class="pages__item">
            <?= ($page_info['page'] != 1 ? "<a href=\"" . clear_pagination_uri($page, $page_info['count_pages']) . "page=" . ($page_info['page'] - 1) . "\">Предыдущая страница</a>" : "<span class=\"pages__next\">Предыдущая страница</span>");?>
        </li>
        <? for ($i = 1; $i <= $page_info['count_pages']; $i++) : ?>
        <li class="pages__item <?= ($page_info['page'] == $i ? 'pages__item_current' : '');?>">
            <a href="<?= clear_pagination_uri($i, $page_info['count_pages']) . "page=$i";?>"><?= $i?></a>
        </li>
        <? endfor; ?>
        <li class="pages__item">
            <?= ($page_info['page'] != $page_info['count_pages'] ? "<a href=\"" . clear_pagination_uri($page, $page_info['count_pages']) . "page=" . ($page_info['page'] + 1) . "\">Следующая страница</a>" : "<span class=\"pages__next\">Следующая страница</span>");?>
        </li>
    </ul>
</div>
<?
    endif;
else :
    echo "Ни одного товара не нашлось\n";
endif;
require 'inc/temp_foot.inc.php';
