<?php
	$query = $this->db->get_where('projects', array('id' => $this->uri->segment(3)));
	foreach($query->result() as $data){}
?>

<p><?= lang('delete_project_confirm') ?></p>

<pre>
	<?= $data->title ?><br />
	<?= $data->description ?>
</pre>

<p align="center">
	<?= anchor('projects', lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('projects/delete_project_confirm/'.$data->id.'/', lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>
