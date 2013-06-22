<?php 
	$document_total = 0;
	setlocale(LC_MONETARY, 'it_IT');
?>
<html>
<head>
	<style type="text/css" media="all">
	@page {
            margin-top: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }
	
		body {
			font-family: Verdana, sans-serif;
			font-size: 14px;
		}
		
		#content {
			padding-left: 0.5cm;
			padding-left: 0.5cm;
			margin-top: 2.8cm;
		}
		
		#header {
			position: fixed; 
			left: 0px;		
			height: 2cm;	
		}	
		
		.value_1 {
			height: 2cm;
			font-size: 14px;
		}
		
		.heading_1 {
			font-size: 12px;
			font-weight:bold;
			margin: 0px;
			padding: 0px;			
		}	
		
		.value {
			margin: 0px;
			padding: 1px;
			font-size: 12px;
		}
		
		th {
			font-size: 12px;
			font-style: italic;
		}
		
		#salutation {
			font-size: 12px;
			font-style: italic;
		}
		
		#rows td {
			font-size: 12px;
			padding: 5px;
		}
		
		#rows th {
			border-right: 1px solid #ccc;
			border-bottom: 1px solid #000;
			border-top: 1px solid #000;
			padding: 5px;
		}
		
		#header_log {
			width: 21cm;
			height: 2.5cm;
		}
		
		#incipit {
			margin-bottom: 0.3cm;
		}
		
		#footer {
			position: fixed;
  			bottom: 0.5cm;
  			left: 0.5cm;
  			right: 0px;
		}
		
		#footer-content {
			font-size: 10px;
			color: #666;			
		}
	</style>
</head>
  
<body>
	<div id="header">
		<p><img src="<?= base_url() ?>assets/img/big_head.png" id="header_log" /></p>		
	</div>
	<div id="footer">
		
	<div id="footer-content">
		<table width="70%" align="left">
			<tr>
				<td align="left">Bank - Banca:</td>
				<td align="left">Popolare di Sondrio</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td align="left">IBAN:</td>
				<td align="left">IT03J0569603209000010559X26</td>
				<td align="left">ABI:</td>
				<td align="left">05696</td>
			</tr>
			<tr>
				<td align="left">CIN:</td>
				<td align="left">J</td>
				<td align="left">CAB:</td>
				<td align="left">03209</td>
			</tr>		
			<tr>
				<td align="left">C/C:</td>
				<td align="left">000010559X26</td>
				<td align="left">BIC/Swift:</td>
				<td align="left">POSOIT2106Q</td>
			</tr>				
		</table>	
	</div>		
	</div>

