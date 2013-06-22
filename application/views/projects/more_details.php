<?= form_open_multipart('projects/save_pic', array('class'=>'form-horizontal')) ?>
 
<input type="hidden" name="id" value="<?= $id ?>" />
<label>Avatar</label>
<input type="file" name="userfile" /> 
 <br />
<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

<?= form_close() ?>

