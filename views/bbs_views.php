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
    Tweet: <input type="text" name="comment" size="60" /><br />
    <input type="submit" name="submit" value="send" />
  </form>
<?php if (count($posts) > 0): ?>
<ul>
  <?php foreach ($posts as $post): ?>
  <li>
    <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?>:
    <?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8'); ?>
    - <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>

</body>
</html>
