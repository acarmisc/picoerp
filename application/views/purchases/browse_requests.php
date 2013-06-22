<?php
	$res = $purchases;
?>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('title')?></th>
			<th><?= lang('description')?></th>	
			<th><?= lang('order_date')?></th>	
			<th><?= lang('wf_step')?></th>						
			<th width="40"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $p):	?>
		<tr>
			<td>
				<input type="checkbox" id="purchase-sel-<?= $p->id ?>" />		
			</td>
			<td><?= $p->subject ?></td>
			<td><?= $p->description ?></td>			
			<td><?= date('d-m-Y H:i:s', $p->creation_date) ?></td>	
			<td><?= lang('l_'.$p->wf_step) ?></td>					
			<td>
				<?= anchor('purchases/delete_purchase_request/'.$p->id, '<i class="icon-trash"></i>', array('onclick' => "javascript:return confirm('Are you sure you want to delete it?')")) ?>
				<?= anchor('purchases/show_purchases_request/'.$p->id, '<i class="icon-eye-open"></i>') ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>