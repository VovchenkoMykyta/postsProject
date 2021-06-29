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
    <h1>Admin Panel</h1>
    <ul id="links">
        <li><a href="/admin/news/list">News List</a></li>
        <li><a href="/admin/news/add">News Add</a></li>
        <li><a href="/admin/user/list">Users List</a></li>
        <li><a href="/admin/user/add">User Add</a></li>
    </ul>
    <?php if ( !is_null($userId) ) : ?>
        <h2>User: <?= \MySQL\UserDatabase::getUserById($userId)["login"] ?> </h2>
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
<script src="../js/index.js"></script>
</body>
</html>
