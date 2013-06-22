<?php if($id != 0): 
	
	$calculated = $this->account_model->calculateInvoice($id);
	$rows = $calculated['rows'];
	$subtotal = $calculated['amount'];
	$taxes = $calculated['taxes'];
	
?>

<div class="well">
	<div class="total-block">
		<h4><?= lang('el_number') ?></h4>
		<p class="total-value"><?= $rows ?></p>
	</div>
	<div class="total-block">
		<h4><?= lang('q_subtotal') ?></h4>
		<p class="total-value"><?= currency($subtotal,$currency) ?></p>
	</div>	
	<div class="total-block">
		<h4><?= lang('q_taxes') ?></h4>
		<p class="total-value"><?= currency($taxes,$currency) ?></p>
	</div>	
	<div class="total-block">
		<h4><?= lang('q_total') ?></h4>
		<p class="total-value"><?= currency($subtotal+$taxes,$currency) ?> </p>
	</div>		
	<div class="total-block">
		<h4><?= lang('q_residual') ?></h4>
		<p class="total-value" style="color:red"><b><?= currency($subtotal+$taxes,$currency) ?></b></p>
	</div>		
</div>

<?php endif; ?>
