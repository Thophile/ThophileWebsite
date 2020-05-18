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
            <h1>About myself</h1>
        </div>
        <article>
            <h2>Studies</h2>
            <section id="studies">
                <p>I always wanted to be useful to society, my natural talent for logic led me to computer training after a "Scientific Baccalaureate"
                I think that IT has and will have a huge place in society as a tool to help everyone, facilitate any task and as an entertainment tool.
                With such a role, IT is a perfect choice to make the most of my abilities while doing something good to help people.</p>
            </section>

            <h2>Hobbies</h2>
            <section id="hobbies">
                <p>I like to do everything I can by myself.
                It all started when I was a first year elementary school student when I was first authorized to use a hacksaw. I have never stopped working on manual projects in my spare time since!

                I like to learn and I like useless or beautiful gadgets but I am not so rich so I cannot buy everything that I find fun or pretty.
                Most of the time, I end up watching tutorials and building them myself for a 10th of the price. Sometimes it costs me 10 times the price but I always end up learning something new and I have a lot of fun!
                </p>
            </section>

            <h2>Contact</h2>
            <section id="contacts">
                <a href="mailto:contact@thophilelabs.com" class="btn pills"> <i class="fas fa-envelope"></i> My mail</a>
                <a href="https://www.linkedin.com/in/theophile-MONTEMONT" class="btn pills"> <i class="fab fa-linkedin"></i> My LinkedIn</a>
                <a href="https://twitter.com/TheophileMNT" class="btn pills"> <i class="fab fa-twitter-square"></i> My twitter</a>
            </section>

        </article>
    
    
        <div id="downloadBox" class="col">
            <?php if(isset($lastModified) & isset($timezone)){?>
            <h2>Download my resume</h2>
            <a href="/dl_cv" target="_blank" class="btn pills">Download</a>
            <span>Last uploaded at : <?= $lastModified ?> (Timezone : GMT <?= $timezone ?>) </span>

            <?php }else {?>
                <h2>No resume available</h2>
            <?php } ?>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>