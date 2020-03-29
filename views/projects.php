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
        <section id="projects" class="section-row">
            <div class="col-70">
                <h1>
                    Here you can see my projects
                </h1>
                <form action="javascript:void(0)">
                    <button>All</button>
                    <button>Developpement</button>
                    <button>Network</button>
                    <button>Other</button>
                </form>
            </div>
            <div class="col-30">
                   
            </div>
        </section>
        <!-- php generated part -->
        <section class="section-row projects deskapp developpement">
        <div class="col-70">
                <h1>
                    Electron application "Deskapp"
                </h1>
                <h2>
                    in category Developpement
                </h2>
            </div>
            <div class="col-30">
                <a>
                    See more
                </a>
            </div>
            </div>
        </section>
        <section class="section-row projects other">
            <div class="col-70">
                <h1>
                    Classic car restoration
                </h1>
                <h2>
                    in category Other
                </h2>
            </div>
            <div class="col-30">
                <a>
                    See more
                </a>
            </div>
        </section>
        <section class="section-row projects network">
            <div class="col-70">
                <h1>
                    Project network title
                </h1>
                <h2>
                    in category x
                </h2>
            </div>
            <div class="col-30">
                <a>
                    See more
                </a>
            </div>
        </section>        
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