<?php

namespace Base;

final class Router {

    static public function init () {

        $uri = parse_url($_SERVER["REQUEST_URI"]);
        $pathArray = explode("/", substr($uri["path"], 1));

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            
            if ($pathArray[0] === "admin") {
                AdminGetController::initGetRequest($pathArray);
            } else if ($pathArray[0] === "login") {
                AuthorizationController::initGetRequest();
            } else if ($pathArray[0] === "user") {
                UserController::initGetRequest($pathArray);
            } else if ($pathArray[0] === "error") {
                ErrorController::initGetRequest();
            } else {
                FrontendController::redirectToErrorPage();
            }

        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $params = filter_input_array(INPUT_POST);

            if ($pathArray[0] === "admin") {
                AdminPostController::initPostRequest($pathArray, $params);
            } else if ($pathArray[0] === "login" || $pathArray[0] === "logout") {
                AuthorizationController::initPostRequest($pathArray, $params);
            } else {
                FrontendController::redirectToErrorPage();
            }

        } else {
            FrontendController::redirect();
        }

    }

}
