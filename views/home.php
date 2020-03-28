<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Thophile">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <title><?= $title ?></title>
</head>
<body>
    <header>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <section id="pres">
            Hello there, My name is Théophile but due to an encryption problem in my school's students list i have gotten the nickname thophile
            I'm an IT Student and this is my website
        </section>
        <section id="project">
            I do a lot of fun stuff and you can check them all <a href="/projects">here</a>
        </section>
        <section id="contact">
            You can contact me if you want some information about how my projects works or if you want to do business with me
            <a href="mailto:montemonttheophile@gmail.com?subject=Mail from our site">contact</a> 
        </section>
    </main>
    <footer>
        <div class="row">
            <div class="meta">
                Copyright
            </div>
            <div class="meta">
                Terms
            </div>
        </div>
    </footer>
</body>
</html>