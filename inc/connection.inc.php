<?
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('Нет соединения с БД');
mysqli_set_charset($link, 'utf8') or die('Не установлена кодировка соединения');
