<?php
//    include_once "../config.php";
    include "../autoload.php";
    $page = new \Base\Page('main_template', 'one_post');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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