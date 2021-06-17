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
<<<<<<< Updated upstream
<header>
    <?php if ( !is_null($userId) ) : ?>
        <?= \MySQL\UserDatabase::getUserById($userId)["login"] ?>
        <form action="/logout" method="POST"><input type="submit" value="logout"></form>
    <?php endif ?>
</header>
<main>
    <?php include_once "./view/".$this->pageFile.".php"; ?>
    <?php if ( $this->data ) var_dump($this->data) ?>
    <?php if ( isset($_SESSION["errors"]) ) {
        var_dump($_SESSION["errors"]);
        unset($_SESSION["errors"]);
     }
     ?>
</main>
<footer>
    postsProject &copy;
</footer>
=======
    
    <header>
        <?php if ( !is_null($userId) ) : ?>
            <?= \MySQL\UserDatabase::getUserById($userId)["login"] ?>
            <form action="/logout" method="POST"><input type="submit" value="logout"></form>
        <?php endif;?>
    </header>
    
    <main>
        
        <div class="container">
    
            <?php
//                if ( isset($_SESSION["errors"]) ) {
//                    var_dump($_SESSION["errors"]);
//                    unset($_SESSION["errors"]);
//                }
            ?>

            <?php include_once "./view/".$this->pageFile.".php"; ?>
            
        </div>
    
    
    
    </main>
    
    <footer>
        postsProject &copy;
    </footer>
    
>>>>>>> Stashed changes
</body>
</html>
