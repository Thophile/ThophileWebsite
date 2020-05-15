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
                <p>
                I have always wanted to be useful to the society, my natural talent for logics oriented me to an IT formation after a "scientific Baccalauréat" 
                I think IT have and will have a huge place in the society as a tool to help everyone and make any task easier and as an entertainment tool too.
                With so said roll IT is a perfect choice to use the most of my capacity while doing something good for helping people</p>
            </section>

            <h2>Hobbies</h2>
            <section id="hobbies">
                <p>
                I like to do the most I can by myself.
                It all started when I was a first year primary student when was authorized for the first time to use an axe saw and I never stopped working on manual project during my free time since ! 
                
                I like to learn and I like useless or beautifull gadget but i'm not that rich so I can't buy all the thing I find fun or pretty. 
                Most of the time I end up watching tutorials and building them myself for a 10th of the price. Sometimes it cost me 10 times the price but I always end up learning something new and having a lot of fun !
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
            <h1>Download my resume</h1>
            <a href="/dl_cv" target="_blank" class="btn pills">Download</a>
            <span>Last uploaded at : <?= $lastModified ?> (Timezone : GMT <?= $timezone ?>) </span>

            <?php }else {?>
                <h1>No resume available</h1>
            <?php } ?>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>