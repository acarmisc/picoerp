<?php
	$query = $this->db->get_where('invoices', array('id' => $this->uri->segment(3)));
	foreach($query->result() as $data){}
?>

<p><?= lang('delete_invoice_confirm') ?></p>

<pre>
	<?= $data->number ?><br />
	<?= $data->description ?>
</pre>

<p align="center">
	<?= anchor('account', lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('account/delete_invoices_confirm/'.$data->id.'/', lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>
