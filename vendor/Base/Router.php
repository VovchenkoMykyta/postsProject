<?php

namespace Base;

use MySQL\PostDatabase;
use MySQL\UserDatabase;

final class Router
{

    static public function init()
    {
        $userDB = new UserDatabase();
        $post = new PostDatabase();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = filter_input_array(INPUT_POST);

            $userDB->addUser($user['login'], $user['password'], $user['repeat']);

            self::redirect();

        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['id'])) {
                $deleteId = filter_input(INPUT_GET, 'id');
                $emitterId = $_COOKIE['id'];

                if ($deleteId !== null) {

                    $id = intval($deleteId);

                    $userDB->removeUser($id, $emitterId);

                }
                self::redirect();
            }

            $id = filter_input(INPUT_GET, 'id');
            if ($id === null) {
                $posts = $post->getPostPage(0, 5);
                $page = new Page('view/all_posts.php', 'view/main_template.php');
                $page->render($posts);
            } elseif ($id !== null) {
                $intId = intval($id);
                $one_post = $post->getPostById($intId);
                $page = new Page('view/one_post.php', 'view/main_template.php');
                $page->render($one_post);
            }

        } else {

            $userDB->getUserList();

        }

    }

    static public function redirect()
    {

        header('Location: index.php');

    }
}
