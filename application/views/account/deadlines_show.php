<?= anchor('account/deadlines/'.$this->uri->segment(3).'/'.$this->uri->segment(4),lang('back_to_deadlines')) ?>

<?php
	if($this->uri->segment(4) != ''){
		$Y = $this->uri->segment(3);
		$M = $this->uri->segment(4);
		$D = $this->uri->segment(5);		
	}

	$this->db->where('due', $D.'/'.$M.'/'.$Y);
	$this->db->group_by('invoices.id');
	$this->db->like('due', '/'.$M.'/'.$Y);
	$this->db->select('invoice_terms.due, invoices.*');
	$this->db->join('invoice_terms', 'invoice_terms.invoice_id = invoices.id');
	$query = $this->db->get('invoices');	
	$invoices = $query->result();
?>

<div id="invoices-browser">
	<?php 
		
		liveTable($this->account_model->modelData('invoice'), 
							array('values' => $invoices,
									'show' => 'number,partner_id,project_id,direction,amount,residual,date_due,wf_step',
									'actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete invoice',
																	'target' => '/account/invoice_delete/'),
													   '2' => array('icon' => 'icon-eye-open',
																	'label' => 'show invoce',
																	'target' => '/account/invoice_show/'),
														)
								)
						);
		
	?>
</div>
