<?php

	$price_budget = 0;
	$price = 0;
	$price_sold = 0;
	$price_sold_extra = 0;
	$ytd = 0;
?>

  
  <p>Rows: <?= sizeof($items) ?></p>
<table class="table table-striped table-bordered table-condensed prj-info-tab">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('code')?></th>			
			<th><?= lang('item')?></th>
			<th><?= lang('qty')?></th>
			<th><?= lang('order_date')?></th>
			<th><?= lang('delivery_time')?></th>			
			<th><?= lang('closing_date')?></th>						
			<th><?= lang('amounts')?></th>
			<th><?= lang('wf_step')?></th>			
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($items as $p):	?>
		
		<?php
			
			$this->db->select('invoices.number, invoices.wf_step, invoices.amount_untaxed');
			$this->db->join('purchases', 'purchases.id = purchase_rows.purchase_id');
			$this->db->join('invoices', 'invoices.purchase_order_id = purchases.id');
			$this->db->where('project_item_id', $p->id);
			$q_temp = $this->db->get('purchase_rows');
			
			
			
			$result_temp = $q_temp->result();
			if(sizeof($result_temp) > 0){
				$show_invoice = true;
				foreach($result_temp as $r_temp){
					$invoice_tot = $r_temp->amount_untaxed;
					$invoice_num = $r_temp->number;
					$invoice_info = "Invoiced: ".$r_temp->number;
					}
			}else{
				$show_invoice = false;
				$invoice_info = '';
				$invoice_num = '';
			}
			
			// cerco ordine			
			$this->db->select('purchases.number, purchases.price_final');
			$this->db->join('purchases', 'purchases.id = purchase_rows.purchase_id');
			$this->db->where('project_item_id', $p->id);
			$q_ord = $this->db->get('purchase_rows');
			
			$result_ord = $q_ord->result();
			
			
			if(sizeof($result_ord) > 0){
				$show_ordered = true;
				foreach($result_ord as $r_ord){
					if($ord_num != $r_ord->number){
						$e = "diff";
					}else{
						$e = "";
					}
					$ord_tot = $r_ord->price_final;
					$ord_num = $r_ord->number;
					$ord_info = "Ordered: ".$r_ord->number;
					/* TODO mancano da sommare eventuali altri ordini */
					}
			}else{
				$show_ordered = false;
				$ord_info = '';
				$ord_num = '';
			}		
				
			
		?>
		
		<tr>
			<td>
				<input type="checkbox" id="item-sel-<?= $p->id ?>" />		
			</td>
			<td><?= $p->code ?></td>			
			<td class="clickable"><?= $p->item ?> <b><?= $invoice_num ?> <?= $ord_num ?><b/><br />
				<span class="second-row"><?= $p->brand ?></span><br />
				<small><?= $p->description ?></small>
			</td>
			<td><?= $p->qty ?> <?= $p->unit ?></td>						
			<td><?= $p->order_date ?></td>
			<td><?= $p->delivery_time ?></td>			
			<td><?= $p->closing_date ?></td>						
			<td><?php
			
				if ($show_invoice != false){
				
					if ($marked != true){
							//echo $invoice_tot.' '.$p->currency;
							$invoice_tot -= $r_temp->amount_untaxed;
							$marked = true;
							//$real_today_w_extra += $r_temp->amount_untaxed;
					}else{
						echo '<small><i class="icon-barcode"></i>'.$invoice_num.'</small>';
					}
					
				}else{
					$real_today_w_extra += $p->price_budget;
				}
				
				if ($show_ordered != false){ 
					
					//if ($marked_o != true){
					if($ord_num != $prev_ord_num){
							echo '<span class="second-row">ORDER: '.$ord_tot .' '.$p->currency.'</span>';
							$ord_tot -= $r_temp->amount_untaxed;
							$marked_o = true;
							$real_today_w_extra += $ord_tot;
							$real_today_w_extra -= $p->price_budget;	
					
					}else{
						echo '<small><i class="icon-shopping-cart"></i>'.$ord_num.'</small>';
						$real_today_w_extra -= $p->price_budget;
						if($e != ""){
							$real_today_w_extra += $p->price_budget;
						}
						
					}
					$prev_ord_num =  $ord_num;
				}
				?>
			<br />
				<span class="second-row">BUDGET:  <?= $p->price_budget ?> <?= $p->currency ?></span>
			</td>
			<td><?= lang('l_'.$p->wf_step) ?></td>			
			<td width="90px">
				<?= anchor('project/show_notes_of/'.$p->id, '<i class="icon-comment"></i>', array('rel'=>'tooltip', 'title'=>'notes')) ?>
				<?= anchor(base_url().'upload/'.$p->bill, '<i class="icon-download-alt"></i>', array('rel'=>'tooltip', 'title'=>'download bill')) ?>
				
				<a rel="tooltip" title="show details" data-toggle="modal" href="#myModal" id="project_show_item" name="<?= $p->id ?>"><i class="icon-eye-open"></i></a>
				
				<a rel="tooltip" title="delete item" data-toggle="modal" href="#myModal" id="project_delete_item" name="<?= $p->id ?>"><i class="icon-trash"></i></a>
				
			</td>

		</tr>
		<?php 
		
		
		endforeach; ?>
	</tbody>
