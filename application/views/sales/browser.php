<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th><a href="?reorder_by=type"><?= lang('type')?></th>
			<th><a href="?reorder_by=title"><?= lang('title')?></a></th>
			<th><a href="?reorder_by=name"><?= lang('customer')?></a></th>
			<th><?= lang('amount')?></th>
			<th><a href="?reorder_by=creation_date"><?= lang('creation_date')?></a></th>	
			<th><a href="?reorder_by=wf_step">Workflow</a></th>
			<th>Prj</th>
			<th>Ord</th>
			<th width="40px"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($quotations):
			foreach($quotations as $q):
				$calculated = $this->sales_model->calculateQuotation($q->id); ?>
				<?php 
					$this->db->limit(1);
					$q_prj = $this->db->get_where('projects', array('quotation_id' => $q->id));
					if(sizeof($q_prj->result()) > 0){
						foreach($q_prj->result() as $r_prj){
							$prj_stat = img('assets/img/ok.png');
							$s = 1;
							$c_ord = $r_prj->ordine_cliente;
						}
					}else{
						$c_ord = '';
						$prj_stat = img('assets/img/error.png');
						$s = 2;
					}
				?>
		<tr class="row-state-<?= $s ?>">
			<td>
				<?= $q->type ?>	
			</td>
			<td><?= anchor('sales/show_quotation/'.$q->id, $q->title) ?></td>
			<td><?= $q->name ?></td>
			<td><?= money_format('%.2n',$calculated['amount']) ?></td>
			<td><?= date('d-m-Y', $q->creation_date) ?></td>
			<td><?= lang('l_'.$q->wf_step) ?></td>
			<td>
				<?= $prj_stat ?>
			</td>
			<td><span style="font-size:9px">
				<?= $c_ord ?></span>
			</td>
			<td>
				<?= anchor('sales/show_quotation/'.$q->id, '<i class="icon-eye-open"></i>') ?>
				<?= anchor('sales/delete_quotation/'.$q->id, '<i class="icon-trash"></i>') ?>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>
