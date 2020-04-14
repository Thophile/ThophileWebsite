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
    <script src="/assets/js/project.js"></script>
    <title><?= $title ?></title>
</head>
<body>
    <header>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <section class="section-row projects <?= $project['category']?>" style="<?= $project['preview_style']?> display:flex;">
            <div class="col-70">
                <h1>
                    <?= $project['h1']?>
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