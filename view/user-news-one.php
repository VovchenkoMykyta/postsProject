<?php $post = \MySQL\PostDatabase::getPostById($this->data["id"]) ?>

<p>PostName:<?= $post["name"] ?></p>

<p>PostName:<?= $post["content"] ?></p>
