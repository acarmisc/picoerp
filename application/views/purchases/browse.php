

<?php
	if(($this->uri->segment(3) != '') and ($this->uri->segment(3) != 'subject')){
	
	?>
	<div class="alert alert-info">
	Those are purchase orders related to current project.
</div>
	<?php
	
		$this->db->select('purchases.*, partners.name as partner_name');
		$this->db->join('partners', 'partners.id = purchases.partner_id');
		$query = $this->db->get_where('purchases', array('project_id' => $this->uri->segment(3)));
		$res = $query->result();
	}else{
		$res = $purchases;
	}

?>


<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
<!-- 			<th width="30px"></th> -->
			<th><a href="?reorder_by=number"><?= lang('number')?></a></th>
			<th><a href="?reorder_by=subject"><?= lang('title')?></a></th>
<!-- 			<th><?= lang('description')?></th>	 -->
			<th><a href="?reorder_by=creation_date"><?= lang('order_date')?></a></th>	
			<th><a href="?reorder_by=arrival_date"><?= lang('arrival_date')?></a></th>	
			<th><?= lang('notes')?></th>						
			<th><a href="?reorder_by=wf_step"><?= lang('wf_step')?></a></th>						
			<th width="40"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($res as $p):	?>
		<tr>
<!--
			<td>
				<input type="checkbox" id="purchase-sel-<?= $p->id ?>" />		
			</td>
-->
			<td><?= $p->number ?></td>
			<td><?= $p->subject ?></td>
<!-- 			<td><?= $p->description ?></td>	 -->		
			<td><?= date('d-m-Y H:i:s', $p->creation_date) ?></td>	
			<td><?= $p->arrival_date ?></td>	
			<td><?= $p->notes ?></td>						
			<td><?= lang('l_'.$p->wf_step) ?></td>					
			<td>
				<?= anchor('purchases/delete_purchase/'.$p->id, '<i class="icon-trash"></i>', array('onclick' => "javascript:return confirm('Are you sure you want to delete it?')")) ?>
				<?= anchor('purchases/show_purchases/'.$p->id, '<i class="icon-eye-open"></i>') ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>