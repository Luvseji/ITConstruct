<?php
require 'inc/config.inc.php';
require 'inc/functions.inc.php';
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
<?php
    } else
        echo "Извините, такой статьи не существует";
}
require 'inc/temp_foot.inc.php';
