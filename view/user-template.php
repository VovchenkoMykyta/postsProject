    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Posts</title>
    </head>
    <body>
        <header>

        </header>
        <main>
            <?php
            include "../autoload.php";
            $pathAray = [

            ];
            \Base\UserController::initGetRequest();
            if(\Base\AuthorizationController::login($_POST['login'], $_POST['pass'])){
                $page = new \Base\Page('admin-template', 'admin-list');
                $page->render();
            }
            ?>
        </main>
        <footer>

        </footer>
    </body>
</html>