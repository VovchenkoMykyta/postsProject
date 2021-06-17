<?php

namespace Base;

class AdminGetController extends FrontendController {

    static private $templateName = "admin-template";
    static private $actionList = [

        "news" => [
            "list"  => "admin-news-list",
            "add"   => "admin-news-add",
            "edit"  => "admin-news-edit"
        ],

        "user" => [
            "list"  => "admin-user-list",
            "add"   => "admin-user-add"
        ]
        
    ];

    static public function initGetRequest (array $pathArray) {

        session_start();
        if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "yes") FrontendController::redirect("login");

        $actionArea = $pathArray[1] ?? NULL;
        $actionType = $pathArray[2] ?? NULL;

        $actionAreaArray = static::$actionList[$actionArea] ?? NULL;
        $pageFile = $actionAreaArray[$actionType] ?? NULL;

        if (!$pageFile) static::redirectToErrorPage();

        $page = new Page (static::$templateName, $pageFile);
        $page->render();
        exit();

    }

}
