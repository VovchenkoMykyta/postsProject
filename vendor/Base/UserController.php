<?php

namespace Base;

class UserController extends FrontendController {

    static protected $templateName = "user-template";

    static public function initGetRequest (array $pathArray) {

        $actionArea = $pathArray[1] ?? NULL;
        if ($actionArea !== "news") static::redirectToErrorPage();

        $actionType = $pathArray[2] ?? NULL;
        if ( $actionType === strval(intval($actionType)) ) {

            $pageFile = "user-news-one";
            $data = ["news_id" => $actionType];

        } else if ($actionType === "list") {

            $pageFile = "user-news-list";

            $pageNumber = $pathArray[3] ?? NULL;
            if ( $pageNumber === strval(intval($pageNumber)) ) {
                $data = ["page" => $pageNumber];
            } else {
                $data = ["page" => 1];
            }

        } else {
            static::redirectToErrorPage();
        }

        $page = new Page (static::$templateName, $pageFile);
        $page->render($data);
        exit();

    }

}
