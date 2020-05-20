<?
function clear_str($data) {
    $new = strip_tags(trim($data));
    return $new;
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
