<?php
require_once(__DIR__ . '/../classes/blog.php');

  $id = $_GET['id'];
  $blog = new Blog();
  $result = $blog->getById($id);

  // var_dump($result);
  // var_dump((int)$id);

  $title = $result['title'];
  $content = $result['content'];
  $category = (int)$result['category'];
  $publish_status= (int)$result['publish_status'];
?>


<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog更新Form</title>
  </head>
  <body>
    <h2>ブログ更新フォーム</h2>
    <form action="../classes/blog_update.php" method="post">
      <input type="hidden" name="id" value=<?php echo (int)$id ?>>
      <p>ブログタイトル：</p>
      <input type="text" name="title" value="<?php echo $title ?>"/>
      <p>ブログ本文：</p>
      <textarea
        name="content"
        id="content"
        cols="30"
        rows="10"
        style="display: block"
      ><?php echo $content ?></textarea>
      <p>カテゴリ：</p>
      <select name="category">
        <option value="1" <?php if($category === 1 ) echo "selected" ?>>日常</option>
        <option value="2" <?php if($category === 2 ) echo "selected" ?>>プログラミング</option>
      </select>
      <label for="publish">
        <input
          type="radio"
          name="publish_status"
          value="1"
          id="publish"
          <?php if($category === 1 ) echo "checked" ?>
        />公開
      </label>
      <label for="un_publish">
        <input
          type="radio"
          name="publish_status"
          value="2"
          id="un_publish"
          <?php if($category === 2 ) echo "checked" ?>
        />非公開
      </label>
      <input type="submit" value="更新" style="display: block" />
    </form>
    <p><a href="./index.php">home</a></p>
  </body>
</html>