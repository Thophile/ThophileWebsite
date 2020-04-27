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
    <meta author="Thophile">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <section id="pres" class="section-row">
            <div class="col-70">
                <h1>
                    I'm an IT Student and this is my website
                </h1>
                <h2>
                    Hello there, My name is Théophile but due to an encryption problem I was nicknamed Thophile
                </h2>
            </div>
            <div class="col-30">
                <i class="far fa-9x fa-user"></i>
            </div>
        </section>
        <section id="projects" class="section-row">
            <div class="col-70">
                <h1>
                    I do a lot of fun stuff for and next to my schooling.
                </h1>
                <a href="/projects" class="btn">
                    Check them all
                </a>
            </div>
            <div class="col-30">
                <i class="fas fa-9x fa-tasks"></i>
            </div>
        </section>
        <section id="contact" class="section-row">
            <div class="col-70">
                <h1>
                    You can contact me if you want some information about my projects or if you want to do business with
                    me
                </h1>
                <a href="mailto:montemonttheophile@gmail.com?subject=Mail from our site" class="btn">
                    Contact me
                </a>
            </div>
            <div class="col-30">
                <i class="far fa-9x fa-envelope-open"></i>
            </div>
        </section>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>

</html>