<?= anchor('account/show_stats/'.$this->uri->segment(3).'/'.$this->uri->segment(4), '<i class="icon-signal"></i> '.lang('show_account_stats')) ?> 

<?php
	if($this->uri->segment(4) != ''){
		$Y = $this->uri->segment(3);
		$M = $this->uri->segment(4);
	}else{
		$Y = date('y',time());
		$M = date('m',time());
	}

//	$this->db->group_by('date_due');
	$this->db->like('due', '-'.$M.'-'.$Y);
	$this->db->select('invoice_terms.*, invoices.direction');
	$this->db->join('invoice_terms', 'invoice_terms.invoice_id = invoices.id');
	$query = $this->db->get('invoices');	
	$invoices = $query->result();
?>


<div class="calendar-big">
<?php
	$data = array();
	$a = array();
	$sum_in = 0;
	$sum_out = 0;	
	foreach($invoices as $i){
		if($i->direction == 2){
			$sum_out += $i->amount;	
		}else{
			$sum_in += $i->amount;	
		}
		
	
		if($i->due != ''){
			$date = explode("/",$i->due);			
			if($date[1] == $M){
				$a = array($date[0] => site_url('account/deadlines_show/'.$date[2].'/'.$date[1].'/'.$date[0]));				
				$data += $a;
			}
		}
	}    

	echo $this->calendar->generate($Y, $M, $data);
?>
</div>


<div class="well">
	<div class="total-block">
		<h4><?= lang('invoices') ?> <?= lang('open') ?></h4>
		<p class="total-value"><?= sizeof($invoices) ?></p>
	</div>
	<div class="total-block">
		<h4><?= lang('residual') ?> in</h4>
		<p class="total-value"><?= currency($sum_in, '€') ?></p>
	</div>		
	<div class="total-block">
		<h4><?= lang('residual') ?> out</h4>
		<p class="total-value"><?= currency($sum_out, '€') ?></p>
	</div>			
	<div class="total-block">
		<h3>Balance</h3>
		<p class="total-value"><?= currency(0, '€') ?></p>
	</div>
</div>