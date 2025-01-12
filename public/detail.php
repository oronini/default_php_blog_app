<?php
  require_once(__DIR__ . '/../classes/blog.php');

  $id = $_GET['id'];
  $blog = new Blog();
  $result = $blog->getById($id);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ詳細</title>
</head>
<body>
  <h2>ブログ詳細</h2>
  <h3>タイトル：<?php echo $blog->h($result['title']) ?></h3>
  <p>投稿日時：<?php echo $blog->h($result['post_at']) ?></p>
  <p>カテゴリ：<?php echo $blog->h($blog->setCategoryName($result['category'])) ?></p>
  <hr>
  <p>本文：<?php echo $blog->h($result['content']) ?></p>
  <p><a href="./index.php">home</a></p>
</body>
</html>