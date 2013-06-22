    
<?= form_open('administration/create_user/', array('class'=>'well form-horizontal', 'id'=>'user-details')) ?>
	<input type="hidden" name="update_date" value="<?= time() ?>" />	
	<input type="hidden" name="creation_date" value="<?= time() ?>" />	
	<input type="hidden" name="status" value="1" />		
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('username') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="username" name="username" value="">
      </div>
    </div>     

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('password') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="password" name="password" value="">
      </div>
    </div>
  
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('full_name') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="first_name" name="first_name" value="" placeholder="first name">         
        <input type="text" class="input-large" id="second_name" name="second_name" value="" placeholder="second name">
      </div>
    </div>
           
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('email') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="email" name="email" value="">
      </div>
    </div>           
        
<p>
	<button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
</p>

<?= form_close() ?>
	    