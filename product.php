<?
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
$categories_name = select_categories_name();
if (isset($_GET['prod_id'])) {
    $product_id = (int) $_GET['prod_id'];
    $sql = "SELECT COUNT(*) FROM product WHERE id=$product_id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $is_product = mysqli_fetch_row($result);
    mysqli_free_result($result);
    if ($is_product[0] != 0) {
        $product = get_product($product_id);
        $title = $product['name'];
    } else {
        $title = 'Извините, такого товара не существует';
    }
}
if (isset($_GET['cat_id'])) {
    $cat_id = (int) $_GET['cat_id'];
} else {
    $sql = "SELECT category_main_id FROM product WHERE id=$product_id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $main_category = mysqli_fetch_all($result);
    mysqli_free_result($result);
    $main_category = $main_category[0][0];
}
require 'inc/temp_head.inc.php';
if (isset($_GET['prod_id'])) {
    if ($is_product[0] != 0) { ?>
<div class="path content__path">
    <ul class="path__inner">
        <li class="path__past">
            <a href="index.php">Главная</a>
        </li>
        <li class="path__past">
            <a href="catalog.php">Каталог</a>
        </li>
        <? if ($cat_id): ?>
        <li class="path__past">
            <a href="catalog.php?cat_id=<?= $cat_id--;?>"><?= $categories_name[$cat_id]['name']; $cat_id++;?></a>
        </li>
        <? else : ?>
        <li class="path__past">
            <a href="catalog.php?cat_id=<?= $main_category-- ?>"><?= $categories_name[$main_category]['name'] ?></a>
        </li>
        <? endif; ?>
        <li class="path__present">
            <?= $product['name']?>
        </li>
    </ul>
</div>
<div class="product">
    <div class="product__item">
        <img src="<?= $product['image']?>" alt="" class="product__image">
        <div class="product-info">
            <h2 class="product__title"><?= $product['name']?></h2>
            <span class="product__price"><span class="text-bold"><?= number_format($product['price'])?></span> руб.</span>
        </div>
    </div>
    <div class="product__description"><?= ($product['description'] != '' ? $product['description'] : 'Описание отсутствует.');?></div>
</div>
<?
    } else {
        echo "Извините, такого товара не существует\n";
    }
}
require 'inc/temp_foot.inc.php';
