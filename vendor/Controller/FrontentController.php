<?php

namespace Base;

abstract class FrontendController {

    static public function redirect(string $address = "") {
        header("Location: /$address");
        exit();
    }

    static public function redirectToErrorPage () {
        header("Location: /");
        exit();
    }

}
