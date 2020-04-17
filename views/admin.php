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
                        <a href="" class="btn"><i class="fas fa-edit"></i></a>
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
        <?php 
        if(isset($project)){
            

                
        ?>
        
        <div>
        <?= isset($project['id']) ? "you're editing project n°{$project['id']} named {$project['title']}" : "You're making a new project"?> 
        </div>

        <?php
        }else {
            
        ?>
            <a href="?id=0" class="btn">New</a>
        <?php   
        }
        ?>    
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>
</html>