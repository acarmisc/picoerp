<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>
			<th><?= lang('brand')?></th>
			<th><?= lang('unit')?></th>
			<th><?= lang('creation_date')?></th>			
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($products):
			foreach($products as $q): ?>
		<tr id="pr-<?= $q->id ?>" class="<?= $q->status ?>-row">
			<td>
			<?php if(!isset($append_to)): ?>
				<input type="checkbox" id="product-sel-<?= $q->id ?>" />		
			<?php endif; ?>
			</td>
			<td>
			<?php if(!isset($append_to)): ?>
				<?= anchor('sales/show_product/'.$q->id, $q->name) ?>
			<?php else: ?>
				 <?= $q->name ?>
			<?php endif; ?>
			</td>
			<td><?= $q->brand ?></td>
			<td><?= $q->unit ?></td>			
			<td><?= date('d-m-Y', $q->creation_date) ?><br />
			<small><?= date('d-m-Y H:i:s', $q->update_date) ?></small></td>			
			<td>
				<?php if(!isset($append_to)): ?>
					<a name="<?= $q->id ?>" data-toggle="modal" href="#myModal" id="edit-product"><i class="icon-eye-open"></i></a>
					<a name="<?= $q->id ?>" href="#" class="delete-product cmd-delete" id="product-<?= $q->id ?>"><i class="icon-trash"></i></a>
				<?php else: ?>
					<a href="#" class="append-product cmd-append" id="product-<?= $q->id ?>"><i class="icon-share"></i></a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>