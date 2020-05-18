<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
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
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
if (isset($_GET['cat_id'])) {
    $cat_id = (int) $_GET['cat_id'];
    if ($cat_id != $product['category_main_id']) {
        $buffer = preg_replace('/(<\/title>)(.*?)/i', '$1' . "\n\t<link rel=\"canonical\" href=\"" . $_SERVER['REQUEST_URI'] . "\"/>", $buffer);
    }
} else {
    $main_category = $product['category_main_id'];
}
echo $buffer;
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
        <li class="path__past">
        <? if ($cat_id): ?>
            <a href="catalog.php?cat_id=<?= $cat_id--; ?>"><?= $categories[$cat_id++]['name']; ?></a>
        <? else : ?>
            <a href="catalog.php?cat_id=<?= $main_category--; ?>"><?= $categories[$main_category]['name']; ?></a>
        <? endif; ?>
        </li>
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
