<?php

namespace Controller;

use \Base\Page;

class UserController extends FrontendController {

    static protected $templateName = "user-template";

    static public function initGetRequest (array $pathArray, array $params = NULL) {

        $actionArea = $pathArray[0] ?? NULL;
        if ($actionArea !== "news") static::redirectToErrorPage();

        $actionType = $pathArray[1] ?? NULL;

        $data = [];

        if ($actionType === "list") {

            $pageFile = "user-news-list";
            $pageNumber = $params["page"] ?? NULL;
            if ( $pageNumber !== strval(intval($pageNumber)) ) $pageNumber = 1;
            $data["page"] = $pageNumber;

        } else if ( !$actionType && isset($params["id"]) ) {

            $pageFile = "user-news-one";
            $newsId = $params["id"] ?? NULL;
            $data["id"] = $newsId;

        } else if (!$actionType) {

            static::redirect("news/list/?page=1");

        } else {

            static::redirectToErrorPage();

        }

        $page = new Page (static::$templateName, $pageFile, $data);
        $page->render();
        exit();

    }

}
