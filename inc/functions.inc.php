<?php
function clear_int($data) {
    $new = (int) $data;
    return $new;
}
function clear_str($data) {
    $new = strip_tags(trim($data));
    return $new;
}
function select_categories() {
    global $link;
    $sql = "SELECT id, name, image FROM category";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}
function select_categories_name() {
    global $link;
    $sql = "SELECT id, name FROM category";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}
function select_news_name() {
    global $link;
    $sql = "SELECT id, title, date FROM news ORDER BY date DESC LIMIT 6";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $news;
}
function get_count_products($cat_id, $price_from, $price_to) {
    global $link;
    if ($cat_id == 0 and $price_from == 0 and $price_to == 0)// default
        $sql = "SELECT COUNT(*) FROM product";
    elseif ($cat_id > 0 and $price_from == 0 and $price_to == 0)// categories without sort
        $sql = "SELECT COUNT(*) FROM product_category_is WHERE category_id=($cat_id)";
    elseif ($cat_id == 0 and $price_to > 0)// default with sort
        $sql = "SELECT COUNT(*) FROM product WHERE price >= $price_from AND price <= $price_to";
    elseif ($cat_id > 0 and $price_to > 0)// categories with sort
        $sql = "SELECT COUNT(*) FROM product_category_is WHERE category_id=($cat_id) AND price >= $price_from AND price <= $price_to";
    elseif ($cat_id == 0 and $price_from > 0 and $price_to == 0) { // default with sort where price_to empty
        $price_to = 99999;
        $sql = "SELECT COUNT(*) FROM product WHERE price >= $price_from AND price <= $price_to";
    }
    elseif (($cat_id > 0 and $price_from > 0 and $price_to == 0)) {// categories with sort where price_to empty
        $price_to = 99999;
        $sql = "SELECT COUNT(*) FROM product_category_is WHERE category_id=($cat_id) AND price >= $price_from AND price <= $price_to";
    }
    if (!$result = mysqli_query($link, $sql))
        return false;
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $count[0];
}
function select_products($cat_id, $start_pose, $per_page, $price_from, $price_to) {
    global $link;
    if ($cat_id == 0 and $price_from == 0 and $price_to == 0)// default
        $sql = "SELECT id, name, image, price FROM product ORDER BY price LIMIT $start_pose, $per_page";
    elseif ($cat_id > 0 and $price_from == 0 and $price_to == 0)// categories without sort
        $sql = "SELECT p.id, p.name, p.image, p.price FROM product p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) ORDER BY price LIMIT $start_pose, $per_page";
    elseif ($cat_id == 0 and $price_to > 0)// default with sort
        $sql = "SELECT id, name, image, price FROM product WHERE price >= $price_from AND price <= $price_to ORDER BY price LIMIT $start_pose, $per_page";
    elseif ($cat_id > 0 and $price_to > 0)// categories with sort
        $sql = "SELECT p.id, p.name, p.image, p.price FROM product p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) AND price >= $price_from AND price <= $price_to ORDER BY price LIMIT $start_pose, $per_page";
    elseif ($cat_id == 0 and $price_from > 0 and $price_to == 0) { // default with sort where price_to empty
        $price_to = 99999;
        $sql = "SELECT id, name, image, price FROM product WHERE price >= $price_from AND price <= $price_to ORDER BY price LIMIT $start_pose, $per_page";
    }
    elseif (($cat_id > 0 and $price_from > 0 and $price_to == 0)) {// categories with sort where price_to empty
        $price_to = 99999;
        $sql = "SELECT p.id, p.name, p.image, p.price FROM product p JOIN product_category_is i ON p.id = i.product_id WHERE category_id=($cat_id) AND price >= $price_from AND price <= $price_to ORDER BY price LIMIT $start_pose, $per_page";
    }
    if (!$result = mysqli_query($link, $sql))
        return false;
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $products;
}
function clear_pagination_uri($page, $count_pages) {
    $uri = "?";
    if ($_SERVER['QUERY_STRING']) {
        foreach ($_GET as $key => $value) {
            if ($key != 'page') $uri .= "$key=$value&";
        }
    }
    return $uri;
}
function get_product($prod_id) {
    global $link;
    $sql = "SELECT * FROM product WHERE id=$prod_id";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $product[0];
}
function get_count_news() {
    global $link;
    $sql = "SELECT COUNT(*) FROM news";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $count[0];
}
function get_count_categories() {
    global $link;
    $sql = "SELECT COUNT(*) FROM category";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $count[0];
}
function select_news($start_pose, $per_page) {
    global $link;
    $sql = "SELECT id, title, date, announcement FROM news ORDER BY date DESC LIMIT $start_pose, $per_page";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $news;
}
function get_article($news_id) {
    global $link;
    $sql = "SELECT * FROM news WHERE id=$news_id";
    if (!$result = mysqli_query($link, $sql))
        return false;
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $product[0];
}
function check_empty($item) {
    if ($item == '')
        return false;
    else
        return true;
}
function save_form($name, $email, $phone, $details) {
    global $link;
    if ($phone == 0)
        $sql = "INSERT INTO feedback (name, email, description) VALUES (?, ?, ?)";
    else
        $sql = "INSERT INTO feedback (name, email, phone, description) VALUES (?, ?, ?, ?)";
    if (!$stmt = mysqli_prepare($link, $sql))
        return false;
    if ($phone == 0)
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $details);
    else
        mysqli_stmt_bind_param($stmt, "ssis", $name, $email, $phone, $details);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
function send_email($name, $email, $phone, $details) {
    if ($phone == 0)
        $message = "Имя: $name<br>Почта: $email<br> Текст: $details";
    else
        $message = "Имя: $name<br>Почта: $email<br>Телефон: $phone<br> Текст: $details";
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth   = true;

        // Настройки вашей почты
        $mail->Host       = 'smtp.gmail.com'; // SMTP сервера GMAIL
        $mail->Username   = 'user.test.itconstruct'; // Логин на почте
        $mail->Password   = '1231231123'; // Пароль на почте
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('user.test.itconstruct@gmail.com', 'Автоматическая рассылка'); // Адрес самой почты и имя отправителя
        $mail->addAddress('user.test.itconstruct@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Письмо с сайта "itconstruct"';
        $mail->Body    = $message;
        $mail->send();

    } catch (Exception $e) {
        echo '';
    }
}
