
<?php
	if($this->uri->segment(3) != ''){
	
	?>
	<div class="alert alert-info">
	Those are invoices related to current project.
</div>
	<?php
	
		$this->db->select('invoices.*, partners.name as partner_name, directions.label as direction_label');
		$this->db->join('partners', 'partners.id = invoices.partner_id','left');
		$this->db->join('directions', 'directions.id = invoices.partner_id','left');		
		$query = $this->db->get_where('invoices', array('project_id' => $project_id));
		$res = $query->result();
	}else{
		$res = $invoices;
	}

?>

  <div class="pull-right btn-group" data-toggle="buttons-checkbox" id="transactions-
filter">
    <button class="btn active" onclick="liveToggle('row-state-1')">in</button>
    <button class="btn active" onclick="liveToggle('row-state-2')">out</button> 
</div>


<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('number')?></th>
			<th><?= lang('description')?></th>	
			<th><?= lang('creation_date')?></th>			
			<th><?= lang('direction')?></th>				
			<th><?= lang('wf_step')?></th>						
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $p):	
			
			if($p->direction == 2){
				$tot_out += $p->amount_untaxed-$p->transfer;				
			}elseif($p->direction == 1){
				$tot_in += $p->amount_untaxed;
			}
			
		?>
		<tr class="row-state-<?= $p->direction ?>">
			<td>
				<input type="checkbox" id="invoice-sel-<?= $p->id ?>" />		
			</td>
			<td><?= $p->number ?></td>
			<td><?= $p->description ?></td>			
			<td><?= date('d-m-Y H:i:s', $p->creation_date) ?></td>
			<td><?= $p->direction ?></td>			
			<td><?= lang('l_'.$p->wf_step) ?></td>					
			<td>
				<?= anchor('account/invoice_show/'.$p->id, '<i class="icon-eye-open"></i>') ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<p>

	<b>Total OUT:</b> <span class="value"><?= money_format('%.2n',$tot_out) ?> </span>
	<b>Total IN:</b> <span class="value"><?= money_format('%.2n',$tot_in) ?> &euro; </span>
	<b>Flow (out - in):</b> <span class="value"><?= money_format('%.2n',$tot_out-$tot_in) ?> &euro; </span>

<?php
	$this->session->set_userdata('inv_total_in', $tot_in);
	$this->session->set_userdata('inv_total_out', $tot_out);
?>
</p>