</table>
	</div>

<div class="tab-pane" id="loc_charts">
  

<?php
	$currency = '&euro;';
	$tots = projectCalcSum($this->session->userdata('current_project'));
	$tots_extra = projectCalcSumExtra($this->uri->segment(3));
	
	$qp = $this->db->get_where('projects', array('id'=> $this->session->userdata('current_project')));
	$qr = $qp->result();
	// print_r($qr);
?>

<div class="well">



<!-- prove -->
<?php
	$tot_ord = 0;
	$query = $this->db->get_where('purchases', array('project_id' => $this->uri->segment(3)));
	foreach($query->result() as $r){
		$tot_ord += $r->price_final;
	}

	$tot_nonord = 0;
	foreach($items as $i){
		$query1 = $this->db->get_where('purchase_rows', array('project_item_id' => $i->id));
		if(sizeof($query1->result()) > 0){}else{
			$tot_nonord += $i->price_budget;	
		}
		
	}


?>

<!-- fine prove -->

<table width="100%">
	<tr>
		<td>
<table class="table table-bordered prj-info-tab" style="width:960px" align="center">
	<tr>
		<th></th>
		<th>At order</th>
		<th>YTD</th>
		<th>YTD Extra</th>
		<th>FINAL</th>
	</tr>
	<tr>
		<th>COSTS</th>
		<td class="clickable">
			<?= money_format('%.2n',$tots['price_budget']) ?>
		</td>
		<td class="clickable">
			<?= money_format('%.2n',$tot_ord+$tot_nonord) ?>
			
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<?= money_format('%.2n',extraCalc($this->session->userdata('current_project'),'cost')) ?>
			
		</td>
		<td class="clickable">
			<?= money_format('%.2n', ($tot_ord+$tot_nonord) + extraCalc($this->session->userdata('current_project'),'cost')) ?>			
		</td>

	</tr>
	<tr>
		<th>ORDER</th>
		<td class="clickable">
			<?= money_format('%.2n',$qr[0]->order_amount) ?>
		</td>
		<td class="clickable">
			<?= money_format('%.2n',$qr[0]->order_amount) ?>
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<?= money_format('%.2n',extraCalc($this->session->userdata('current_project'),'order')) ?>
		</td>
		<td class="clickable">			
			<?= money_format('%.2n',$qr[0]->order_amount+extraCalc($this->session->userdata('current_project'),'order')) ?>
		</td>

	</tr>
	<tr>
		<th>MARGIN</th>
		<td class="clickable">
			<?= money_format('%.2n',$qr[0]->order_amount - $tots['price_budget']) ?>
		</td>
		<td class="clickable">
			<?= money_format('%.2n',$qr[0]->order_amount - ($tot_ord+$tot_nonord)) ?>
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<?= money_format('%.2n',extraCalc($this->session->userdata('current_project'),'order')-extraCalc($this->session->userdata('current_project'),'cost')) ?>
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<?= money_format('%.2n',($qr[0]->order_amount - ($tot_ord+$tot_nonord))+extraCalc($this->session->userdata('current_project'),'order')-extraCalc($this->session->userdata('current_project'),'cost')) ?>
		</td>

	</tr>
	<tr>
		<th>MARGIN %</th>
		<td class="clickable">
			<?= round(($qr[0]->order_amount - $tots['price_budget'])/ $qr[0]->order_amount* 100,2) ?> %
		</td>
		<td class="clickable">
			<?= round(($qr[0]->order_amount - ($tot_ord+$tot_nonord))/ $qr[0]->order_amount* 100,2) ?> %
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<?= round((extraCalc($this->session->userdata('current_project'),'order')-extraCalc($this->session->userdata('current_project'),'cost')) / extraCalc($this->session->userdata('current_project'),'order') * 100,2)?>%
		</td>
		<td class="clickable">
			<!--  TODO: aggiungere extra -->
			<!--  TODO: QUESTO E' SBAGLIATO -->
			<?= round((($qr[0]->order_amount+extraCalc($this->session->userdata('current_project'),'order')) - (($tot_ord+$tot_nonord) + extraCalc($this->session->userdata('current_project'),'cost')))/ $qr[0]->order_amount* 100,2) ?> %
		</td>

	</tr>	
	<tr>
		<th></th>
		<th>
			DEVIATION
		</th>
		<td class="clickable">
			<?php
				$dev_ytd = (round(($qr[0]->order_amount - $tots['price_budget'])/ $qr[0]->order_amount* 100,2) - round(($qr[0]->order_amount - ($tot_ord+$tot_nonord))/ $qr[0]->order_amount* 100,2))*-1
			?>
			<?= $dev_ytd ?> % 
			
		</td>
		<td class="clickable">
			<?= (round(($qr[0]->order_amount - $tots['price_budget'])/ $qr[0]->order_amount* 100,2) -
			round((extraCalc($this->session->userdata('current_project'),'order')-extraCalc($this->session->userdata('current_project'),'cost')) / extraCalc($this->session->userdata('current_project'),'order') * 100,2))*-1 
			 ?> %
		</td>
		<td class="clickable">
			<?= (round(($qr[0]->order_amount - $tots['price_budget'])/ $qr[0]->order_amount* 100,2) -
			round((($qr[0]->order_amount+extraCalc($this->session->userdata('current_project'),'order')) - (($tot_ord+$tot_nonord) + extraCalc($this->session->userdata('current_project'),'cost')))/ $qr[0]->order_amount* 100,2))*-1 ?> %
		</td>

	</tr>	
