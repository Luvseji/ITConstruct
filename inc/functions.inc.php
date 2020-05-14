<?
function clear_str($data) {
    $new = strip_tags(trim($data));
    return $new;
}
function select_categories() {
    global $link;
    $sql = "SELECT id, name, image FROM category ORDER BY id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}
function select_categories_name() {
    global $link;
    $sql = "SELECT id, name FROM category ORDER BY id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $categories;
}
function select_news_name() {
    global $link;
    $sql = "SELECT id, title, date FROM news ORDER BY date DESC LIMIT 6";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $news;
}
function clear_pagination_uri($page, $count_pages) {
    $uri = "?";
    if ($_SERVER['QUERY_STRING']) {
        foreach ($_GET as $key => $value) {
            if ($key != 'page') {
                $uri .= "$key=$value&";
            }
        }
    }
    return $uri;
}
function get_product($prod_id) {
    global $link;
    $sql = "SELECT * FROM product WHERE id=$prod_id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $product[0];
}
function get_count_news() {
    global $link;
    $sql = "SELECT COUNT(*) FROM news";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $count[0];
}
function get_count_categories() {
    global $link;
    $sql = "SELECT COUNT(*) FROM category";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    return $count[0];
}
function select_news($start_pose, $per_page) {
    global $link;
    $sql = "SELECT id, title, date, announcement FROM news ORDER BY date DESC LIMIT $start_pose, $per_page";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $news = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $news;
}
function get_article($news_id) {
    global $link;
    $sql = "SELECT * FROM news WHERE id=$news_id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $product = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $product[0];
}
function check_empty($item) {
    if ($item == '') {
        return false;
    }
    else {
        return true;
    }
}
function save_form(...$elements) {
    global $link;
    $sql = "INSERT INTO feedback (name, email, " . (count($elements) == 4 ? "phone, " : '') . "description) VALUES (?, ?, " . (count($elements) == 4 ? "?, " : '') . "?)";
    if (!$stmt = mysqli_prepare($link, $sql)) {
        return false;
    }
    if (count($elements) == 4) {
        mysqli_stmt_bind_param($stmt, "ssis", $elements[0], $elements[1], $elements[2], $elements[3]);
    }
    else {
        mysqli_stmt_bind_param($stmt, "sss", $elements[0], $elements[1], $elements[2]);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
function send_email(...$elements) {
    $message = "Имя: $elements[0]<br>Почта: $elements[1]<br>" . (count($elements) == 4 ? "Телефон: $elements[2]<br>Текст: $elements[3]" : "Текст: $elements[2]");
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();
        $mail->CharSet = MAIL_CHARSET;
        $mail->SMTPAuth   = MAIL_SMTP_AUTH;
        $mail->Host       = MAIL_HOST;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = MAIL_SMTP_SECURE;
        $mail->Port       = MAIL_PORT;
        $mail->setFrom(MAIL_SET_FROM);
        $mail->addAddress(MAIL_ADD_ADDRESS);
        $mail->isHTML(MAIL_IS_HTML);
        $mail->Subject = MAIL_SUBJECT;
        $mail->Body    = $message;
        if (!$mail->send()) {
            return false;
        }
    } catch (Exception $e) {
        echo '';
    }
    return true;
}
function check_main_category($cat_id, $product_id) {
    global $link;
    $sql = "SELECT COUNT(*) FROM product WHERE category_main_id=$cat_id AND id=$product_id";
    if (!$result = mysqli_query($link, $sql)) {
        return false;
    }
    $main_cat = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($main_cat[0][0] == 0) {
        return true;
    }
}
