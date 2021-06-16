<?php
include "autoload.php";
include_once "config.php";

\Base\Router::init();
$page = new \Base\Page('view/all_posts.php', 'view/main_template.php');
$page->render('view/all_posts.php');