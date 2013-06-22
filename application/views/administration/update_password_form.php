<div class="control-group">
      <label class="control-label" for="input01"><?= lang('password') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="password" name="password" value="">
        
        	<button class="btn btn-primary" onclick="updatePassword(<?= $this->session->userdata('u_logged_in') ?>,$('#password').val())"><?= lang('save') ?></button>
      </div>
    </div>
  <div id="updateRes"></div>