<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('title')?></th>
			<th><?= lang('description')?></th>
			<th><?= lang('project')?></th>
			<th><?= lang('project')?> title</th>			
			<th><?= lang('creation_date')?></th>	
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($ddts):
			foreach($ddts as $q):
			?>
		<tr>
			<td>
				<input type="checkbox" id="ddt-sel-<?= $q->id ?>" />		
			</td>
			<td><?= $q->title ?></td>
			<td><?= $q->description ?></td>
			<td><?= $q->project_name ?></td>
			<td><?= $q->project_title ?></td>
			<td><?= date('d-m-Y', $q->creation_date) ?></td>
			<td>
				<?= anchor('attachment/download/'.$q->id, '<i class="icon-eye-open"></i>') ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>
