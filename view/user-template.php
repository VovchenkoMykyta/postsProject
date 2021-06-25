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
    <h1>D-NEWS</h1>
</header>
<main>
    <?php include_once "./view/".$this->pageFile.".php"; ?>
</main>
<footer>
    postsProject &copy;
</footer>
</body>
</html>
