<?php
// including files
require 'inc/functions.inc.php';
require 'inc/config.inc.php';
require 'inc/headers.inc.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="http://allfont.ru/allfont.css?fonts=arial-narrow" rel="stylesheet" type="text/css" />
    <link href="css/basic.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
    <title><?=$title;?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__pics">
                <?=(($_SERVER['REQUEST_URI'] == '/' or $_SERVER['REQUEST_URI'] == '/index.php') ? '<div class=\'logo\'></div>' : '<a href="index.php" class=\'logo\'></a>');?>
                <div class="header__preview">
                    <div class="header__title">
                        Нанотехнологии здоровья
                    </div>
                    <div class="h-contacts header__h-contacts">
                        <a href="mailto:info@company.ru" class="h-contacts__email">info@company.ru</a>
                        <a href="tel:+73833491849" class="h-contacts__phone">+7 (383) 349-18-49</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__navigation-wrap">
            <div class="container">
                <div class="navigation header__navigation">
                    <div class="burger" id="navToggle">
                        <div class="burger__item"></div>
                        <span class="burger__title"><a href="#" class="burger__link navigation__link">Меню</a></span>
                    </div>
                    <ul class="navigation__inner" id="nav-in">
                        <li class="navigation__item">
                            <a href="index.php" class="navigation__link navigation__link-main">Главная</a>
                        </li>
                        <li class="navigation__item navigation__item-mob sub-navigation">
                            <a href="#" class="navigation__link sub-navigation__link navigation__link-catalog">Каталог</a>
                            <ul class="catalog sub-navigation__inner">
                               <?php
                                foreach ($categories_name as $item) {
                                ?>
                                <li class="catalog__item">
                                    <a href="?id=1&cat_id=<?= $item['id']?>" class="catalog__link"><?= $item['name']?></a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li class="navigation__item navigation__item-pc">
                            <a href="?id=1" class="navigation__link navigation__link-catalog">Каталог</a>
                        </li>
                        <li class="navigation__item">
                            <a href="?id=2" class="navigation__link">О компании</a>
                        </li>
                        <li class="navigation__item">
                            <a href="?id=3" class="navigation__link">Новости</a>
                        </li>
                        <li class="navigation__item">
                            <a href="?id=4" class="navigation__link navigation__link-delivery">Доставка и оплата</a>
                        </li>
                        <li class="navigation__item">
                            <a href="?id=5" class="navigation__link navigation__link-contacts">Контакты</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="content__inner">
            <?php
            include 'inc/routing.inc.php';
            ?>
            </div>
            <?php if (!$side_bar): ?>
            <div class="side-bar">
                <section class="category-list content__category-list">
                    <h2 class="category-list__headline">Каталог</h2>
                    <ul>
                       <?php
                        foreach ($categories_name as $item) {
                        ?>
                        <li class="category-list__item">
                            <a href="?id=1&cat_id=<?= $item['id']?>" class="category-list__link<?= ($_GET['cat_id'] == $item['id'] ? ' category-list__link_active' : '');?>"><?= $item['name']?></a>
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
                            <a href="?id=3&news_id=<?= $item['id']?>" class="news__link">
                                <span class="news__title"><?= $item['title']?></span>
                            </a>
                            <time class="news__date" datetime="<?= $item['date']?>"><?= $item['date']?></time>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <span class="news__archive"><a href="?id=3" class="news__link">Архив новостей</a></span>
                </section>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__company">
                    <div class="copyright footer__copyright">
                        <span class="copyright__item">Copyright ©2007-<?=date('Y');?></span>
                        <br>
                        <span class="copyright__item">© “<span class="text-bold">Company</span>”, <?=date('Y');?></span>
                    </div>
                    <div class="footer__logo">
                        <span class="logo__name footer__logo-name">Company</span>
                    </div>
                </div>
                <ul class="navigation-footer  footer__navigation-footer">
                    <li class="navigation-footer__item">
                        <a href="index.php" class="footer__link">Главная</a>
                    </li>

                    <li class="navigation-footer__item">
                        <a href="?id=1" class="footer__link">Каталог</a>
                    </li>
                    <li class="navigation-footer__item">
                        <a href="?id=2" class="footer__link">О компании</a>
                    </li>
                    <li class="navigation-footer__item">
                        <a href="?id=3" class="footer__link">Новости</a>
                    </li>
                    <li class="navigation-footer__item">
                        <a href="?id=4" class="footer__link">Доставка и оплата</a>
                    </li>
                    <li class="navigation-footer__item">
                        <a href="?id=5" class="footer__link">Контакты</a>
                    </li>
                </ul>
                <div class="footer__info">
                    <span class="footer__by">Разработка сайта — <a href="https://itconstruct.ru/" target="_blank" class="footer__link">ITConstruct</a></span>
                    <div href="#" class="footer__link"><img src="img/footer__stat.gif" alt="" class="footer__statistic"></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- JavaScript -->
    <script src="js/app.js"></script>
</body>
</html>
