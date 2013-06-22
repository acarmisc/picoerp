<?php
	$query = $this->db->get_where('attachments', array('id' => $this->uri->segment(3)));
	foreach($query->result() as $data){}
?>

<p>Delete attachment?</p>

<pre>
	<?= $data->title ?><br />
	<?= $data->id ?>
</pre>

<p align="center">
	<?= anchor('sales', lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('attachment/delete_attachment/'.$data->id.'/', lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>
