<h2><?= lang('attachments') ?></h2>


<?= form_open_multipart('attachment/save_attachment', array('class'=>'well form-horizontal')) ?>

<input type="hidden" name="return_to" 
	value="<?= $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" />

<?php liveForm($this->attachment_model->modelData('attachments'), 
				array('layout' => 'horiz')
			); ?>
 
<input type="hidden" name="related_to" value="invoice" />
<input type="hidden" name="related_to_id" value="<?= $this->uri->segment(3) ?>" />
 
 <br />
<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

<?= form_close() ?>


<div id="attachments-browser">
	<?php 
		
		liveTable($this->attachment_model->modelData('attachments'), 
							array('values' => $this->attachment_model->getAttachments(array(
								0 => array('key' => 'related_to', 'val' => 'invoice'), 
								1 => array('key' => 'related_to_id', 'val' => $this->uri->segment(3)),
								2 => array('key' => 'order_by', 'val' => 'title, version DESC'),
																						)),
									'show' => 'userfile,title,version,description,creation_date,version,scope_id',
									'actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete',
																	'target' => '/attachment/delete/'),
													   '2' => array('icon' => 'icon-download',
																	'label' => 'download file',
																	'target' => '/attachment/download/'),
													   '3' => array('icon' => 'icon-refresh',
																	'label' => 'update',
																	'target' => '/attachment/update/')
														)
								)
						);
		
	?>
</div>