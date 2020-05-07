<?php
require 'inc/connection.inc.php';
require 'inc/functions.inc.php';
$title = 'Главная';
require 'inc/temp_head.inc.php';
$categories = select_categories();
?>
                    <div class="category">
                        <ul class="category__inner">
                           <?php foreach ($categories as $item): ?>
                            <li class="category__item-wrap">
                                <div class="category__item">
                                    <a href="catalog.php?cat_id=<?= $item['id']?>" class="category__link">
                                        <img src="<?= $item['image']?>" alt="" class="category__image">
                                        <span class="category__title"><?= $item['name']?></span>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                            <li class="category__item-wrap"></li>
                        </ul>
                    </div>
<?php
require 'inc/temp_foot.inc.php';
