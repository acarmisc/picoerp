<p><?= lang('delete_item_confirm') ?></p>

<pre>
	
	<?= $data[0]->id?>
</pre>

<p align="center">
	<?= anchor('sales/show_quotation/'.$data[0]->quotation_id, lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('sales/delete_item_confirm/'.$data[0]->id.'/'.$data[0]->quotation_id, lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>