<div>
    <?php
    include_once "../vendor/MySQL/PostDatabase.php";
    $post = new \MySQL\PostDatabase();
    $posts = $post->getPostPage(0,1);
    var_dump($posts);
    exit();
    $one_post = $post->getPostById($id);
    echo $one_post;
    ?>
</div>