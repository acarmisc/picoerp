<div id="attachments-browser">
	<?php 

		$cond = array(
								0 => array('key' => 'related_to', 'val' => $related_to), 
								1 => array('key' => 'related_to_id', 'val' => $related_to_id),
								2 => array('key' => 'order_by', 'val' => 'title, version DESC'),
																						);

		if(isset($scope)){ 
			$cond = array_merge($cond, array(1 => array('key' => 'scope_id', 'val' => $scope)));
		}
		
		liveTable($this->attachment_model->modelData('attachments'), 
							array('values' => $this->attachment_model->getAttachments($cond),
									'show' => 'userfile,title,description,creation_date,version,scope_id',
									'actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete',
																	'target' => '/attachment/delete/',
																	'js_class' => 'delete-attachment'),
													   '2' => array('icon' => 'icon-download',
																	'label' => 'download file',
																	'target' => '/attachment/download/'),
													   '3' => array('icon' => 'icon-refresh',
																	'label' => 'update',
																	'target' => '/attachment/update/'),
													   '4' => array('icon' => 'icon-book',
																	'label' => 'history',
																	'target' => '/attachment/history/'),
														'5' => array('icon' => 'icon-random',
																	'label' => 'share',
																	'target' => '/attachment/send_file_mail/')
														)
								)
						);
		
	?>
</div>

<?php $el= rand(1000,9999) ?>

<p class="pull-right"><button class="btn btn-mini btn-info" onclick="$('#new-box-<?= $el ?>').slideToggle()">Add</button></p>

<div style="display:none" id="new-box-<?= $el ?>">
<?= form_open_multipart('attachment/save_attachment', array('class'=>'well form-horizontal')) ?>
<h2><?= lang('attachments') ?></h2>


<input type="hidden" name="return_to" 
	value="<?= $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" />


<?php if(isset($oncomplete)):
		 ?>
<input type="hidden" name="return_to" value="<?= $oncomplete ?>" />

<?php	
	  endif; 
	  ?>

<?php liveForm($this->attachment_model->modelData('attachments'), 
				array('layout' => 'horiz')
			); ?>
 
<input type="hidden" name="version" value="1" />
<input type="hidden" name="related_to" value="<?= $related_to ?>" />
<input type="hidden" name="related_to_id" value="<?= $related_to_id ?>" />
 
 <br />
<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

<?= form_close() ?>

</div>