<?php
    $posts = MySQL\PostDatabase::getPostAll();
?>

<?php if ($posts) : ?>
<div id="table-wrapper">
    <table>

        <thead>
            <tr>
                <td class="post-id">Post ID</td>
                <td class="author">Author</td>
                <td class="post-name">Post Name</td>
                <td class="post-date">Creation date</td>
                <td class="post-action">Action</td>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach ($posts as $post): ?>
            <?php $userLogin = \MySQL\UserDatabase::getUserById($post["user_id"])["login"] ?? "ID: {$post["user_id"]}"; ?>
            <tr>
                <td class="post-id"><?= $post["id"] ?></td>
                <td class="author"><?= $userLogin ?></td>
                <td class="post-name"><?= $post["name"] ?></td>
                <td class="post-date"><?= $post["creation_date"] ?></td>
                <td class="post-action">
                    <a href="/admin/news/edit/?id=<?= $post["id"] ?>">Edit</a>
                    <form action="/admin/news/remove/" method="POST">
                        <input type="hidden" value="<?= $post["id"] ?>" name="id">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>

        <tfoot></tfoot>

    </table>
</div>
<?php endif ?>
