<?php
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
  die('cannot connetct to DB:' . mysql_error());
}

mysql_select_db('online_bbs', $link);

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
      '" . mysql_real_escape_string($name) . "',
      '" . mysql_real_escape_string($comment) . "',
      '" . date('Y-m-d H:i:s') . "')";

    mysql_query($sql, $link);
  }
}
?>

<!DOCTYPE html PUBLIC "-//W#C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.did">
<html>
<head>
  <title>Post feed</title>
</head>
<body>
  <h1>Post feed</h1>

  <form action="bbs.php" method="post">
    <?php if (count($errors)): ?>
    <ul class="error_list">
      <?php foreach ($errors as $error): ?>
      <li>
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    Name: <input type="text" name="name" /><br />
    Tweet: <input type="submit" name="submit" value="send" />
  </form>
</body>
</html>
