<?php
    include_once "../config.php";
    $page = new \Base\Page('all_posts.php', 'one_post.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
</head>
<body>
<header>
    Logo
</header>
<main>
    <?php include_once $this->pageFile; ?>
</main>
<footer>
    postsProject &copy;
</footer>
</body>
</html>