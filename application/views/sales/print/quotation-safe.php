<?php
	$query = $this->db->get_where('quotations', array('quotations.id' => $id));
	foreach($query->result() as $r){ $quotation = $r; }
	
	$this->db->select('partners.*, partner_addresses.*');
	$this->db->join('partner_addresses','partner_addresses.partner_id = partners.id','left');
	$this->db->where('address_kind',5);
	$query1 = $this->db->get_where('partners', array('partners.id' => $quotation->partner_id));
	foreach($query1->result() as $r1){ $partner = $r1; }
	

?>

<html>
<head>
	<style type="text/css" media="all">
		#page {
			font-family: Arial, sans-serif;
			font-size: 12px;
		}
		
		body {
			margin: 0.5cm;
			background-image: url('<?= base_url() ?>assets/img/bg-print.jpg');
			background-repeat: repeat-y;
		}
		
		#page-header {
			height: 5.5cm;
			border-bottom: 1px solid #333;
		}
		
		#logo {
			width: 9cm;
			height: 3cm;
			/* background: #ccc; */
			-moz-border-radius: 20px;
		}
		
		#to-address {
			font-size: 12px;
			width: 9cm;
			line-height: 0.6cm;
			border-bottom: solid 1px #ddd;
			padding: 0.3cm;
		}
		
		#to-address b {
			font-size: 15px;
		}
		
		#preamble {
/* 			border-bottom: solid 1px #333; */
/* 			border-top: solid 1px #333;			 */
			padding-top: 0.4cm;
			padding-left: 0.3cm;
			padding-bottom: 0.4cm;
		}
		
		#details {
/* 			background-color: #fcfcfc; */
			padding: 0.3cm;
		}
		
		#subject {
			padding-left: 0.3cm;
			padding-top: 0.5px;
			padding-bottom: 0.5px;			
			font-size: 16px;
			font-weight: bold;
		}
		
		#total {
			font-size: 18px;
			padding-left: 1cm;
			padding-top: 1cm;
			padding-bottom: 2cm;
/* 			border-bottom: 0.2cm solid #eee; */
		}
		
		#total .value{
			font-weight: bold;
			font-size: 24px;
		}
		
		#total .note {
			font-size: 12px;
			color: #666;
			font-style: italic;
		}
	
		label {
			font-weight: bold;
			color: #333;
			width: 6cm;
			display: inline-block;
			text-align: right;
		}		
		
		.value {
			width: 4cm;
			display: inline-block;
		}
		
	</style>
</head>

<body>
	
	<div id="page">
	
		<div id="page-header">
			<div id="logo">
				
			</div>
		</div>
		
		
		<div id="page-content">

			<div id="to-address">
				<b><?= $partner->name ?></b><br />
				<?= $partner->street ?><br />
				<?= $partner->zip ?> <?= $partner->city ?> <?= $partner->province ?><br />
				<?= $partner->state ?>
			</div>
			
			<div id="preamble">
				<label>Fattura n.</label> <span class="value"><?= $invoice->number ?></span><br /> 
				<label>Del</label> <span class="value"><?= $invoice->invoice_date ?></span>
			</div>
			
			<div id="details">
				<?php if(isset($invoice->ordine_cliente)): ?>
				<p><label>Vostro ordine</label> <span class="value"><?= $invoice->ordine_cliente ?></span></p>
				<?php endif; ?>
				<p><label>Modalit&agrave; di pagamento</label> <span class="value"><?= $invoice->payment_method ?></span></p>
			</div>
			
			<div id="subject">
				<p><label>Oggetto</label> <span class="value" style="width:18cm"><?= $invoice->description ?></span></p>
			</div>
			
			<div id="details">
				<p><label>Periodo di competenza</label> <span class="value"><?= $invoice->period ?></span></p>
				<?php if(isset($invoice->sal)): ?>				
				<p><label>Comprovante lavori</label> <span class="value"><?= $invoice->sal ?></span></p>
				<?php endif; ?>
				<?php if(isset($invoice->progress_step)): ?>				
				<p><label>Percentuale di avanzamento mensile</label> <span class="value"><?= $invoice->progress_step ?>%</span></p>
				<?php endif; ?>
				<?php if(isset($invoice->transfer)): ?>				
				<p><label>Storno anticipo all'ordine</label> <span class="value"><?= $invoice->transfer ?> &euro;</span></p>
				<?php endif; ?>
			</div>			
			
			<div id="total">
				<p><label>Totale netto</label> <span class="value"><?= $invoice->amount_untaxed ?> &euro;</p>
				<p><label> <span class="note"><?= $invoice->taxes_notes ?></span></label></p>
			</div>
			<div id="details">
				<p><label>Scadenza fattura</label> <span class="value"><?= $invoice->date_due ?></span></p>
			</div>
		</div>
		
	</div>
	
</body>
</html>