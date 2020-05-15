<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/landing.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <main>
        <div id="login">
            <i class="far fa-2x fa-user"></i>
            <h1>This is a reserved Area</h1>
            <?php if(isset($error)){ echo '<span class="error">'.$error.'</span>';}?>
        
            <form action="/login" id="log_in" method="post">
                <input type="password" name="password" id="_password" placeholder="Password">
                <div>
                    <a href="/" class="btn inline">Go back</a>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>