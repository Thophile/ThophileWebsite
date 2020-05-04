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
    <link rel="stylesheet" href="/assets/css/about.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <div id="header" class="col">
            <h1>About myself</h1>
        </div>
        <article>
            <section id="studies">
                <h2>Studies</h2>
                <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate nulla ipsum dolore pariatur maxime distinctio, ut praesentium repellendus blanditiis facere laborum dolores rem beatae veniam, aperiam eveniet corporis? Beatae, nesciunt.
                Voluptatibus dolore eius quidem beatae dolores qui adipisci blanditiis quas, a ex quasi. Minima modi a dicta, ullam ab voluptatibus debitis eum possimus veniam id eveniet, recusandae, dolor aut nostrum?
                Deserunt nisi cupiditate odit quibusdam rem officiis, ea repellat illo doloribus, quo obcaecati aliquam aperiam labore, magni accusamus vitae? Maxime nihil ullam animi iste. Ratione iste eos reiciendis optio dolorem.
                Consectetur aliquam facere quidem quaerat officiis molestias autem, earum excepturi minima ut perspiciatis corporis dolores aliquid saepe a sit perferendis odit. Eveniet soluta velit culpa maiores corporis, saepe temporibus quod?
                </p>
            </section>

            <section id="hobbies">
                <h2>Hobbies</h2>
                <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus sit amet assumenda tenetur velit vel consectetur maiores earum? Sed ut ipsum delectus animi! Assumenda, perferendis officia? Magnam architecto inventore maiores!
                Commodi minus, dolore hic numquam dicta fuga libero ratione maxime illum dolores et porro odit, distinctio, ea debitis saepe perferendis? Facere inventore, recusandae illo incidunt maxime veritatis molestias deserunt vitae.
                Laboriosam enim recusandae, commodi eaque molestias modi eligendi cumque omnis assumenda vitae ratione veritatis, cum fugiat unde laborum. Quod quas voluptatibus dicta tenetur qui vel a maiores obcaecati. Doloremque, incidunt.
                Magnam, nihil assumenda porro illo enim labore necessitatibus, nulla distinctio libero ipsum, nostrum ut aspernatur odio architecto iusto! Eligendi delectus, accusamus odit distinctio sed vitae soluta doloremque ratione voluptatum expedita?
                </p>
            </section>

                <a href="mailto:" class="btn pills">Contact me</a>

        </article>
    
    
        <div id="downloadBox" class="col">
            <h1>Download my CV</h1>
            <a href="/dl_cv" target="_blank" class="btn pills">Download</a>
            <span>Last uploaded at : <?= $lastModified ?> (Timezone : GMT <?= $timezone ?>) </span>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>