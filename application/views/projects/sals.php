<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th><?= lang('type')?></th>
			<th><?= lang('title')?></th>
			<th><?= lang('project')?></th>	
			<th><?= lang('description')?></th>
			<th><?= lang('creation_date')?></th>
			<th><?= lang('update_date')?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($sals):
			foreach($sals as $s):
		 ?>
		<tr class="row-<?= $s->scope_id ?>">
			<td><?= $s->label ?></td>
			<td><?= $s->title ?></td>
			<td><?= $s->project_title ?> <?= $s->number ?></td>
			<td><?= $s->description ?></td>			
			<td><?= date('d-m-Y',$s->creation_date) ?></td>
			<td><?= date('d-m-Y',$s->update_date) ?></td>			
			<td>
				<?= anchor('/attachment/download/'.$p->id, '<i class="icon-download"></i>') ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>