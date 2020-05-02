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
                        <a href="catalog.php?cat_id=<?= $item['id']?>" class="category-list__link<?= ($cat_id == $item['id'] ? ' category-list__link_active' : '');?>"><?= $item['name']?></a>
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
                        <a href="news.php?news_id=<?= $item['id']?>" class="news__link">
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
                    <a href="catalog.php" class="footer__link">Каталог</a>
                </li>
                <li class="navigation-footer__item">
                    <a href="about.php" class="footer__link">О компании</a>
                </li>
                <li class="navigation-footer__item">
                    <a href="news.php" class="footer__link">Новости</a>
                </li>
                <li class="navigation-footer__item">
                    <a href="paydelivery.php" class="footer__link">Доставка и оплата</a>
                </li>
                <li class="navigation-footer__item">
                    <a href="contacts.php" class="footer__link">Контакты</a>
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
