<?php

namespace Controller;

use \MySQL\PostDatabase;
use \MySQL\UserDatabase;

final class AdminPostController extends FrontendController {

    static private $actionList = [

        "news" => [
            "add"       => "addPost",
            "edit"      => "editPost",
            "remove"    => "removePost"
        ],

        "user" => [
            "add"       => "addUser",
            "remove"    => "removeUser"
        ]
        
    ];

    static public function initPostRequest (array $pathArray, array $params = NULL) {

        session_start();
        if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "yes") static::redirect("login");

        $actionArea = $pathArray[1] ?? NULL;
        $actionType = $pathArray[2] ?? NULL;

        if (!$actionArea || !$actionType) static::redirectToErrorPage();

        $actionArray = static::$actionList[$actionArea] ?? NULL;
        $methodName = $actionArray[$actionType] ?? NULL;
        if (!$methodName) static::redirectToErrorPage();

        forward_static_call($methodName, $params);

    }

    static private function addPost (array $params) {

        $postName = $params["name"] ?? NULL;
        $postContent = $params["content"] ?? NULL;

        if (!$postName || !$postContent) {
            $_SESSION["errors"] = ["Incorrect data"];
            static::redirect("admin/news/add");
        }

        $userId = intval($_SESSION["user_id"]);

        var_dump($postName, $postContent, $userId);
        exit();

        $errors = PostDatabase::addPost($postName, $postContent, $userId);

        if ($errors)  $_SESSION["errors"] = $errors;

        static::redirect($params[0], $params[1], $params[2]);

    }

    static private function removePost (array $params) {

        $postId = $params["id"] ?? NULL;

        if (!$postId) {
            $_SESSION["errors"] = ["Such post does not exists"];
            static::redirect("admin/news/list");
        }

        $postId = intval($postId);
        $userId = intval($_SESSION["user_id"]);

        $errors = PostDatabase::removePost($postId, $userId);

        if ($errors)  $_SESSION["errors"] = $errors;

        static::redirect($params[0], $params[1], $params[2]);

    }

    static private function editPost (array $params) {

        $postId = $params["id"] ?? NULL;
        $postName = $params["name"] ?? NULL;
        $postContent = $params["content"] ?? NULL;

        if (!$postId || !$postName || $postContent) {
            $_SESSION["errors"] = ["Incorrect data"];
            static::redirect("admin/news/edit");
        }

        $postId = intval($postId);

        $errors = PostDatabase::editPost($postId, $postName, $postContent);

        if ($errors)  $_SESSION["errors"] = $errors;

        static::redirect($params[0], $params[1], $params[2]);

    }

    static private function addUser (array $params) {

        $login = $params["login"] ?? NULL;
        $password = $params["password"] ?? NULL;
        $repeat = $params["repeat"] ?? NULL;

        if (!$login || !$password || !$repeat) {
            $_SESSION["errors"] = ["Incorrect data"];
            static::redirect("admin/user/add");
        }

        $errors = UserDatabase::addUser($login, $password, $repeat);

        if ($errors)  $_SESSION["errors"] = $errors;

        static::redirect($params[0], $params[1], $params[2]);

    }

    static private function removeUser (array $params) {

        $targetId = $params["id"] ?? NULL;
        $userId = intval($_SESSION["user_id"]);

        if (!$targetId) {
            $_SESSION["errors"] = ["Such user does not exists"];
            static::redirect("admin/user/list");
        }

        $errors = UserDatabase::removeUser($targetId, $userId);

        if ($errors)  $_SESSION["errors"] = $errors;

        static::redirect($params[0], $params[1], $params[2]);

    }

}
