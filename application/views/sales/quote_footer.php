<?php
	$currency = "&euro;";
?>

<?php if($id != 0): 
	
	$calculated = $this->sales_model->calculateQuotation($this->session->userdata('current_quotation'));
	$rows = $calculated['rows'];
	$subtotal = $calculated['amount'];
	$taxes = $calculated['taxes'];
	$internal = $calculated['internal'];
	
?>

<div class="well">
	<div class="total-block">
		<h4>Number of rows</h4>
		<p class="total-value"><?= $rows ?></p>
	</div>
	<div class="total-block">
		<h4>Total costs</h4>
		<p class="total-value"><?= money_format('%.2n',$internal) ?></p>
	</div>	
	<div class="total-block">
		<h4>Total price</h4>
		<p class="total-value"><?= money_format('%.2n',$subtotal) ?></p>
	</div>	
	
	<div class="total-block">
		<h4>Margin percentage</h4>
		<?php
			$margin = $subtotal - $internal;
			$margin = round($margin/$subtotal*100,2);
		?>
		<p class="total-value"><?= $margin ?>%</p>
	</div>		

</div>

<?php endif; ?>



