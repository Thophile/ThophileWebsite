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
    <meta name="description" content="View a list of all of my projects here, sorted by their category">
    <meta name ="keywords" content="project, theophile, théophile, thophile, montemont, montémont, resume, it">
    <meta name="robots" content="follow">
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
                <button onclick="showAll()" class="pills inverted">All</button>
                <button onclick="showDev()" class="pills inverted">Developpement</button>
                <button onclick="showNet()" class="pills inverted">Network</button>
                <button onclick="showOth()" class="pills inverted">Other</button>
            </form>
        </section>

        <?php if(empty($projects)){ ?>
            <section class="projects empty" >
            <h1>
                No available project
            </h1>
            </section>
        <?php } ?>
        <?php foreach ($projects as $project) { ?>

        <section class="projects" data-category="<?= $project['category']?>"
        <?php if($project['banner_image'] != ""){?>style="background-image: url(/publicFolder/<?= rawurlencode($project['banner_image'])?>);" <?php } ?>>
            <a href="/project?id=<?= $project['id']?>" aria-label="Link to project <?= $project['id']?>"></a>

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