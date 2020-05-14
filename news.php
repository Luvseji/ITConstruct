<?
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
$title = 'Новости';
$count_news = get_count_news();
$count_pages = ceil($count_news / PER_PAGE);
if (!$count_pages) {
    $count_pages = 1;
}
if (isset($_GET['page'])) {
    $page = (int) $_GET['page'];
    if ($page < 1) {
        $page = 1;
    }
}
else {
    $page = 1;
}
if ($page > $count_pages) {
    $page = $count_pages;
}
$start_pos = ($page - 1) * PER_PAGE;
$news = select_news($start_pos, PER_PAGE);
require 'inc/temp_head.inc.php';
?>
<div class="path content__path">
    <ul class="path__inner">
        <li class="path__past">
            <a href="index.php">Главная</a>
        </li>
        <li class="path__present">
            Новости
        </li>
    </ul>
</div>
<div class="news">
    <ul class="news__inner">
        <? foreach ($news as $item): ?>
        <li class="news__item">
            <a href="article.php?news_id=<?= $item['id']?>" class="news__link">
                <span class="news__title"><?= $item['title']?></span>
            </a>
            <span class="news__announ"><?= $item['announcement']?></span>
            <time class="news__date" datetime="<?= $item['date']?>"><?= $item['date']?></time>
        </li>
        <? endforeach; ?>
    </ul>
</div>
<?
$page_prev = $page - 1;
$page_next = $page + 1;
?>
<div class="pages">
    <ul class="pages__inner">
        <li class="pages__item">
            <?= ($page != 1 ? "<a href=\"" . clear_pagination_uri($page, $count_pages) . "page=" . $page_prev . "\">Предыдущая страница</a>" : "<span class=\"pages__next\">Предыдущая страница</span>");?>
        </li>
        <? for ($i = 1; $i <= $count_pages; $i++): ?>
        <li class="pages__item <?= ($page == $i ? 'pages__item_current' : '');?>">
            <a href="<?= clear_pagination_uri($i, $count_pages) . "page=$i";?>"><?= $i?></a>
        </li>
        <? endfor; ?>
        <li class="pages__item">
            <?= ($page != $count_pages ? "<a href=\"" . clear_pagination_uri($page, $count_pages) . "page=" . $page_next . "\">Следующая страница</a>" : "<span class=\"pages__next\">Следующая страница</span>");?>
        </li>
    </ul>
</div>
<?
require 'inc/temp_foot.inc.php';
