<?php
    if(!defined('Router')) {
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
    <link rel="stylesheet" href="/assets/css/project.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/project.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <section class="section-row overview">
            <div class="col-70">
                <h1>
                    <?= $project['title']?>
                </h1>
                <h2>
                    in category <?= $project['category']?>
                </h2>
            </div>
            <div class="col-30">
                <a href="/projects" class="btn">
                    Back to all projects
                </a>
            </div>
        </section>
        <nav id="links" class="row">
            <?php
                foreach (json_decode($project['links']) as $link) { 
            ?>
            <a href="<?= $link->href ?>" class="btn"><?=$link->title?></a>
            <?php 
                } 
            ?>
        </nav>
        <aside id="images">
            <div class="banner">
                <div class="col right">
                    <i class="fas fa-2x fa-chevron-left" onclick="previousImage()"></i>
                </div>
                <div class="col">
                    <label id="img_label"></label>
                    <div class="dots_group">
                        <?php
                        for ($i=0; $i < count(json_decode($project['images'])); $i++) { 
                            echo '<span class="dots" onclick="displayImage('.$i.')"></span>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col">
                    <i class="fas fa-2x fa-chevron-right" onclick="nextImage()"></i>
                </div>
            </div>
            <?php
            foreach (json_decode($project['images']) as $image) { 
            ?>
            <img src="/uploadFolder/<?= $image->filename ?>" class="merry" alt="Image <?=$image->label?>"
                label="<?=$image->label?>">
            <?php 
            } 
            ?>
            <div id="modal">
                <i class="far fa-2x fa-times-circle"></i>
                <img id="modalImg">
            </div>
        </aside>
        <article>
            <?php
            foreach (json_decode($project['article']) as $section) { 
            ?>
            <section>
                <h1><?=$section->title?></h1>
                <?php
                    foreach ($section->paragraphs as $paragraph) {
                    ?>
                <p><?=$paragraph?></p>
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
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>

</html>