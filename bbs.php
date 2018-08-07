<?php
$link = mysqli_connect('127.0.0.1', 'root', '', 'oneline_bbs'); if (!$link) { die('cannot connetct to DB:' . mysqli_error()); }

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = null;
  if (!isset($_POST['name']) || !strlen($_POST['name'])) {
    $errors['name'] = 'Name cannot be blank';
  } else if (strlen($_POST['name']) > 40) {
    $errors['name'] = 'Name cannot be over 40 characters';
  } else {
    $name = $_POST['name'];
  }

  $comment = null;
  if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
    $errors['comment'] = 'Tweet cannot be blank';
  } else if (strlen($_POST['comment']) > 200) {
    $errors['comment'] = 'Tweet cannot be over 200 characters';
  } else {
    $comment = $_POST['comment'];
  }

  if (count($errors) === 0) {
    $sql = "INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES (
      '" . mysqli_real_escape_string($link, $name) . "',
      '" . mysqli_real_escape_string($link, $comment) . "',
      '" . date('Y-m-d H:i:s') . "')";

    mysqli_query($link, $sql);
    mysqli_close($link);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  }
}

$sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
$result = mysqli_query($link, $sql);

$posts = array();
if ($result != false && mysqli_num_rows($result)) {
  while ($post = mysqli_fetch_assoc($result)) {
    $posts[] = $post;
  }
}
mysqli_free_result($result);
mysqli_close($link);

include 'views/bbs_views.php'
?>
