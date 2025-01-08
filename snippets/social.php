<?php
$socialNetworks = [
	"facebook" => "facebook",
	"twitter" => "x-twitter",
	"instagram" => "instagram",
	"flickr" => "flickr",
	"youtube" => "youtube",
	"linkedin" => "linkedin",
	"pinterest" => "pinterest",
	"tiktok" => "tiktok"
];
?>

<nav id="socialmenu">
    <ul>
        <?php foreach($socialNetworks as $field => $icon): ?>
            <?php if(($site->$field()->exists()) && ($site->$field()->isNotEmpty())): ?>
                <li>
                    <a href="<?= $site->$field()->value() ?>">
                        <i class="icon icon--<?= $icon ?>"></i> <?= str::ucfirst($field) ?>
                    </a>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</nav>
