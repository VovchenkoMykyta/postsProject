<div>
    <?php
    $posts = \MySQL\PostDatabase::getPostPage(0, 5);

    foreach ($posts as $post1){
        $id = $post1['id'];
        echo "<a><a href='view/one_new.php'>".$post1['name']."</a></div>";
        echo "<div>".$post1->getSmallContent($post1['content'])."</div>";
    }
    ?>
</div>