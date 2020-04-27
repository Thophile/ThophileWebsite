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
    <link rel="stylesheet" href="/assets/css/projects.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/projects.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <section id="projects" class="section-row">
            <div class="col-70">
                <h1>
                    Here you can see my projects
                </h1>
                <form action="javascript:void(0)">
                    <button onclick="showAll()">All</button>
                    <button onclick="showDev()">Developpement</button>
                    <button onclick="showNet()">Network</button>
                    <button onclick="showOth()">Other</button>
                </form>
            </div>
            <div class="col-30">

            </div>
        </section>

        <?php foreach ($projects as $project) { ?>
        <section class="section-row projects <?= $project['category']?>"
            style="background-image: linear-gradient(80deg, rgba(50, 50, 50, 0.80) 55%, #dee1e9 100%), url(/uploadFolder/<?= rawurlencode($project['banner_image'])?>);">
            <div class="col-70">
                <h1>
                    <?= $project['title']?>
                </h1>
                <h2>
                    in category <?= $project['category']?>
                </h2>
            </div>
            <div class="col-30">
                <a href="/project?id=<?= $project['id']?>" class="btn">
                    See more
                </a>
            </div>
        </section>
        <?php } ?>
        
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>