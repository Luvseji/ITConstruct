<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'it_construct');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME) or die('Нет соединения с БД');
mysqli_set_charset($link, 'utf8') or die('Не установлена кодировка соединения');
if ($_SERVER['SCRIPT_NAME'] == '/contacts.php') {
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'user.test.itconstruct';
    $mail->Password   = '1231231123';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('user.test.itconstruct@gmail.com', 'Автоматическая рассылка');
    $mail->addAddress('user.test.itconstruct@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Письмо с сайта "itconstruct"';
}
