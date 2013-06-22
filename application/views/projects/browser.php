<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="70px"></th>
			<th><a href="?reorder_by=title"><?= lang('title')?></a></th>
			<th><a href="?reorder_by=partner"><?= lang('customer')?></a></th>	
			<th><?= lang('estimated_close_date')?></th>
			<th><a href="?reorder_by=wf_step"><?= lang('workflow')?></a></th>
			<th><a href="?reorder_by=type"><?= lang('type')?></a></th>
			<th><?= lang('progress')?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($projects):
			foreach($projects as $p):
		 ?>
		<tr class="row-<?= $p->type ?> row-<?php if(project_progress($p->id) >= 100){ echo 'full'; } ?>">
			<td>
<!-- 				<input type="checkbox" id="project-sel-<?= $p->id ?>" /> -->
				<?= img('assets/img/avatar/'.$p->userfile) ?>	
			</td>
			<td><?= anchor('projects/show_project/'.$p->id, mb_strimwidth($p->title,0,30,'...')) ?><br />
			<span class="second-row"><?= $p->name ?> <?= date('d-m-Y', $p->creation_date) ?></span>
			</td>
			<td><?= mb_strimwidth($p->partner,0,25,'...') ?><br />
			<span class="second-row"><?= mb_strimwidth($p->ordine_cliente,0,30,'...') ?></span></td>
			<td><?= $p->estimated_close_date ?></td>			
			<td><?= lang('l_'.$p->wf_step) ?></td>
			<td><?= $p->type ?></td>
			<td>
				<div class="progress progress-striped">
				  <div class="bar"
				       style="width: <?= project_progress($p->id) ?>%;"><?= project_progress($p->id) ?> %</div>
				</div> 
				

			</td>
			<td>
				<?= anchor('projects/delete_project/'.$p->id, '<i class="icon-trash"></i>') ?>
				<?= anchor('projects/show_project/'.$p->id, '<i class="icon-eye-open"></i>') ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>