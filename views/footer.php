<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
?>
<div class="row">
    <div class="meta">
    <?= translate("FOOTER.MENTION") ?>
    </div>
    <div class="meta">
        <a href="/admin" aria-label="Administrate Website">
            <i class="fas fa-cog"></i>
        </a>
    </div>
</div>