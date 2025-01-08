<?php if (isset($items)): ?>
	<?php if ($items->isNotEmpty()): ?>
		<ul>
			<?php foreach ($items as $menuItem): ?>
				<?php $linkItem = $menuItem->item()->toLinkObject() ?>
				<?php if ($linkItem): ?>
					<li><?= $linkItem ?></li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	<?php endif ?>
<?php endif ?>
