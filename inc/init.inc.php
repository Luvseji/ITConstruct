<?
if ($_SERVER['SCRIPT_NAME'] == '/index.php') {
    $categories = select_categories();
} else {
    $categories = select_categories_name();
}
$news_name = select_news_name();
