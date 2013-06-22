<p><?= lang('new_quotationreq') ?></p>
		

<?= form_open_multipart('sales/quotationreq_save', array('class'=>'well form-horizontal')) ?>

<?php liveForm($this->sales_model->modelData('quotationreq'), 
				array('layout' => 'horiz')
			); ?>
 
 <br />
<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

<?= form_close() ?>
<?= designWorkflow(4, 'new') ?>