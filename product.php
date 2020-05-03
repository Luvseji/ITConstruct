<?php
require 'inc/config.inc.php';
require 'inc/functions.inc.php';
$categories_name = select_categories_name();
if (isset($_GET['prod_id'])) {
    $count_products = get_count_products($cat_id, $price_from, $price_to);
    $product_id = clear_int($_GET['prod_id']);
    if ($product_id >= 1 and $product_id <= $count_products) {
        $product = get_product($product_id);
        $title = $product['name'];
    } else
        $title = 'Извините, такого товара не существует';
}
require 'inc/temp_head.inc.php';
if (isset($_GET['prod_id'])) {
    if ($product_id >= 1 and $product_id <= $count_products) {
?>
        <div class="path content__path">
            <ul class="path__inner">
                <li class="path__past">
                    <a href="index.php">Главная</a>
                </li>
                <li class="path__past">
                    <a href="catalog.php">Каталог</a>
                </li>
                <?php
                if (isset($_GET['cat_id'])) {
                ?>
                <li class="path__past">
                    <a href="catalog.php?cat_id=<? $cat_id = $_GET['cat_id']; echo $cat_id--;?>"><?= $categories_name[$cat_id]['name']; $cat_id++;?></a>
                </li>
                <?php
                }
                ?>
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
    </main>
<?php
    } else
        echo "Извините, такого товара не существует";
}
require 'inc/temp_foot.inc.php';
