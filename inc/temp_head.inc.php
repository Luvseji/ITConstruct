<?php
$categories_name = select_categories_name();
$news_name = select_news_name();
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
                                    <a href="catalog.php?cat_id=<?= $item['id']?>" class="catalog__link"><?= $item['name']?></a>
                                </li>
                                <?php
                                    }
                                    ?>
                            </ul>
                        </li>
                        <li class="navigation__item navigation__item-pc">
                            <a href="catalog.php" class="navigation__link navigation__link-catalog">Каталог</a>
                        </li>
                        <li class="navigation__item">
                            <a href="about.php" class="navigation__link">О компании</a>
                        </li>
                        <li class="navigation__item">
                            <a href="news.php" class="navigation__link">Новости</a>
                        </li>
                        <li class="navigation__item">
                            <a href="paydelivery.php" class="navigation__link navigation__link-delivery">Доставка и оплата</a>
                        </li>
                        <li class="navigation__item">
                            <a href="contacts.php" class="navigation__link navigation__link-contacts">Контакты</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="content__inner">

