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
        <a href="/" class="nav-link">Home </a>
        <a href="/projects" class="nav-link">Projects </a>
        <a href="/about" class="nav-link">About </a>
    </div>
</nav>
<nav id="side-nav">
    <ul>
        <li><a href="/" class="nav-link">Home</a></li>
        <li><a href="/projects" class="nav-link">Projects</a></li>
        <li><a href="/about" class="nav-link">About</a></li>
    </ul>
</nav>