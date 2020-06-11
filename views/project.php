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
    <meta name="description" content="Check the infos on <?= $project['title']?> from category <?= $project['category']?>">
    <meta name ="keywords" content="project, <?= $project['title']?>, theophile, théophile, thophile, montemont, montémont, resume, it">
    <meta name="robots" content="follow">

    <!-- Twitter card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $project['title']?> from ThophileLabs.com">
    <meta name="twitter:image" content="https://thophilelabs.com/publicFolder/<?= $project['banner_image']?>">
    <meta property="og:title" content="<?= $project['title']?> from ThophileLabs.com" />
    <meta property="og:image" content="https://thophilelabs.com/publicFolder/<?= $project['banner_image']?>" />
    <meta property="og:url" content="https://thophilelabs.com/project?id=<?= $project['id']?>" />
    <meta property="og:type" content="article" />
    <meta property="og:description" content="Access the infos you need about <?= $project['title']?> , useful links, images, and the project full description" />

    <link rel="canonical" href="https://thophilelabs.com/project?id=<?= $project['id']?>">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/project.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/project.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <section class="header">
            <h1>
                <?= $project['title']?>
            </h1>
            <h2>
                Category <?= $project['category']?>
            </h2>
        </section>
        <nav id="links" class="row">
            <?php
                foreach ($project['links'] as $link) { 
            ?>
            <a href="<?= $link->href ?>" rel="nofollow" class="btn"><?=$link->title?></a>
            <?php 
                } 
            ?>
        </nav>

        <aside class="merry-go">
            
            <?php
            foreach ($project['images'] as $image) { 
            ?>
            <img src="/publicFolder/<?= $image->filename ?>" alt="<?=$image->label?>"
                data-label="<?=$image->label?>">
            <?php 
            } 
            ?>

            <div id="modal">
                <i class="far fa-2x fa-times-circle"></i>
                <img id="modalImg">
            </div>
            
            <div class="left">
                <i class="fas fa-2x fa-chevron-left" onclick="previousImage()"></i>
            </div>
            <div class="middle">
                <label></label>
                <div class="dots_group">  
                    <?php
                        for ($i=0; $i < count($project['images']); $i++) { 
                            echo '<span onclick="displayImage('.$i.')"></span>';
                        }
                    ?>
                </div>                
            </div>
            <div class="right">
                <i class="fas fa-2x fa-chevron-right" onclick="nextImage()"></i>
            </div>
        </aside>

        <article>
            <?php
            foreach ($project['article'] as $section) { 
            ?>
            <section>
                <h1><?=$section->title?></h1>
                <?php
                    foreach ($section->paragraphs as $paragraph) {
                    ?>
                <p>        <?=$paragraph?></p>
                <?php
                    }
                    ?>
            </section>
            <?php  
            } 
            ?>
        </article>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>