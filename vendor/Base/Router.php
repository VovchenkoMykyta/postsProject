<?php

namespace Base;

use MySQL\UserDatabase;

final class Router {

    static public function init(){
        $userDB = new UserDatabase();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $user = filter_input_array(INPUT_POST);

            $userDB->addUser($user['login'], $user['password'], $user['repeat']);

            self::redirect();

        }else if($_SERVER['REQUEST_METHOD'] === 'GET' ){

            if(isset($_GET['id'])){
                $deleteId = filter_input(INPUT_GET, 'id');
                $emitterId = $_COOKIE['id'];

                if($deleteId!==null){

                    $id = intval($deleteId);

                    $userDB->removeUser($id, $emitterId);

                }
                self::redirect();
            }


        }else{

            $userDB->getUserList();

        }

    }

    static public function redirect(){

        header('Location: index.php');

    }
}
