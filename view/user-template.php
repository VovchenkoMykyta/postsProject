    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Posts</title>
        <link rel="stylesheet" href="../css/user.css">
    </head>
    <body>
        <header>
            <h1>News</h1>
        </header>
        <main>
            <?php
            include "../autoload.php";
            $pathAray = [
                ""
            ];
//            \Base\UserController::initGetRequest();
            $page = new \Base\Page('user-template', 'user-news-list');
            $page->render();

            ?>
        </main>
        <footer>
            <a href="https://github.com/VovchenkoMykyta/postsProject.git"><h3>Project</h3></a>
        </footer>
    </body>
</html>