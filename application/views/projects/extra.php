<?php

	$price_budget = 0;
	$price = 0;
	$price_sold = 0;

?>

<?php

	$query = $this->db->get_where('projects', array('parent_id' => $project[0]->id, 'type' => 'extra'));
	$res = $query->result();

?>
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th><?= lang('name')?> & <?= lang('title') ?></th>
			<th><?= lang('description')?></th>	
			<th><?= lang('creation_date')?></th>	
			<th><?= lang('wf_step')?></th>						
			<th><?= lang('order_amount')?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $p):	?>
		<tr>
			<td><?= $p->name ?> <?= $p->title ?></td>
			<td><?= $p->description ?></td>			
			<td><?= date('d-m-Y H:i:s', $p->creation_date) ?></td>	
			<td><?= lang('l_'.$p->wf_step) ?></td>					
			<td><?= $p->order_amount ?></td>	
			<td>
			<?= anchor('projects/show_project/'.$p->id, '<i class="icon-eye-open"></i>') ?>
			</td>		
		</tr>
		<?php 
			
					
		endforeach; ?>
	</tbody>
</table>

<?php
	$currency = '€';
	$tots = projectCalcSum($p->id);

?>

<!--
<div class="well">
	<div class="total-block">
		<h4>Total Sold</h4>
		<p class="total-value"><?= currency($tots['price_sold'],$currency) ?></p>
	</div>
	<div class="total-block">
		<h4>Total Closed</h4>
		<p class="total-value"><?= currency($tots['price_closed'],$currency) ?></p>
	</div>	
	<div class="total-block">
		<h4>Total Budget</h4>
		<p class="total-value"><?= currency($tots['price_budget'],$currency) ?></p>
	</div>
	<div class="total-block">
		<h4>Real Today Margin</h4>
		<p class="total-value"><?= currency($tots['real_margin'],'%') ?></p>
	</div>	
	<div class="total-block">
		<h4>Expected Margin</h4>
		<p class="total-value"><?= currency($p->order_amount/100*$tots_extra['price_sold'],'%') ?></p>
	</div>		
</div>
-->