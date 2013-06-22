<p class=""><b><?= sizeof($rows) ?></b> records found.</p>

<div id="quotation-rows-browser">

<table class="table table-striped table-bordered table-condensed" style="font-size: 11px">
	<thead>
		<tr>		
			<th>
				Customer
			</th>
			<th><?= lang('products')?></th>
			<th><?= lang('description')?></th>
			<th><?= lang('quotation')?></th>
			<th>Price internal</th>
			<th>Price external</th>
			<th>creation/update</th>		
		</tr>
	</thead>
	<tbody>
		<?php 
			if($rows):
			foreach($rows as $q):
				//$calculated = $this->sales_model->calculateQuotation($q->id); 
			?>
		<tr>
			<td>
				<? $q->customer_name ?>
			</td>
			<td><?= $q->pname.' '.$q->pdescription ?><br />
				<?= $q-> pbrand ?></td>
			<td><?= $q->description ?></td>
			<td><?= $q->qtitle ?></td>
			<td><?= money_format('%.2n',$q->price_internal) ?></td>
			<td><?= money_format('%.2n',$q->price_external) ?></td>
			<td>
				<?= date("d-m-Y", $q->creation_date) ?><br /><?= date("d-m-Y", $q->update_date) ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>

</div>
