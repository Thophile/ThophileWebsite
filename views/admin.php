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
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/admin.js"></script>
    <title><?= $title ?></title>
</head>

<body id="admin">
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main>
        <div id="menu">
            <div id="header">
                <div class="id">#</div>
                <div class="name">Name</div>
                <div class="action">Action</div>
            </div>
            <div id="body">
                <?php 
                foreach ($projects as $line) {
                ?>

                <div class="bodyline">
                    <div class="id"><?=$line['id']?></div>
                    <div class="name"><?=$line['title']?></div>
                    <div class="action">
                        <a href="/project?id=<?=$line['id']?>" class="btn"><i class="far fa-eye"></i></a>
                        <a href="/admin?id=<?=$line['id']?>" class="btn"><i class="fas fa-edit"></i></a>
                        <a href="/delete?id=<?=$line['id']?>" class="btn to-validate"><i class="fas fa-trash"></i></a>
                    </div>
                </div>

                <?php 
                }
                ?>
            </div>
        </div>
        <div id="form">
            <?php if(isset($project)){ ?>
            <h1>Header</h1>
            <div id="_head">
                <input type="text" name="title" placeholder="Project title"
                    value="<?php if(isset($project["title"])) echo $project["title"]; ?>">
                <input type="text" name="category" placeholder="Category"
                    value="<?php if(isset($project["category"])) echo $project["category"] ?>">
                <input type="text" name="style" placeholder="Banner image"
                    value="<?php if(isset($project["banner_image"])) echo $project["banner_image"] ?>">
            </div>
            <h1>Images</h1>
            <div id="_image">

                <?php 
            if(isset($project["images"])){
                foreach (json_decode($project["images"]) as  $image) {  
            ?>

                <div class="image_preview">
                    <img src="/uploadFolder/<?= $image->filename?>" style="display: block;">
                    <i class="fas fa-6x fa-upload" style="display: none;"></i>
                    <input class="image_file" type="file">
                    <input type="text" placeholder="Label" value="<?= $image->label?>">
                    <i class="fas fa-minus"></i>
                </div>

                <?php 
                }
            } 
            ?>

                <button type="button" class="image_add">
                    <i class="fas fa-6x fa-plus"></i>
                </button>
            </div>

            <h1>Links</h1>
            <div id="_links">

                <?php
            if(isset($project["links"])){
                foreach (json_decode($project["links"]) as  $link) {  
            ?>

                <div>
                    <input type="text" size=1 placeholder="Name" value="<?= $link->title?>">
                    to : <input type="text" size=1 placeholder="Link" value="<?= $link->href?>">
                    <button type="button" class="btn link_remove">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <?php 
                }
            } 
            ?>

                <button type="button" class="btn link_add">
                    <i class="fas fa-plus"></i> Add link
                </button>
            </div>

            <h1>Article</h1>
            <div id="_article">

                <?php
            if(isset($project["article"])){
                foreach (json_decode($project["article"]) as  $section) {  
            ?>

                <div class="article_section">
                    <div class="article_title">
                        <input type="text" placeholder="Section title" value="<?= $section->title?>">
                        <button type="button" class="btn section_remove">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <div class="article_paragraphs">
                        <?php 
                        foreach ($section->paragraphs as $paragraph) {
                        ?>

                        <textarea><?= $paragraph?></textarea>

                        <?php 
                        } ?>
                    </div>
                    <div class="article_action">
                        <button type="button" class="btn paragraphs_remove">
                            <i class="fas fa-minus"></i> Remove paragraph
                        </button>
                        <button type="button" class="btn paragraphs_add">
                            <i class="fas fa-plus"></i> Add paragraph
                        </button>
                    </div>
                </div>

                <?php 
                }
            } 
            ?>

                <button type="button" class="btn section_add">
                    <i class="fas fa-plus"></i> Add section
                </button>
            </div>

            <div id="status"></div>
            <div class="row" id="_submit">
                <button type="button" onclick="parseForm()">Save</button>
                <a href="/admin" class="btn">Quit</a>
            </div>

            <?php }else {?>

            <a href="?id=0" class="btn" id="_new">Add project</a>

            <?php }?>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>