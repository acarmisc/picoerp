<p><?= lang('delete_item_confirm') ?></p>

<pre>
	<?= $data[0]->item ?><br />
	<?= $data[0]->description ?>
</pre>

<p align="center">
	<?= anchor('projects/show_project/'.$data[0]->project_id, lang('cancel'), array('class' => 'btn')) ?>
	<?= anchor('projects/delete_item_confirm/'.$data[0]->id.'/'.$data[0]->project_id, lang('delete'), array('class' => 'btn btn-danger')) ?>
</p>