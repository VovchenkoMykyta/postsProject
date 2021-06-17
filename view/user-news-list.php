<div id="news-list">
    <?php
    $posts = \MySQL\PostDatabase::getPostPage(0, 5);

    foreach ($posts as $post1){
        $id = $post1['id'];
        echo "<div><a href='view/user-news-one.php'>".$post1['name']."</a></div>";
        echo "<a href='view/user-news-one.php'><div>". \MySQL\PostDatabase::getSmallContent($post1['content'])."</div></a>";
    }
    ?>
</div>
