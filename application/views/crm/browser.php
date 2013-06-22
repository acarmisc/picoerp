<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="90px"></th>
			<th><?= lang('name')?></th>
			<th><?= lang('creation_date')?></th>	
			<th><?= lang('update_date')?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($partners):
			foreach($partners as $p): ?>
		<tr>
			<td>
				<input type="checkbox" id="partner-sel-<?= $p->id ?>" />
				<?php if($p->customer == 1): echo '<span class="badge badge-info">'.lang('C').'</span>'; endif; ?>
				<?php if($p->supplier == 1): echo '<span class="badge badge-warning">'.lang('S').'</span>'; endif; ?>				
			</td>
			<td><?= anchor('crm/show_partner/'.$p->id, $p->name) ?></td>
			<td><?= date('d-m-Y', $p->creation_date) ?></td>
			<td><?= date('d-m-Y', $p->update_date) ?></td>			
			<td>
				<?= anchor('crm/show_partner/'.$p->id, '<i class="icon-eye-open"></i>') ?>
				<a rel="tooltip" title="delete partner" data-toggle="modal" href="#myModal" id="partner_delete" name="<?= $p->id ?>"><i class="icon-trash"></i></a>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>
