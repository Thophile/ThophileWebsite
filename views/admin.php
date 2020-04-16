<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="Thophile">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
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
            <table id="projects">
                <tr> 
                    <th class="table_id"><div>#</div> 
                    <th class="table_title"><div>Name</div>
                    <th class="table_action"><div>Action</div>
                <tr>
                    <td class="table_id">1
                    <td class="table_title">bar 
                    <td class="table_action"> 
                        <button class="btn"><i class="far fa-eye"></i></button>
                        <button class="btn"><i class="fas fa-edit"></i></button>
                        <button class="btn"><i class="fas fa-trash"></i></button>
                <tr>
                    <td class="table_id">1
                    <td class="table_title">bar 
                    <td class="table_action">
                        <button class="btn"><i class="far fa-eye"></i></button>
                        <button class="btn"><i class="fas fa-edit"></i></button>
                        <button class="btn"><i class="fas fa-trash"></i></button>
                <tr>
                    <td class="table_id">1
                    <td class="table_title">bar
                    <td class="table_action">
                        <button class="btn"><i class="far fa-eye"></i></button>
                        <button class="btn"><i class="fas fa-edit"></i></button>
                        <button class="btn"><i class="fas fa-trash"></i></button>
                <tr>
                    <td class="table_id">1
                    <td class="table_title">bar 
                    <td class="table_action">
                        <button class="btn"><i class="far fa-eye"></i></button>
                        <button class="btn"><i class="fas fa-edit"></i></button>
                        <button class="btn"><i class="fas fa-trash"></i></button>
            </table>
        </div>
        <div>
            
        </div>
    </main>
    <footer>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/views/footer.html'?>
    </footer>
</body>
</html>