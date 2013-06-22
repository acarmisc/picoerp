<h1>History for file titled <i><?= $data->title ?></i></h1>

<?= anchor($return_to, '< go back') ?>

<?php
	$query = $this->db->get_where('attachments', array('title' => $data->title));
	$res = $query->result();
	
	liveTable($this->attachment_model->modelData('attachments'), 
							array('values' => $res,
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
<?= anchor($return_to, '< go back') ?>