<div id="news-list">
    <?php
    $postsList = \MySQL\PostDatabase::getPostPage(0, 5);

    foreach ($postsList as $post){
        $id = $post['id'];
        echo "<div><a href='/news/?id=$id'>".$post['name']."</a></div>";
        echo "<a href='/news/?id=$id'><div>". \MySQL\PostDatabase::getSmallContent($post['content'])."</div></a>";
    }
    ?>
</div>
