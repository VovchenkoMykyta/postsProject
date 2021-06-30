<?php
    $page = intval($this->data["page"]) ?? 1;
    $postsList = \MySQL\PostDatabase::getPostPage($page, POSTS_ON_PAGE);
    $totalPostsAmount = \MySQL\PostDatabase::getAllPostsAmount();
?>

<div id="news-list">
    <?php foreach ($postsList as $post): ?>

        <?php
            $userLogin = \MySQL\UserDatabase::getUserById($post["user_id"])["login"] ?? "ID: {$post["user_id"]}";
            $content = \MySQL\PostDatabase::getSmallContent($post["content"]);
        ?>

        <div class="news">

            <div class="caption">
                <a href="/news/?id=<?= $post["id"] ?>"><?= $post["name"] ?></a>
            </div>

            <div class="content">
                <span><?= $content ?></span>
            </div>

            <div class="credentials">

                <div class="author">
                    <span><?= $userLogin ?></span>
                </div>

                <div class="date">
                    <span><?= $post["creation_date"] ?></span>
                </div>

            </div>

            

        </div>
    
    <?php endforeach ?>
</div>

<?php if ($totalPostsAmount > POSTS_ON_PAGE) : ?>
<div id="pagination">
    
    <?php if ($page>1) : ?>
        <div id="back" class="active">
            <a href="/news/list/?page=<?= $page-1 ?>"><<</a>
        </div>
    <?php else : ?>
        <div id="back" class="disable"><<</div>
    <?php endif ?>
    

    <?php for ($i=1; $i<($totalPostsAmount/POSTS_ON_PAGE)+1; $i++) : ?>

        <?php if ($i == $page) : ?>

            <div class="page disable">
                <?= $i ?>
            </div>
        
        <?php else : ?>

            <div class="page active">
                <a href="/news/list/?page=<?= $i ?>"><?= $i ?></a>
            </div>

        <?php endif ?>
        
    <?php endfor ?>

    <?php if ($page<($totalPostsAmount/POSTS_ON_PAGE)) : ?>
        <div id="forward" class="active">
            <a href="/news/list/?page=<?= $page+1 ?>">>></a>
        </div>
    <?php else : ?>
        <div id="forward" class="disable">>></div>
    <?php endif ?>

</div>
<?php endif ?>
