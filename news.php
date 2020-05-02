<?php
require 'inc/functions.inc.php';
require 'inc/config.inc.php';
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
require 'inc/temp_head.inc.php';

if (isset($_GET['news_id'])) {
    if ($news_id >= 1 and $news_id <= $count_news) {
?>
<main class="content__main">
    <div class="path content__path">
        <ul class="path__inner">
            <li class="path__past">
                <a href="index.php">Главная</a>
            </li>
            <li class="path__past">
                <a href="news.php">Новости</a>
            </li>
            <li class="path__present">
                <?= $article['title']?>
            </li>
        </ul>
    </div>
    <section class="article">
        <time class="article__date" datetime="<?= $article['date']?>"><?= $article['date']?></time>
        <h2 class="article__title"><?= $article['title']?></h2>
        <p class="article__announ"><?= $article['announcement']?></p>
        <div class="article__description"><?= $article['description']?></div>
    </section>
</main>
<?php
    } else
        echo "Извините, такой статьи не существует";
} else {
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
?>
<main class="content__main">
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
                <a href="news.php?news_id=<?= $item['id']?>" class="news__link">
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
}
require 'inc/temp_foot.inc.php';
