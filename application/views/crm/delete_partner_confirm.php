<p><?= lang('delete_partner_confirm') ?></p>

<pre>
	<?= $data[0]->name ?><br />
	<?= $data[0]->email ?>
	
</pre>

<p align="center">
	<?= anchor('crm', lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('crm/delete_partner_confirm/'.$data[0]->id, lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>