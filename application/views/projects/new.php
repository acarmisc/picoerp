<p class="alert alert-info"><?= lang('new_project_intro') ?></p>
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('title')?></th>
			<th><?= lang('customer')?></th>
			<th><?= lang('amount')?></th>
			<th><?= lang('creation_date')?></th>	
			<th><?= lang('workflow')?></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($quotations):
			foreach($quotations as $q):
			$calculated = $this->sales_model->calculateQuotation($q->id); ?>
		<tr>
			<td>
				<input type="radio" class="q-to-prj-el" id="quotation-sel-<?= $q->id ?>" />		
			</td>
			<td><?= $q->title ?></td>
			<td><?= $q->name ?></td>
			<td><?= currency($calculated['amount'],$q->currency) ?></td>
			<td><?= date('d-m-Y', $q->creation_date) ?></td>
			<td><?= lang('l_'.$q->wf_step) ?></td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>

<div class="pull-right">
	<a data-toggle="modal" href="#myModal" id="create_project_btn"><?= lang('ok_create_project') ?></a> or 
	<?= anchor('projects/index', lang('cancel'), array('class'=>'btn')) ?>
</div>
