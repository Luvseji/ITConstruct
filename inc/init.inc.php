<?
// side-bar
if ($_SERVER['SCRIPT_NAME'] == '/index.php') {
    $sql = "SELECT id, name, image FROM category ORDER BY id";
} else {
    $sql = "SELECT id, name FROM category ORDER BY id";
}
if (!$result = mysqli_query($link, $sql)) {
    $categories = [];
} else {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}
$sql = "SELECT id, title, date FROM news ORDER BY date DESC LIMIT 6";
if (!$result = mysqli_query($link, $sql)) {
    $news_name = [];
} else {
    $news_name = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
}
