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
        <section class="header">
            <h1>
                Here you can see my projects
            </h1>
             <form action="javascript:void(0)">
                <button onclick="showAll()">All</button>
                <button onclick="showDev()">Developpement</button>
                <button onclick="showNet()">Network</button>
                <button onclick="showOth()">Other</button>
            </form>
        </section>

        <?php foreach ($projects as $project) { ?>

        <section class="projects" data-category="<?= $project['category']?>" onclick="window.location='/project?id=<?= $project['id']?>'"
            style="background-image: url(/uploadFolder/<?= rawurlencode($project['banner_image'])?>);">

            <h1>
                <?= $project['title']?>
            </h1>
            <h2>
                Category <br>
                "<?= $project['category']?>"
            </h2>

        </section>

        <?php } ?>
        
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>