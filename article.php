<?
require_once 'inc/config.inc.php';
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
if (isset($_GET['news_id'])) {
    $news_id = (int) $_GET['news_id'];
    $sql = "SELECT COUNT(*) FROM news WHERE id=$news_id";
    if (!$result = mysqli_query($link, $sql)) {
        header('Location: err404.php');
    }
    $is_article = mysqli_fetch_row($result);
    mysqli_free_result($result);
    if ($is_article[0] != 0) {
        $article = get_article($news_id);
        $title = $article['title'];
    } else {
       $title = 'Извините, такой статьи не существует';
    }
}
ob_start();
require 'inc/temp_head.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
if ($is_article[0] != 0) : ?>
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
<?
else :
    echo "Извините, такой статьи не существует\n";
endif;
require 'inc/temp_foot.inc.php';
