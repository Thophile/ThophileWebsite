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
    <meta name="description" content="This is a reserved page">
    <meta name ="keywords" content="project, theophile, théophile, thophile, montemont, montémont, resume, it">
    <meta name="robots" content="noindex">
    <link rel="canonical" href="https://thophilelabs.com/admin">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/admin.js"></script>
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.php'?>
    </header>
    <main class="col">
        <div id="tabs">
            <button data-target="#projectManager">Projects manager</button>
            <button data-target="#statistics">Statistics</button>
            <button data-target="#cvuploader">CV Uploader</button>
        </div>
        <div id="tabs_header">
            <h1>
            </h1>
        </div>
        <div id="projectManager" data-type="content">
            <div id="menu" class="col">
                
                <div id="header" class="row">
                    <div class="id">#</div>
                    <div class="name">Name</div>
                    <div class="action">Action</div>
                </div>
                <div id="body" class="col">
                    <?php 
                    foreach ($projects as $line) {
                    ?>

                    <div class="bodyline row">
                        <div class="id"><?=$line['ID']?></div>
                        <div class="name"><?=translate($line['TITLE'])?></div>
                        <div class="action">
                            <a href="/project?id=<?=$line['ID']?>" class="btn" target="_blank"><i class="far fa-eye"></i></a>
                            <a href="/admin?id=<?=$line['ID']?>" class="btn"><i class="fas fa-edit"></i></a>
                            <a href="/delete?id=<?=$line['ID']?>" class="btn to-validate"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>

                    <?php 
                    }
                    ?>
                </div>
            </div>
            <div id="form" class="col">

                <?php if(isset($project)){ ?>
                <div id="_head" class="col">
                        <h1>Header</h1>
                    <input type="text" name="title" placeholder="Project title"
                        value="<?php if(isset($project["TITLE"])) echo translate($project["TITLE"]); ?>">
                    <input type="text" name="category" placeholder="Category"
                        value="<?php if(isset($project["CATEGORY"])) echo translate($project["CATEGORY"]) ?>">
                    <input type="text" name="style" placeholder="Banner image"
                        value="<?php if(isset($project["BANNER_IMAGE"])) echo translate($project["BANNER_IMAGE"]) ?>">
                </div>

                <div id="_image" class="col">
                    <h1>Images</h1>
                    <div class="preview_row row">

                        <?php 
                        if(isset($project["IMAGES"])){
                            foreach ($project["IMAGES"] as  $image) {
                        ?>

                        <div class="image_preview">
                            <img src="/publicFolder/<?= translate($image["FILENAME"])?>" style="display: block;">
                            <i class="fas fa-6x fa-upload" style="display: none;"></i>
                            <input class="image_file" type="file">
                            <input type="text" placeholder="Label" value="<?= translate($image["LABEL"])?>">
                            <i class="fas fa-minus"></i>
                        </div>

                        <?php }} ?>

                    </div>
                    <button type="button" class="pills image_add">
                        <i class="fas fa-plus"></i>Add an Image
                    </button>
                </div>

                <div id="_links" class="col">
                    <h1>Links</h1>

                    <?php
                if(isset($project["LINKS"])){
                    foreach ($project["LINKS"] as  $link) { 
                ?>

                    <div>
                        <input type="text" size=1 placeholder="Name" value="<?= translate($link["TITLE"])?>">
                        to : <input type="text" size=1 placeholder="Link" value="<?= translate($link["HREF"])?>">
                        <button type="button" class="btn link_remove">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>

                    <?php 
                    }
                } 
                ?>

                    <button type="button" class="btn pills link_add">
                        <i class="fas fa-plus"></i> Add a link
                    </button>
                </div>

                <div id="_article" class="col">
                    <h1>Article</h1>

                    <?php
                if(isset($project["ARTICLE"])){
                    foreach ($project["ARTICLE"] as  $section) {  
                ?>

                    <div class="article_section col">
                        <div class="article_title">
                            <input type="text" placeholder="Section title" value="<?= translate($section["TITLE"])?>">
                            <button type="button" class="btn section_remove">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="article_paragraphs col">
                            <?php 
                            foreach ($section["PARAGRAPHS"] as $paragraph) {
                            ?>

                            <textarea><?= translate($paragraph)?></textarea>

                            <?php 
                            } ?>
                        </div>
                        <div class="row">
                            <button type="button" class="btn pills paragraphs_remove">
                                <i class="fas fa-minus"></i> Remove a paragraph
                            </button>
                            <button type="button" class="btn pills paragraphs_add">
                                <i class="fas fa-plus"></i> Add a paragraph
                            </button>
                        </div>
                    </div>

                    <?php 
                    }
                } 
                ?>

                    <button type="button" class="btn pills section_add">
                        <i class="fas fa-plus"></i> Add section
                    </button>
                </div>

                <div class="row" id="_submit">
                    <div id="status"></div>
                    <a href="/admin" class="btn pills">Quit</a>
                    <a href="javascript:void(0)" class="btn pills" onclick="parseForm()">Save</a>
                </div>

                <?php }else {?>

                <a href="?new=true" class="btn pills" id="_new">Add project</a>

                <?php }?>
            </div>
        </div>
        <div id="statistics" data-type="content">
            <div class="col">
                <?php 
                usort($statistics, function($a, $b){return $b["views"] - $a["views"];});
                foreach ($statistics as $route) {
                    if(preg_match('{/project [0-9]+}', $route['page'])){
                        $p_id = explode(" ", $route['page'])[1];
                        $p_key = array_search($p_id, array_column($projects, 'id'));
                        $route['page'] = "/project \"" . $projects[$p_key]['title'] . "\"";
                    }

                    if($route['referer'] != []){
                    
                        $referer = json_decode($route['referer']);
                        usort($referer, function($a,$b){
                            //sort referer by descendant orders
                            return explode(" ", $b)[1] - explode(" ", $a)[1];
                        });
                    }

                    if($route['ip_adress'] != []){
                        $ip_adress = json_decode($route['ip_adress']);
                        usort($ip_adress, function($a,$b){
                            //sort referer by descendant orders
                            return explode(" ", $b)[1] - explode(" ", $a)[1];
                        });

                    }?>

                <div class="page_stats">
                    <h1>
                        Route : 
                        <?= $route['page'] ?>
                    </h1>
                    <samp class="subtitle">
                        Total hits : <?= $route['views'] ?> , with <?= sizeof($ip_adress) ?> unique client
                    </samp>
                    <div>
                        <samp>
                            Best client : <?= $ip_adress == [] ? "none" : explode(" ", $ip_adress[0])[0] ?> , with <?= $ip_adress == [] ? "0" : explode(" ", $ip_adress[0])[1] ?> hits
                        </samp>
                        <samp>
                            Best referer : <a href="<?= $referer == [] ? "" : explode(" ", $referer[0])[0] ?>"><?= $referer == [] ? "none" : explode(" ", $referer[0])[0] ?></a> , with <?= $referer == [] ? "0" : explode(" ", $referer[0])[1] ?> hits
                        </samp> 
                    </div>
                </div>

                <?php } ?>
            </div>
        </div>
        <div id="cvuploader" data-type="content" >
            <div class="col">
                <h2>
                    Please choose a resume in your files
                </h2>
                <?php if(isset($lastModified) & isset($timezone)){ ?>
                    <span>Last uploaded at : <?= $lastModified ?> (Timezone : GMT <?= $timezone ?>) </span>
                <?php }else{ ?>
                    <span>No resume uploaded</span>
                <?php } ?>
                <i class="fas fa-6x fa-upload"></i>
                <input type="file" name="cv">
                <button class="pills">Upload</button>
            </div>
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.php'?>
    </footer>
</body>

</html>