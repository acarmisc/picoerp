
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
			font-size: 10px;
		}
		
		#content {
			padding-left: 0.5cm;
			padding-left: 0.5cm;
/* 			page-break-after: always; */
			margin-top: 2.8cm;
		}
		
		#header {
			position: fixed; 
			left: 0px;		
			height: 2cm;	
		}	
		
		.value_1 {
			height: 2cm;
			font-size: 12px;
		}
		
		.heading_1 {
			font-size: 10px;
			font-weight:bold;
			margin: 0px;
			padding: 0px;			
		}	
		
		.value {
			margin: 0px;
			padding: 1px;
			font-size: 10px;
		}
		
		th {
			font-size: 10px;
			font-style: italic;
		}
		
		#salutation {
			font-size: 10px;
			font-style: italic;
		}
		
		#rows td {
			font-size: 10px;
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
	
	<p align="center" class="heading_1">QUOTATION - OFFERTA</p>
	
	<div id="incipit">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="50%" align="center" class="heading_1"><p><i>ATTN. - SPETT.LE</i></p></td>
				<td width="50%" align="center" class="heading_1"><p><i>DESTINATION/SHIP TO - DESTINATARIO</i></p></td>
			</tr>
			<tr>
				<td width="50%" align="center" valign="top" class="value_1"><?= $object['head']->attn ?><br /><?= $object['head']->name ?>
				<?php $addr = get_addr($object['head']->partner_id,5 ) ?><br />
				<?= $addr->street; ?><br />
				<?= $addr->zip ?> <?= $addr->city?> 
				
				<?php if ($addr->province): ?>
					(<?= $addr->province?>)<br />
				<?php endif; ?>

				<?= $addr->state?>
				</td>
				<td width="50%" align="center" valign="top" class="value_1">
				<?= nl2br($object['head']->destination) ?>
				</td>
			</tr>
		</table>
		
		<div style="border-top: 1px black solid; border-bottom: 1px black solid;padding-top:0.2cm; padding-bottom:0.2cm;">
			LA SPEZIA, <?= $object['head']->send_date ?>
		</div>
		
	</div>
	
	<div id="details">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td width="60%">
					<p class="heading_1"><i>Your Reference - Vs. Riferimento:</i></p>
					<p class="value"><?= $object['head']->reference ?></p>
					<p class="heading_1"><i>Quotation Date - Data Offerta:</i></p>
					<p class="value"><?= date('d-m-Y',$object['head']->creation_date) ?></p>
					<p class="heading_1"><i>Delivery time - Tempo di Consegna:</i></p>
					<p class="value"><?= $object['head']->delivery_time ?></p>
					<p class="heading_1"><i>VAT - IVA:</i></p>
					<p class="value"><?= $object['head']->vat ?></p>
				</td>
				<td width="40%">
					<p class="heading_1"><i>Our reference - Ns Riferimento:</i></p>
					<p class="value"><?= $object['head']->title ?></p>
					<p class="heading_1"><i>Delivery Terms - Termini di consegna:</i></p>
					<p class="value"><?= $object['head']->delivery_terms?></p>
					<p class="heading_1"><i>Payment Terms - Termini di pagamento:</i></p>
					<p class="value"><?= $object['head']->payment_terms?></p>
					<p class="heading_1"><i>Handled By - Gestita Da:</i></p>
					<p class="value"><?= whoami($object['head']->creation_uid) ?></p>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="rows">
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<th width="1cm">Quant.<br />Quant.</th>
				<th width="1cm">M.U.<br />U.M.</th>
				<th width="">Description<br />Descrizione</th>
				<th width="2cm">Price<br />Prezzo</th>
				<th width="1cm">%Disc.<br />%Sc.</th>
				<th width="3cm">Total<br />Totale</th>
			</tr>
			<?php foreach($object['childs'] as $row): ?>
				<tr>
					<td align="center"><?= $row->quantity ?></td>
					<td align="center"><?= $row->unit ?></td>
					<td><?= nl2br($row->description) ?></td>
					<td align="center"><?= money_format('%.2n',$row->price_external) ?></td>
					<td align="center"><?= $row->discount ?> %</td>
					<td align="center"><?= money_format('%.2n',($row->quantity*$row->price_external)*(100-$row->discount)/100) ?></td>
				</tr>
				<?php $document_total += ($row->quantity*$row->price_external)*(100-$row->discount)/100;?>
			<?php endforeach; ?>
		</table>
	</div>
	
	<div style=""></div>
	<div id="foot_note">
		<table cellspacing="0" cellpadding="0" width="90%">
			<tr>
				<td width="30%" class="heading_1"><i>Delivery Time - Tempo di Consegna</i></td>
				<td class="value">: <?= $object['head']->delivery_time ?></td>
			</tr>
			<tr>
				<td width="30%" class="heading_1"><i>Validity Date - Validit&agrave; offerta</i></td>
				<td class="value">: <?= $object['head']->valid_until?></td>
			</tr>
			<tr>
				<td width="30%" class="heading_1"><i>Delivery Terms - Termini di consegna</i></td>
				<td class="value">: <?= $object['head']->delivery_terms ?></td>
			</tr>
			<tr>
				<td width="30%" class="heading_1"></td>
				<td class="value"></td>
			</tr>
			<tr>
				<td width="30%" class=""><?= whoami($object['head']->creation_uid,'email') ?></td>
				<td class="value"></td>
			</tr>
			</table>
			
			<p align="right" class="value" style="margin-right: 0.5cm">Net Total Price (ex. VAT) - Prezzo totale (IVA esc.): <b><?= money_format('%.2n',$document_total) ?></b></p>
			<table cellspacing="0" cellpadding="0" width="80%">
			<tr>
				<td width="40%" class="heading_1"><br /></td>
				<td class="value"></td>
			</tr>
			</table>
			<br /><br /><br />
			<table cellspacing="0" cellpadding="0" width="60%" style="border-top: 1px solid #000">
			<tr>
				<td width="40%" class="">
				<?php if($object['head']->notes != ''): ?>
					<b><i>Notes:<i> </b><?= $object['head']->notes ?>
				<?php endif; ?>
				</td>
				<td class="value"></td>
			</tr>
			<tr>
				<td width="40%" class="">
				<?php if($object['head']->exclusions != ''): ?>
					<b><i>Exclusions:</i> </b><?= $object['head']->exclusions ?>
				<?php endif; ?>
				</td>
				<td class="value"></td>
			</tr>
		</table>
	</div>
	
	
	
	
	<div id="salutation">
	<br />
	<br />
			Best regards - Distinti saluti<br />
			<?= whoami($object['head']->creation_uid) ?>
			</div>	
	</div>

	
</body>
</html>
