<?php

namespace Base;

class AuthorizationController extends FrontendController {

    static public function initGetRequest () {

        $page = new Page ("admin-template", "admin-login");
        $page->render();
        exit();

    }

    static public function initPostRequest (array $pathArray, array $params = NULL) {}

    static private function login (string $login, string $password) {}
    static private function logout () {}
    
}
