<?php
    $users = MySQL\UserDatabase::getUserList();
?>

<?php if ($users) : ?>
<table>

    <thead>
        <tr>
            <?php foreach (array_keys($users[0]) as $key): ?>
            <td><?= $key ?></td>
            <?php endforeach ?>
            <td>Action</td>
        </tr>
    </thead>
    
    <tbody>
    <?php foreach ($users as $post): ?>
        <tr>
            <?php foreach ($post as $field): ?>
            <td><?= $field ?></td>
            <?php endforeach ?>
            <td>
                <form action="/admin/user/remove/" method="POST">
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
