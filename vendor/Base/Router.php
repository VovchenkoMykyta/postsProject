<?php

namespace Base;

use MySQL\PostDatabase;
use MySQL\UserDatabase;

final class Router
{

    static public function init()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = filter_input_array(INPUT_POST);
            $deleteId = filter_input(INPUT_GET, 'remove_id');

            UserDatabase::addUser($user['login'], $user['password'], $user['repeat']);

//            if (){
//
//            }

                self::redirect();

        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

//            if (isset($_GET['id'])) {
//
//                $emitterId = $_COOKIE['id'];
//
//                if ($deleteId !== null) {
//
//                    $id = intval($deleteId);
//
//                    $userDB->removeUser($id, $emitterId);
//
//                }
//                self::redirect();
        } else {

            UserDatabase::getUserList();

        }


    }


    static public function redirect()
    {

        header('Location: index.php');

    }
}
