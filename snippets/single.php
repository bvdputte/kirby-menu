<?php if ((isset($id)) && ($context->$id()->exists())): ?>
    <nav id="<?= $id ?>">
        <?php snippet("menu/render-menu", ["items" => $context->$id()->toStructure()]) ?>
    </nav>
<?php endif ?>