</table>
	</td>
	<td>
		<h4>Billing</h4>
		
	<table class="table table-bordered prj-info-tab">
	<tr>
		<th>
			Total ordered
		</th>
		<td>			
			<?= money_format('%.2n',$tot_ord) ?>
		</td>
	</tr>
	<tr>
		<th>
			Total not ordered
		</th>
		<td>			
			<?= money_format('%.2n',$tot_nonord) ?>
		</td>
	</tr>	
	<tr>
		<th>
			To be paid
		</th>
		<td>
			<?php 
				$to_be_paid = ($tot_ord+$tot_nonord)-$this->session->userdata('inv_total_in');
			?>
			<?= money_format('%.2n',$to_be_paid) ?>
		</td>
	</tr>
	<tr>
		<th>
			To be invoiced
		</th>
		<td>
			<?php
				$to_be_invoiced = $this->session->userdata('inv_order_amount') - $this->session->userdata('inv_total_out')
			?>
			<?= money_format('%.2n',$to_be_invoiced) ?>
		</td>
	</tr>
	<tr>
		<th>
			Residual margin
		</th>
		<td>			
			<?= money_format('%.2n',$to_be_invoiced-$to_be_paid) ?>
		</td>
	</tr>	
</table>

	</td>
</tr>
</table>
</div>
