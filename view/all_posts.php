<div>
    <?php

    $posts = $post->getPostPage(0, 5);


    foreach ($posts as $post1){
        $id = $post1['id'];
        echo "<a><a href='view/one_post.php'>".$post1['name']."</a></div>";
        echo "<div>".$post->getSmallContent($post1['content'])."</div>";
    }
    ?>
</div>