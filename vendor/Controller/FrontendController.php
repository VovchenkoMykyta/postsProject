<?php

namespace Controller;

abstract class FrontendController {

    static public function redirect(string $address = "") {
        header("Location: /$address");
        exit();
    }

    static public function redirectToErrorPage () {
        header("Location: /error");
        exit();
    }

}
