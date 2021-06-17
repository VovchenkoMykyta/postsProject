<?php $post = \MySQL\PostDatabase::getPostById($this->data["id"]) ?>
<?php if ($post) : ?>
<form action="/admin/news/edit" method="POST">
    <input type="text" name="name" value="<?= $post["name"] ?>">
    <input type="textarea" name="content" value="<?= $post["content"] ?>">
    <input type="hidden" name="id" value="<?= $post["id"] ?>">
    <input type="submit" value="EDIT POST">
</form>
<?php endif ?>