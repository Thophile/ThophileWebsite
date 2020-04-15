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
                <a href="<?= $link->href ?>" class="btn"><?=$link->title?></a>';
            <?php    
                } 
            ?>
        </nav>
        <aside id="images">
            <?= $project['images']?>
            <img src="/assets/img/favicon.png" alt="favicon image" label="favicon">
            <img src="/assets/img/DeskApp.png" alt="deskapp image" label="deskapp c cool">
            <img src="/assets/img/favicon.png" alt="favicon image" label="favicon">
            <img src="/assets/img/DeskApp.png" alt="deskapp image" label="deskapp c cool">
            <img src="/assets/img/favicon.png" alt="favicon image" label="favicon">
                <div class="banner">
                    <div class="col right">
                        <i class="fas fa-2x fa-chevron-left" onclick="previousImage()"></i>
                    </div>
                    <div class="col">
                        <div class="dots_group">
                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>
                        </div>
                        <label id="img_label">bla bla on the image</label>
                    </div>
                    <div class="col">
                        <i class="fas fa-2x fa-chevron-right" onclick="nextImage()"></i>
                    </div>
                </div>
            </div>
        </aside>
        <article>
            <?= $project['article']?>
            <section>
                <h1>Section</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                </p>
            </section>
            <section>
                <h1>Section with 5</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!
                </p>
            </section>
            <section>
                <h1>Section with 10 lines</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!
                </p>
            </section>
            <section>
                <h1>Section with 15 lines of lorem ipsum text to test for layout with big tests</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!

                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!

                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Non autem consequuntur accusantium, unde ratione perspiciatis doloribus repudiandae atque voluptatum ut illum velit pariatur accusamus ipsa labore, itaque eligendi, voluptas eum?
                    Officia commodi voluptates voluptatibus? Aspernatur recusandae, nobis iusto placeat, tempora dolor distinctio consequatur veniam fugiat, ipsa nulla neque quod illum! Totam laudantium nostrum, possimus voluptatum officia harum incidunt unde veniam!
                    Odio aut enim qui, quod fugit tempore maxime exercitationem ut quia laudantium adipisci mollitia sapiente obcaecati reiciendis praesentium aperiam excepturi dicta nesciunt veniam illum earum in nemo et cupiditate. Reprehenderit.
                    Doloribus error, odio accusantium iure nam vitae neque maxime aliquid architecto ab at iusto, dignissimos explicabo dolorem rem et! Iusto facere sunt, sed itaque sit id laboriosam consequatur ipsum alias.
                    Inventore architecto amet commodi tempora illo quo dolor iusto laudantium libero ipsum. Officia, accusamus! Eligendi ipsam excepturi debitis aperiam! Molestiae atque ducimus placeat illum quod qui odio perspiciatis? Nobis, voluptatibus!
                </p>
            </section>
        </article>
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