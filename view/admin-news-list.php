<?php
    $posts = MySQL\PostDatabase::getPostAll();
?>

<?php if ($posts) : ?>
<table>

    <thead>
        <tr>
            <?php foreach (array_keys($posts[0]) as $key): ?>
            <td><?= $key ?></td>
            <?php endforeach ?>
            <td>Action</td>
        </tr>
    </thead>
    
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr>
            <?php foreach ($post as $field): ?>
            <td><?= $field ?></td>
            <?php endforeach ?>
            <td>
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
<?php endif ?>
