<div>
    <?php
    include_once "../vendor/MySQL/Database.php";
    include_once "../vendor/MySQL/PostDatabase.php";
    $posts =  \MySQL\PostDatabase::getPostById(1);
    var_dump($posts);
    exit();
    $one_post = $post->getPostById($id);
    echo $one_post;
    ?>
</div>