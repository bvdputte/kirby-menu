<?php if (isset($items)): ?>
    <?php if ($items->isNotEmpty()): ?>
        <ul>
            <?php foreach ($items as $menuItem): ?>
                <?php $linkItem = $menuItem->item()->toLinkObject() ?>
                    <?php if($linkItem): // No-longer-existing pages become `null` when updated ?>
                        <?php if($linkItem->type() === "page"): ?>
                            <?php if(page($linkItem->value())): ?>
                                <li>
                                    <?= $linkItem->tag(["class" => "someClass"]) ?>
                                </li>
                            <?php endif ?>
                        <?php else: ?>
                            <li><?= $linkItem->tag() ?></li>
                        <?php endif ?>
                    <?php endif ?>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
<?php endif ?>
