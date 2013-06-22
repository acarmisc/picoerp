<?php if(sizeof($items) == 0): echo 'no items.'; endif; ?>
<?php foreach($items as $i): ?>

	<div class="agile_list_item">
		<div class="agile_list_actions pull-right">
			<span href="#" class="add-el-to-purchase-request" name="<?= $i->id ?>"><i class="icon-share" rel="tooltip" title="Add to purchase order"></i></span>
		</div>
		<div class="agile_list_title"><?= $i->code ?> <?= $i->item ?></div>
		<div class="agile_list_data">
			<div><b>Qty:</b> <?= $i->qty ?></div>
			<div><b>Budget:</b> <?= $i->price_budget ?> <?= $i->currency ?></div>
		</div>
	</div>

<?php endforeach; ?>
