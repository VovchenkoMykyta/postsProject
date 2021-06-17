<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style/<?= $this->pageFile ?>.css">
    <link rel="stylesheet" href="/style/admin-template.css">
    <title>Admin</title>
</head>
<body>
<header>
    Logo
</header>
<main>
    <?php include_once "./view/".$this->pageFile.".php"; ?>
    <?= $this->pageFile ?>
    <?php var_dump($this->data) ?>
</main>
<footer>
    postsProject &copy;
</footer>
</body>
</html>
