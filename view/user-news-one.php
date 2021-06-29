<?php $post = \MySQL\PostDatabase::getPostById($this->data["id"]) ?>

<p id="name"><?= $post["name"] ?></p>

<p id="content"><?= $post["content"] ?></p>
