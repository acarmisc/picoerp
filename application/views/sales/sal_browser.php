<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
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
			if($sals):
			foreach($sals as $q):
			?>
		<tr>
			<td class="edit-in-row" name="<?= $q->id ?>" rel="attachments" data-fieldname="title">
				<?= $q->title ?>
			</td>
			<td  class="edit-in-row" name="<?= $q->id ?>" rel="attachments" data-fieldname="description"><?= $q->description ?></td>
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
