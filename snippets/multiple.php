<?php if ((isset($id)) && ($site->$id()->exists())): ?>
    <div id="<?= $id ?>">
        <?php foreach($site->$id()->toStructure() as $nav): ?>
            <nav id="<?= $id . "-" . str::slug($nav->headline()) ?>">
                <h2><?= $nav->headline() ?></h2>
                <?php snippet("menu/render-menu", ["items" => $nav->items()->toStructure()]) ?>
            </nav>
        <?php endforeach ?>
    </div>
<?php endif ?>
