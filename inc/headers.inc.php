<?
$categories_name = select_categories_name();
$news_name = select_news_name();
$title = 'Главная';
$id = strtolower(strip_tags(trim($_GET['id'])));
// initialize titles of pages
switch($id){
    case '1':
        $title = 'Каталог';
        if (isset($_GET['prod_id'])) {
            $count_products = get_count_products($cat_id, $price_from, $price_to);
            $product_id = clear_int($_GET['prod_id']);
            if ($product_id >= 1 and $product_id <= $count_products) {
                $product = get_product($product_id);
                $title = $product['name'];
            } else
                $title = 'Извините, такого товара не существует';
        } else {
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
        break;
    case '2':
        $title = 'О компании';
        break;
    case '3':
        $title = 'Новости';
        if (isset($_GET['news_id'])) {
            $count_news = get_count_news();
            $news_id = clear_int($_GET['news_id']);
            if ($news_id >= 1 and $news_id <= $count_news) {
                $article = get_article($news_id);
                $title = $article['title'];
            } else
               $title = 'Извините, такой статьи не существует';
        }
        break;
    case '4':
        $title = 'Доставка и оплата';
        break;
    case '5':
        session_start();
        $title = 'Контакты';
        break;
}
