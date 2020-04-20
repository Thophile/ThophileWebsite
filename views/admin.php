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
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/navbar.html'?>
    </header>
    <main>
        <div id="menu">
            <div id="header">
                <div class="id">#</div>
                <div class="name">Name</div>
                <div class="action">Action</div>
            </div>
            <div id="body">
                <div class="bodyline">
                    <div class="id">1</div>
                    <div class="name">Lorem ipsum dolor sit amet</div>
                    <div class="action">
                        <a href="/project?id=1" class="btn"><i class="far fa-eye"></i></a>
                        <a href="/admin" class="btn"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <?php 
                foreach ($projects as $value) {
                ?>
                    <div class="bodyline">
                        <div class="id"><?=$value['id']?></div>
                        <div class="name"><?=$value['title']?></div>
                        <div class="action">
                            <a href="/project?id=<?=$value['id']?>" class="btn"><i class="far fa-eye"></i></a>
                            <a href="/admin?id=<?=$value['id']?>" class="btn"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                <?php
                    
                }
                ?>
            </div>
        </div>
        <div id="form">
            <?php if(isset($project)){     ?>
            <h1>Header</h1>
            <div id="head">
                <input type="text" name="title" placeholder="Project title">
                <input type="text" name="category" placeholder="Category">
                <input type="text" name="style" placeholder="Preview style">
            </div>
            <h1>Images</h1>
                <div id="_images">
                <img src="/assets/img/favicon.png" alt="">
                <img src="/assets/img/DeskApp.png" alt="">
                <button type="button" class="btn images_add" onclick="javascript:void(0)">
                    <i class="fas fa-2x fa-plus"></i>                        </button>
            </div>

            <h1>Links</h1>
            <div id="_links">
                <div>
                    <input type="text" size=1 placeholder="Name">
                        to : <input type="text" size=1 placeholder="Link">
                    <button type="button" class="btn link_remove">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <div>
                    <input type="text" size=1 placeholder="Name">
                    to : <input type="text" size=1 placeholder="Link">
                    <button type="button" class="btn link_remove">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <button type="button" class="btn links_add" onclick="javascript:void(0)">
                    <i class="fas fa-plus"></i> Add link
                </button>

            </div>

            <h1>Article</h1>
            <div id="_article">
                <div class="article_section">
                    <div class="article_title">
                        <input type="text" placeholder="Section title">
                        <button type="button" class="btn section_remove">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <div class="article_paragraphs">
                        <textarea></textarea>
                    </div>
                    <button type="button" class="btn paragraphs_remove">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn paragraphs_add" onclick="javascript:void(0)">
                        <i class="fas fa-plus"></i> Add paragraphs
                    </button>
                </div>
                <div class="article_section">
                    <div class="article_title"> 
                        <input type="text" placeholder="Section title">
                        <button type="button" class="btn section_remove">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <div class="article_paragraphs">
                        <textarea></textarea>
                        <textarea></textarea>
                    </div>
                    <button type="button" class="btn paragraphs_remove">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn paragraphs_add" onclick="javascript:void(0)">
                        <i class="fas fa-plus"></i> Add paragraphs
                    </button>
                </div>
                <button type="button" class="btn section_add">
                    <i class="fas fa-plus"></i> Add section
                </button>
            </div>        

            <div class="row" id="_submit">
                <button type="button" onclick="parseForm()">Save</button>
                <a href="/admin" class="btn">Cancel</a>
            </div>                    

            <?php }else {?>

            <a href="?id=0" class="btn" id="_new">Add project</a>

            <?php }?>    
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>
</html>