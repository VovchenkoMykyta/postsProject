<?php


namespace Base;


abstract class FrontendController
{

    static public function redirect(string $address = null)
    {
        header("Location: /$address");
        exit();
    }

    static public function redirectToErrorPage()
    {
        header("Location: /");
        exit();
    }

}