<div id="content">
	
	<!-- <pre><?php print_r($object) ?></pre>  -->
	<p align="" class="heading_1">
		<br /><br />INVOICE - FATTURA</p>
	
	<div id="incipit">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="50%" align="center" class="heading_1"><p><i>ATTN. - SPETT.LE</i></p></td>
				<!--<td width="50%" align="center" class="heading_1"><p><i></i></p></td>-->
			</tr>
			<tr>
				<td width="50%" align="center" valign="top" class="value_1">
				<?= $object['head']->partner_name ?><br /><?= $object['head']->name ?>
				<?php $addr = get_addr($object['head']->partner_id,5 ) ?><br />
				<?= $addr->street; ?><br />
				<?= $addr->zip ?> <?= $addr->city?> (<?= $addr->province?>)<br />
				<?= $addr->state?>
				</td>
				<!--<td width="50%" align="center" valign="top" class="value_1">
				
				</td>-->
			</tr>
		</table>
		
		<div style="border-top: 1px black solid; border-bottom: 1px black solid;padding-top:0.2cm; padding-bottom:0.2cm;">
			LA SPEZIA, <?= date('d-m-Y',$object['head']->update_date) ?>
		</div>
		
	</div>
	
	<div id="details">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="50%">
					<p class="heading_1"><i>Your Reference - Vs. Riferimento:</i></p>
					<p class="value"><?= $object['head']->project_order ?></p>
					<p class="heading_1"><i>Ivoice Date - Data Fattura:</i></p>
					<p class="value"><?= date('d-m-Y',$object['head']->update_date) ?></p>					
					<p class="heading_1"><i>VAT - IVA:</i></p>
					<p class="value"><?= $object['head']->vat ?></p>
				</td>
				<td width="50%">
					<p class="heading_1"><i>Our reference - Ns Riferimento:</i></p>
					<p class="value"><?= $object['head']->number ?></p>
					<p class="heading_1"><i>Payment Terms - Termini di pagamento:</i></p>
					<p class="value"><?= $object['head']->payment ?></p>
					<p class="heading_1"><i>Handled By - Gestita Da:</i></p>
					<p class="value"><?= whoami($object['head']->creation_uid) ?></p>
				</td>
			</tr>
		</table>
	</div>
	
	
	<div id="details">
	<br />
	<br />
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="60%">
					<p class="heading_1"><i>Object - Oggetto:</i>
					<div style="width: 15cm" class="value"><?= $object['head']->description ?></div></p>
				</td>
			</tr>		
				<?php if (sizeof($object['head']->period) > 0): ?>
					<tr>
						<td width="60%">
							<p class="heading_1"><i>Period - Periodo:</i>
							<span class="value"><?= $object['head']->period ?></span></p>
						</td>
					</tr>
				<?php endif; ?>
				<?php if ($object['head']->progress_percentage > 0 AND $object['head']->show_progress == '1'): ?>
					<tr>
						<td width="60%">
							<p class="heading_1"><i>Progress Step - Avanzamento:</i>
							<span class="value"><?= $object['head']->progress_percentage ?> %</span></p>
						</td>
					</tr>
				<?php endif; ?>
		</table>
		<br />
	<br />
	<br />
	<br />
		<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
				<td width="50%">
				</td>
				<td width="50%">
					<table width="100%">
						<tr>
							<td width="40%">Sub Total - Imponibile:</td>
							<td width="60%"><?= money_format('%.2n', $object['head']->amount_untaxed)?></td>
						</tr>
						<?php if ($object['head']->taxes > 0): ?>
						<tr>
							<td width="40%">V.A.T. - I.V.A.:</td>
							<td width="60%"><?= money_format('%.2n', $object['head']->amount - $object['head']->amount_untaxed)?></td>
						</tr>
						<?php endif; ?>
						<?php if ($object['head']->transfer > 0): ?>
						<tr>
							<td width="40%">Transfer - Storno:</td>
							<td width="60%"><?= money_format('%.2n', -$object['head']->transfer)?></td>
						</tr>

						
						<?php endif; ?>
						<?php if ($object['head']->transport_notes > 0): ?>
						<tr>
							<td width="40%">Transport - Trasporto:</td>
							<td width="60%"><?= money_format('%.2n', $object['head']->transport_notes)?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td width="40%"><i><b>Total - Totale:</b></i></td>
							<td width="60%"><?= money_format('%.2n', $object['head']->amount)?></td>
						</tr>
						
						</table>
						<?php if (sizeof($object['head']->literal_price) > 0): ?>
							<p align=""><?= $object['head']->literal_price ?></p>
						<?php endif; ?>
						
						<?php if (sizeof($object['head']->taxes_notes) > 0): ?>
						<table width="100%">
						<tr>
							<td width="40%">Tax notes - note tasse:</td>
							<td width="60%"></td>
						</tr>
						</table>
						<p align="right" style="margin-right:1cm;"><?= $object['head']->taxes_notes ?></p>
						<?php endif; ?>
					
				</td>
			</tr>
		</table>
	</div>

	

	
	<div id="salutation">
		<?= $object['head']->notes_printable ?>
	</div>
	
	
	<div id="salutation">
	<br />
	<br />
			Best regards -<br />
			<?= whoami($object['head']->creation_uid) ?>
			</div>	
	</div>

	
</body>
</html>
