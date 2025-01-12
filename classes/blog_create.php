<?php
require_once('blog.php');
$blogs = $_POST;

$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogCreate($blogs)
?>
<p><a href="../public/index.php">home</a></p>