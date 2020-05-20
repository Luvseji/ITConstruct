<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
require 'inc/init.inc.php';
$query_page = (int) $_GET['page'];
$sql = "SELECT COUNT(*) FROM news";
$page_info = get_page_info($sql, $query_page);
$sql = "SELECT id, title, date, announcement FROM news ORDER BY date DESC LIMIT " . $page_info['start_pos'] . ", " . PER_PAGE;
if (!$result = mysqli_query($link, $sql)) {
    $news = [];
} else {
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/<!--#TITLE#-->/i', 'Новости', $buffer);
echo $buffer;
if (count($news)) : ?>
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
    echo "Ни одной статьи не нашлось\n";
endif;
require 'inc/temp_foot.inc.php';
