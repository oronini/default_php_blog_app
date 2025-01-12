<?php
require_once(__DIR__ . '/../classes/blog.php');

$blog = new Blog();
$blogData = $blog->getAll();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-language" content="ja">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ一覧</title>
</head>
<body>
  <h2>ブログ一覧</h2>
  <p><a href="./form.html">新規作成</a></p>
  <table>
    <tr>
      <th>タイトル</th>
      <th>カテゴリ</th>
      <th>投稿日時</th>
    </tr>
    <?php foreach($blogData as $column): ?>
      <tr>
        <td><?php echo $blog->h($column['title']) ?></td>
        <td><?php echo $blog->h($blog->setCategoryName($column['category'])) ?></td>
        <td><?php echo $blog->h($column['post_at']) ?></td>
        <td><a href="./detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
        <td><a href="./update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
        <td><a href="../classes/blog_delete.php?id=<?php echo $column['id'] ?>">削除</a></td>
      </tr>
    <?php endforeach ?>
  </table>
  <a href="../../index.php">app list</a>
</body>
</html>