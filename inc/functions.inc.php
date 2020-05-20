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
function save_form($name, $email, $phone, $details) {
    global $link;
    $sql = "INSERT INTO feedback (name, email, phone, description) VALUES (?, ?, ?, ?)";
    if (!$stmt = mysqli_prepare($link, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $details);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}
function send_email($name, $email, $phone, $details) {
    $message = "Имя: $name<br>Почта: $email<br>Телефон: $phone<br>Текст: $details";
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
function get_page_info($sql_count, $query_page) {
    global $link;
    if (!$result = mysqli_query($link, $sql_count)) {
        return false;
    }
    $count = mysqli_fetch_row($result);
    mysqli_free_result($result);
    $count_products = $count[0];
    $count_pages = ceil($count_products / PER_PAGE);
    if (!$count_pages) {
        $count_pages = 1;
    }
    if ($query_page < 1) {
        $query_page = 1;
    }
    elseif ($query_page > $count_pages) {
        $query_page = $count_pages;
    }
    $page = $query_page;
    $start_pos = ($page - 1) * PER_PAGE;
    $page_info = [
        'count_pages' => $count_pages,
        'page' => $page,
        'start_pos' => $start_pos
    ];
    return $page_info;
}
