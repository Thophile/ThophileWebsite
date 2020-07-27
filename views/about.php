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
    <meta name="description" content="All information you will ever need about myself, download my resume here too">
    <meta name ="keywords" content="project, theophile, théophile, thophile, montemont, montémont, resume, it">
    <meta name="robots" content="follow">

    <meta property="og:title" content="All about me | Thophile Labs" />
    <meta property="og:image" content="https://thophilelabs.com/assets/img/favicon.png" />
    <meta property="og:url" content="https://thophilelabs.com/about" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Learn about my studies and how I came up with so many hobbies" />

    <link rel="canonical" href="https://thophilelabs.com/about">
    <link rel="stylesheet" href="/assets/css/about.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <div id="header" class="col">
            <h1><?= translate("ABOUT.HEADER")?></h1>
        </div>
        <article>
            <h2><?= translate("ABOUT.ARTICLE.STUDIES")?></h2>
            <section id="studies">
                <p><?= translate("ABOUT.ARTICLE.P1")?></p>
            </section>

            <h2><?= translate("ABOUT.ARTICLE.HOBBIES")?></h2>
            <section id="hobbies">
                <p><?= translate("ABOUT.ARTICLE.P2")?></p>
            </section>

            <h2><?= translate("ABOUT.CONTACT")?></h2>
            <section id="contacts">
                <a href="mailto:contact@thophilelabs.com" class="btn pills"> <i class="fas fa-envelope"></i><?= translate("ABOUT.MAIL")?></a>
                <a href="https://www.linkedin.com/in/theophile-MONTEMONT" class="btn pills"> <i class="fab fa-linkedin"></i><?= translate("ABOUT.LINKEDIN")?></a>
                <a href="https://twitter.com/TheophileMNT" class="btn pills"> <i class="fab fa-twitter-square"></i><?= translate("ABOUT.TWITTER")?></a>
            </section>

        </article>
    
    
        <div id="downloadBox" class="col">
            <?php if(isset($lastModified) & isset($timezone)){?>
            <h2><?= translate("ABOUT.RESUME.HEADER")?></h2>
            <a href="/dl_cv" target="_blank" class="btn pills"><?= translate("ABOUT.RESUME.DL")?></a>
            <span><?= translate("ABOUT.RESUME.LASTUPLOAD")?> <?= $lastModified ?> (<?= translate("ABOUT.RESUME.TIMEZONE")?> <?= $timezone ?>) </span>

            <?php }else {?>
                <h2><?= translate("ABOUT.RESUME.NORESUME")?></h2>
            <?php } ?>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>