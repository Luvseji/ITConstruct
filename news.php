<?php
require 'inc/config.inc.php';
require 'inc/functions.inc.php';
$title = 'Новости';
$per_page = 8;
$count_news = get_count_news();
$count_pages = ceil($count_news / $per_page);
if (!$count_pages) $count_pages = 1;
if (isset($_GET['page'])) {
    $page = clear_int($_GET['page']);
    if ($page < 1) $page = 1;
}
else
    $page = 1;
if ($page > $count_pages) $page = $count_pages;
$start_pos = ($page - 1) * $per_page;
$news = select_news($start_pos, $per_page);
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
        <?php
            foreach ($news as $item) {
            ?>
        <li class="news__item">
            <a href="article.php?news_id=<?= $item['id']?>" class="news__link">
                <span class="news__title"><?= $item['title']?></span>
            </a>
            <span class="news__announ"><?= $item['announcement']?></span>
            <time class="news__date" datetime="<?= $item['date']?>"><?= $item['date']?></time>
        </li>
        <?php
            }
            ?>
    </ul>
</div>
</main>
<ul class="pages">
<?php
        for ($i = 1; $i <= $count_pages; $i++) {
        ?>
<li class="pages__item <?= ($page == $i ? 'pages__item_current' : '');?>">
    <a href="<?= clear_pagination_uri($i, $count_pages) . "page=$i";?>"><?= $i?></a>
</li>
<?php
        }
        ?>
<li class="pages__item">
    <?= ($page != $count_pages ? "<a href=" . clear_pagination_uri($page++, $count_pages) . "page=$page>Следующая страница</a>" : "<span class=\"pages__next\">Следующая страница</span>");?>
</li>
</ul>
<?php
require 'inc/temp_foot.inc.php';
