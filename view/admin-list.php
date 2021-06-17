<div>
    <?php
    $posts =  \MySQL\PostDatabase::getPostPage(0, 100);
    $tablePosts = "<table><tr><th>id</th><th>user_id</th><th>name</th><th>content</th><th>creation_date</th></tr>";
    foreach ($posts as $post) {
       $strPost .= "<tr><td>". $post['id'] ."</td><td>".$post['user_id']."</td><td>".$post['name']."</td><td>".$post['content']."</td><td>".$post['creation_date']."</td></tr>";
    }
    echo $tablePosts . $strPost . "</table>";
    ?>
</div>
<div>
    <?php
    $userList = \MySQL\UserDatabase::getUserList();
    $tableUsers = "<table><tr><th>id</th><th>login</th><th>password</th></tr>";
    foreach ($userList as $user){
        $strUser .= "<tr><td>". $user['id'] ."</td><td>".$user['login']."</td><td>".$user['password']."</td></tr>";
    }
    echo $userList . $strUser . "</table>";
    ?>
</div>