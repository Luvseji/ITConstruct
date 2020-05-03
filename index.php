<?php
require 'inc/config.inc.php';
require 'inc/functions.inc.php';
$title = 'Главная';
require 'inc/temp_head.inc.php';
$categories = select_categories();
$side_bar = true;
?>
    <div class="category">
        <ul class="category__inner">
           <?php
            foreach ($categories as $item) {
            ?>
            <li class="category__item-wrap">
                <div class="category__item">
                    <a href="catalog.php?cat_id=<?= $item['id']?>" class="category__link">
                        <img src="<?= $item['image']?>" alt="" class="category__image">
                        <span class="category__title"><?= $item['name']?></span>
                    </a>
                </div>
            </li>
            <?php
            }
            ?>
            <li class="category__item-wrap"></li>
        </ul>
    </div>
</main>
<div class="side-bar">
    <section class="category-list content__category-list">
        <h2 class="category-list__headline">Каталог</h2>
        <ul>
        <?php
        foreach ($categories_name as $item) {
        ?>
        <li class="category-list__item">
            <a href="catalog.php?cat_id=<?= $item['id']?>" class="category-list__link"><?= $item['name']?></a>
        </li>
        <?php
        }
        ?>
        </ul>
    </section>
    <section class="news content__news">
        <h2 class="news__headline">Новости</h2>
        <ul>
        <?php
        foreach ($news_name as $item) {
        ?>
        <li class="news__item">
            <a href="article.php?news_id=<?= $item['id']?>" class="news__link">
                <span class="news__title"><?= $item['title']?></span>
            </a>
            <time class="news__date" datetime="<?= $item['date']?>"><?= $item['date']?></time>
        </li>
        <?php
        }
        ?>
        </ul>
        <span class="news__archive"><a href="news.php" class="news__link">Архив новостей</a></span>
    </section>
</div>
<section class="content__description">
    <h3 class="content__title">Высокое качество японских ножей</h3>
    <div class="content__text">
        <p>Кухонные японские ножи (ножи masahiro, касуми, хаттори) известных торговых марок уже завоевали популярность благодаря своей прочности и уникальным качествам - остроте и долговечности заточки. Японские ножи (ножи касуми, масахиро, хаттори, кухонные ножи из дамасской стали) - это профессиональные поварские инструменты, секреты производства которых передаются и шлифуются мастерами из поколения в поколение. Эти японские ножи обладают особым значением - они своего рода статус шеф-повара, в Японии обладание таким ножом считалось показателем высокого мастерства в поварском деле.</p>
        <p>Сегодня японские ножи соединили в себе древнейшие традиции изготовления самурайских мечей и инновационные технологии и, именно поэтому японские ножи обладают уникальными свойствами. Сделаны японские ножи только из высококачественных материалов. Клинок японского ножа делают из высокоуглеродистой стали, что обеспечивает его высокую прочность и надежность. Следует отметить, что японские ножи эргономичны по своему дизайну, что обеспечивает удобство и комфорт в работе. Японские ножи суперострые и после заточки очень долго не тупятся, благодаря этому уникальному качеству они получили широкую известность. Японские ножи - это прекрасный выбор, который говорит о требовательности покупателя к высокому качеству ножа и о его превосходном вкусе. Кстати, нужно отметить, что японские ножи предназначены не только для японской, но и для европейской, а также любой другой кухни. В известных ресторанах крупнейших городов во всем мире используют именно японские ножи. Японские ножи -это профессиональные инструменты для японской кухни (купить японские ножи Вы можете у нас).</p>
        <p>Интернет магазин "Chef" предлагает купить японские ножи (ножи касуми, масахиро), нож для суши. У нас есть японские ножи из дамасской стали (ножи masahiro, касуми). Дамасская сталь - это не просто причудливый узор на лезвии ножа, это технология, сочетающая твердую сталь сердцевины клинка для сохранения остроты ножа и множество слоев мягкой стали, которая и создает рисунок при заточке, для придания гибкости и прочности острой, но хрупкой сердцевине. По этой технологии делались древние острейшие самурайские мечи катаны. Ножи из дамасской стали прочны, надежны и долговечны, что подтверждено многолетним опытом. Не зря ножи из дамасской стали бестселлерами продаж. Есть также товары, которые являются результатом современных научных технологий: титановые, керамические ножи из Японии.</p>
    </div>
</section>
<?php
require 'inc/temp_foot.inc.php';
