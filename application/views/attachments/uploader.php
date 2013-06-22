<h2><?= lang('attachments') ?></h2>

<?= form_open_multipart('attachment/save_attachment', array('class'=>'well form-horizontal')) ?>

<input type="hidden" name="return_to" 
	value="<?= $return_to ?>" />

<?php liveForm($this->attachment_model->modelData('attachments'), 
				array('layout' => 'horiz',
				'values' => $data)
			); ?>
 
<input type="hidden" name="version" value="<?= $data->version+1 ?>" />
<input type="hidden" name="related_to" value="<?= $data->related_to ?>" />
<input type="hidden" name="related_to_id" value="<?= $data->related_to_id ?>" />
 
 <br />
<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

<?= form_close() ?>

<script lang="javascript">

$(document).ready(function() {
	$('#title').val('<?= $data->title ?>');
});

</script>