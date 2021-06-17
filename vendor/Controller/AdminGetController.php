<?php

namespace Controller;

use \Base\Page;

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

    static public function initGetRequest (array $pathArray, array $params = NULL) {

        session_start();
        if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "yes") static::redirect("login");

        $actionArea = $pathArray[1] ?? NULL;
        $actionType = $pathArray[2] ?? NULL;

        if (!$actionArea || !$actionType) static::redirectToErrorPage();
        
        $actionAreaArray = static::$actionList[$actionArea] ?? NULL;
        $pageFile = $actionAreaArray[$actionType] ?? NULL;
        
        if (!$pageFile) static::redirectToErrorPage();

        if ( $pageFile === "admin-news-edit" && !isset($params["id"]) ) static::redirect("admin/news/list");

        $page = new Page (static::$templateName, $pageFile, $params);
        $page->render();
        exit();

    }

}
