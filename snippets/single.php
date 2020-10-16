<?php if ((isset($id)) && ($site->$id()->exists())): ?>
    <nav id="<?= $id ?>">
        <?php snippet("menu/render-menu", ["items" => $site->$id()->toStructure()]) ?>
    </nav>
<?php endif ?>
