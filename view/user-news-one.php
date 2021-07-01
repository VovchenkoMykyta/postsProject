<?php
    $post = \MySQL\PostDatabase::getPostById($this->data["id"]);
    $userLogin = \MySQL\UserDatabase::getUserById($post["user_id"])["login"] ?? "ID: {$post["user_id"]}";
?>

<div id="news-item">

    <div class="caption">
    <?= $post["name"] ?>
    </div>

    <div class="content">
        <span><?= $post["content"] ?></span>
    </div>

    <div class="credentials">

        <div class="author">
            <span><?= $userLogin ?></span>
        </div>

        <div class="date">
            <span><?= $post["creation_date"] ?></span>
        </div>

    </div>

</div>

