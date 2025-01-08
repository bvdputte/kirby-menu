<?php if ((isset($id)) && ($context->$id()->exists())): ?>
	<div id="<?= $id ?>">
		<?php foreach ($context->$id()->toStructure() as $nav): ?>
			<nav id="<?= $id . "-" . Str::slug($nav->headline()) ?>">
				<h2><?= $nav->headline() ?></h2>
				<?php snippet("menu/render-menu", ["items" => $nav->items()->toStructure()]) ?>
			</nav>
		<?php endforeach ?>
	</div>
<?php endif ?>
