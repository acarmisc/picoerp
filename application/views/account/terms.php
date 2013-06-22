<?php
	$query = $this->db->get_where('invoice_terms', array('invoice_id' => $invoice_id));
	foreach($query->result() as $row){
?>

	<form action="#" id="term-<?= $row->id ?>" method="POST" class="well" onsubmit="return false">
	<input type="hidden" name="id" value="<?= $row->id ?>" />
	
	<div class="control-group" style="display:inline-table;">
      <label class="control-label">amount</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="amount" name="amount" value="<?= $row->amount ?>" type="text">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>	
    
    
    <div class="control-group" style="display:inline-table;">
      <label class="control-label">date due</label>
      <div class="controls ">
        <input class="input-small" datefield="" input-append"="" id="due" name="due" value="<?= $row->due ?>" type="text"><span class="add-on"><i class="icon-th"></i></span>
      </div>
    </div>

	<div class="pull-right">
		<button class="btn btn-primary invoice-term-submit" name="<?= $row->id ?>"><?= lang('save') ?></button>
	</div>
	    
    
	</form>

<?php 
	}
?>

<?php 
	
	$query1 = $this->db->get_where('invoices', array('id' => $invoice_id));
	foreach($query1->result() as $r1){ ?>
	
	<p>
		<b><?= lang('amount') ?></b> <?= $r1->amount ?> &euro;<br />
		<b><?= lang('amount_untaxed') ?></b> <?= $r1->amount_untaxed ?> &euro;
	</p>
		
<?php	}
?>