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
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
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
        <!-- php generated part -->
        <?php foreach ($projects as $project) { ?>
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
                <a href="/project?id=<?= $project['id']?>" class="btn">
                    See more
                </a>
            </div>
        </section>
        <?php } ?>     
        <!-- end of php generated prts -->
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