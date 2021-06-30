<?php $users = MySQL\UserDatabase::getUserList(); ?>
<?php if ($users) : ?>
<div id="table-wrapper">
    <table>

        <thead>
            <tr>
                <td class="user-id">User ID</td>
                <td class="user-login">Login</td>
                <td class="user-action">Action</td>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td class="user-id"><?= $user["id"] ?></td>
                <td class="user-login"><?= $user["login"] ?></td>
                <td class="user-action">
                    <form action="/admin/news/remove/" method="POST">
                        <input type="hidden" value="<?= $user["id"] ?>" name="id">
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
