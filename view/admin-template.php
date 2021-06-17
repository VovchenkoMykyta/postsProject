<?php

    if (isset($_SESSION["user_id"]) && $_SESSION["login"] === "yes") {
        $userId = $_SESSION["user_id"];
    } else {
        $userId = NULL;
    }
    
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style/<?= $this->pageFile ?>.css">
    <link rel="stylesheet" href="/style/admin-template.css">
    <title>Admin</title>
</head>
<body>
<header>
    <?php if ( !is_null($userId) ) : ?>
        <?= \MySQL\UserDatabase::getUserById($userId)["login"] ?>
        <form action="/logout" method="POST"><input type="submit" value="logout"></form>
    <?php endif;?>
</header>
<main>
    
    <?php
        if ( isset($_SESSION["errors"]) ) {
            var_dump($_SESSION["errors"]);
            unset($_SESSION["errors"]);
        }
    ?>
        
    <?php include_once "./view/".$this->pageFile.".php"; ?>
    
</main>
<footer>
    postsProject &copy;
</footer>
</body>
</html>
