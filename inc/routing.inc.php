<?php
switch($id){
    case '1': include 'inc/catalog.inc.php'; break;
    case '2': include 'inc/about.inc.php'; break;
    case '3': include 'inc/news.inc.php'; break;
    case '4': include 'inc/paydelivery.inc.php'; break;
    case '5': include 'inc/contacts.inc.php'; break;
    default: include 'inc/index.inc.php';
}
