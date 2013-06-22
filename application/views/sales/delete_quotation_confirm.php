<?php
	$query = $this->db->get_where('quotations', array('id' => $this->uri->segment(3)));
	foreach($query->result() as $data){}
?>

<p><?= lang('delete_quotation_confirm') ?></p>

<pre>
	<?= $data->title ?><br />
	<?= $data->description ?>
</pre>

<p align="center">
	<?= anchor('sales', lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('sales/delete_quotation_confirm/'.$data->id.'/', lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>
