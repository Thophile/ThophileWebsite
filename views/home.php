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
    <meta name="author" content="thophile">
    <meta name="description" content="My personal website to show of some of my projects and all of my skills">
    <meta name ="keywords" content="project, theophile, théophile, thophile, montemont, montémont, resume, it">
    <meta name="robots" content="follow">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/home.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/home.js"></script>

    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <section id="pres">
            <div class="col-70">
                <h2>
                    Théophile Montémont
                </h2>
                <h3>
                    IT Student | Eclectic hobbyist .
                </h3>
                <a href="/about" class="pills inverted">
                    More about me
                </a>
            </div>
            <div class="col-30">
                <i class="far fa-9x fa-user"></i>
            </div>
        </section>
        <section id="projects">
            <div class="col-30">
                <i class="fas fa-9x fa-tasks"></i>
            </div>
            <div class="col-70">
                <h2>
                    I have a a wide range of interests and I love to share my projects.
                </h2>
                <a href="/projects" class="pills inverted">
                    Check my projects
                </a>
            </div>
        </section>
        <section id="contact">
            <div class="col-70">
                <h2>
                    If you have any questions or comments, please get in touch with me.
                </h2>
                <a href="mailto:contact@thophilelabs.com" class="pills inverted">
                    Contact me
                </a>
            </div>
            <div class="col-30">
                <i class="far fa-9x fa-envelope-open"></i>
            </div>
        </section>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>