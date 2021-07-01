<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style/<?= $this->pageFile ?>.css">
    <link rel="stylesheet" href="/style/user-template.css">
    <title>News</title>
</head>
<body>

    <header>
        <h1><a href="/">D-NEWS</a></h1>
        <div id="admin"><a href="/admin">admin</a></div>
    </header>

    <main>
        <?php
            if ( isset($_SESSION["errors"]) ) {
                var_dump($_SESSION["errors"]);
                unset($_SESSION["errors"]);
            }
        ?>
        <?php include_once "./view/".$this->pageFile.".php"; ?>
    </main>

    <footer>
        <a href="https://github.com/VovchenkoMykyta/postsProject" id="copyright">postsProject &copy;</a>
    </footer>

</body>
</html>
