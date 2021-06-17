<?php

namespace Controller;

use \Base\Page;

class ErrorController extends FrontendController {

    static public function initGetRequest () {

        $page = new Page ("user-template", "user-error");
        $page->render();
        exit();

    }
    
}
