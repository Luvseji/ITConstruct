<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
require 'inc/init.inc.php';
$sql = "SELECT COUNT(*) FROM news";
$query_page = (int) $_GET['page'];
$page_info = get_page_info($sql, $query_page);
$news = select_news($page_info['start_pos'], PER_PAGE);
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/<!--#TITLE#-->/i', 'Новости', $buffer);
echo $buffer;
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
require 'inc/temp_foot.inc.php';
