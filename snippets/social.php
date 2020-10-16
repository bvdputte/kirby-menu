<?php
    $socialNetworks = ["facebook", "twitter", "instagram", "flickr", "youtube", "linkedin"];
?>

<nav id="socialmenu">
    <ul>
        <?php foreach($socialNetworks as $item): ?>
            <?php if(($site->$item()->exists()) && ($site->$item()->isNotEmpty())): ?>
                <li>
                    <a href="<?= $site->$item()->value() ?>">
                        <i class="icon icon--<?= $item ?>"></i> <?= str::ucfirst($item) ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</nav>
