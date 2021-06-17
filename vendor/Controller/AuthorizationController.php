<?php

namespace Controller;

use \Base\Page;
use \MySQL\UserDatabase;

class AuthorizationController extends FrontendController {

    static public function initGetRequest () {

        $page = new Page ("admin-template", "admin-login");
        $page->render();
        exit();

    }

    static public function initPostRequest (array $pathArray, array $params = NULL) {

        session_start();

        if ($pathArray[0] === "login") {

            $login = $params["login"] ?? NULL;
            $password = $params["password"] ?? NULL;

            if ( !$login || !$password ) {
                $_SESSION["errors"] = ["Incorrect data"];
                static::redirect("login");
            }

            self::login($login, $password);

        } else if ($pathArray[0] === "logout") {

            self::logout();

        } else {

            self::redirect();

        }

    }

    static private function login (string $login, string $password) {

        $userData = UserDatabase::getUserByLogin($login);
        if (!$userData) {
            $_SESSION["errors"] = ["Incorrect login"];
            static::redirect("login");
        }

        $passwordHash = $userData["password"];
        $isPasswordCorrect = password_verify($password, $passwordHash);

        if ($isPasswordCorrect) {
            $_SESSION["login"] = "yes";
            $_SESSION["user_id"] = $userData["id"];
            static::redirect("admin/news/list");
        } else {
            $_SESSION["errors"] = ["Incorrect password"];
            static::redirect("login");
        }

    }

    static private function logout () {

        $_SESSION = [];
        unset($_COOKIE[session_name()]);
        session_destroy();
        static::redirect("news/list/?page=1");

    }

}
