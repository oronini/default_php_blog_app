<?php

  require_once('blog.php');

  $id = $_GET['id'];
  $blog = new Blog();
  $result = $blog->delete($id);
?>
<p><a href="../public/index.php">home</a></p>