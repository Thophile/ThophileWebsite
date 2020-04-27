<?php
    if(!defined('Router')) {
        include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Thophile">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/landing.js"></script>
    <title><?= $title ?></title>
</head>

<body id="landing">
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <h1>This is a reserved Area</h1>
        <?php if(isset($error)){ echo '<span class="error">'.$error.'</span>';}?>

        <form action="/login" id="log_in" method="post">
            <input type="password" name="password" id="_password" placeholder="Password">
            <button type="submit" style="">Log in</button>
        </form>
        <a href="/" class="btn inline">Go back to site</a>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>

</html>