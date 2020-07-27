<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
?>
<nav id="navbar">
    <button id="nav-toggle" onclick="toggleNav()">
        <i class="fas fa-2x fa-bars"></i>
    </button>
    <img src="/assets/img/favicon.png" alt="logo" class="logo">
    <div class="label">
        <a href="/" class="nav-link"><?= translate("NAV.HOME")?></a>
        <a href="/projects" class="nav-link"><?= translate("NAV.PROJECTS")?></a>
        <a href="/about" class="nav-link"><?= translate("NAV.ABOUT")?></a>
        <div id="lang-toggle">
            <i class="fas fa-language"></i>
            <div id="lang-list">
                <a href="#" data-lang="fr" data-selected="<?= isset($_COOKIE["locale"]) && $_COOKIE["locale"] ==  "fr" ? "true" : "false" ?>">FR</a>
                <a href="#" data-lang="en" data-selected="<?= isset($_COOKIE["locale"]) && $_COOKIE["locale"] ==  "en" ? "true" : "false" ?>">EN</a>
            </div>
        </div>
        
    </div>
</nav>
<nav id="side-nav">
    <ul>
        <li><a href="/" class="nav-link"><?= translate("NAV.HOME")?></a></li>
        <li><a href="/projects" class="nav-link"><?= translate("NAV.PROJECTS")?></a></li>
        <li><a href="/about" class="nav-link"><?= translate("NAV.ABOUT")?></a></li>
    </ul>
</nav>