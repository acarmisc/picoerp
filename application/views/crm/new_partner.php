<div id="crm-form">

	<p><?= lang('crm_new_partner_intro') ?></p>

	<?= form_open('crm/save_partner', array('class'=>'well')) ?>

    <legend><?= lang($action).' '.lang('partner') ?></legend>

    	<label class="control-label" for="input01"><?= lang('name') ?></label>
    	<input type="text" class="input-xlarge" id="partner-name" name="name">

    	<label class="control-label" for="input01"><?= lang('vat') ?></label>
    	<input type="text" class="input-xlarge" id="partner-vat" name="vat">
    	<br />
    	
    	<label class="control-label" for="input01">CF</label>
    	<input type="text" class="input-xlarge" id="partner-cf" name="cf">
    	<br />    	

    	<input type="checkbox" name="customer"> <?= lang('customer') ?>
    	<span style="width:20px"></span><input type="checkbox" name="supplier"> <?= lang('supplier') ?>
    	<br />
    	<br />
    	<?= anchor('crm', '<i class="icon-chevron-left"></i> '.lang('back'), array('class'=>'btn')) ?>
    	<button type="submit" class="btn btn-primary"><?= lang('save') ?> & <?= lang('next') ?> <i class="icon-chevron-right icon-white"></i></button>

	<?= form_close() ?>
</div>
