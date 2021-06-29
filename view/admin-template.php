<?php

    $userId = NULL;
    $userLogin = NULL;

    if (isset($_SESSION["user_id"]) && $_SESSION["login"] === "yes") {
        $userId = $_SESSION["user_id"];
        $userLogin = \MySQL\UserDatabase::getUserById($userId)["login"];
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

    <div id="logo">
        <h1>Admin Panel</h1>
    </div>

    <?php if ( !is_null($userId) ) : ?>
        <div id="user">
            <span><?= $userLogin ?></span>
            <form action="/logout" method="POST"><input type="submit" value="logout"></form>
        </div>
    <?php endif;?>
    
</header>

<main>
    
    <?php if ( !is_null($userId) ) : ?>
        <nav id="left-side-bar">
            <ul id="links">
            <li><a href="/admin/news/list">News List</a></li>
            <li><a href="/admin/news/add">News Add</a></li>
            <li><a href="/admin/user/list">Users List</a></li>
            <li><a href="/admin/user/add">User Add</a></li>
            </ul>
        </nav>
    <?php endif;?>

    <div id="container">
        <?php
            if ( isset($_SESSION["errors"]) ) {
                var_dump($_SESSION["errors"]);
                unset($_SESSION["errors"]);
            }
        ?>
        <?php include_once "./view/".$this->pageFile.".php"; ?>
    </div>
   
</main>

<footer>
    <a href="https://github.com/VovchenkoMykyta/postsProject" id="copyright">postsProject &copy;</a>
</footer>

</body>
</html>
