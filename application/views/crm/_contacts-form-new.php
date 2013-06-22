<?php
	
	$query = $this->db->get_where('contacts', array('id'=>$id));

    if(sizeof($query->result())>0):
	    foreach($query->result() as $r):
?>

<?= form_open('crm/save_contact'.$r->id, array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'contact-details')) ?>

	<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
		
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('name') ?></label>
      <div class="controls">
        <input type="text" class="input-small fillhead" id="contact-name" name="name" placeholder="<?= lang('name') ?>" value="<?= $r->name ?>">
        <input type="text" class="input-small fillhead" id="contact-second" name="second" placeholder="<?= lang('second') ?>"value="<?= $r->second ?>">
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('role') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="contact-role" name="role"value="<?= $r->role ?>">
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('email') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="contact-email" name="email"value="<?= $r->email ?>">
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('phones') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="contact-phone" name="phone"value="<?= $r->phone ?>"> <?= lang('or') ?>
        <input type="text" class="input-small" id="contact-phone_alt" name="phone_alt" placeholder="<?= lang('phone_alt') ?>"value="<?= $r->phone_alt ?>">       </div>
    </div>    
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('mobile') ?></label>
      <div class="controls">
        <input type="text" class="input-normal" id="contact-mobile" name="mobile"value="<?= $r->mobile ?>">
      </div>
    </div>        

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('notes') ?></label>
      <div class="controls">
        <textarea name="notes"><?= $r->notes ?></textarea>
      </div>
    </div> 

	<button class="btn btn-primary" id="contact-save-submit"><?= lang('save') ?> <i class="icon-plus icon-white"></i></button>
	<span id="contact-save-result"></span>
<?= form_close() ?>


<?php
	    	
	    endforeach;
	    else:
	    ?>
	    <p><?= lang('new_contact_intro') ?>
<?= form_open('crm/save_contact', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'contact-details')) ?>

	<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
		
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('name') ?></label>
      <div class="controls">
        <input type="text" class="input-small fillhead" id="contact-name" name="name" placeholder="<?= lang('name') ?>">
        <input type="text" class="input-small fillhead" id="contact-second" name="second" placeholder="<?= lang('second') ?>">
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('role') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="contact-role" name="role">
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('email') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="contact-email" name="email">
      </div>
    </div>
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('phones') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="contact-phone" name="phone"> <?= lang('or') ?>
        <input type="text" class="input-small" id="contact-phone_alt" name="phone_alt" placeholder="<?= lang('phone_alt') ?>">       </div>
    </div>    
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('mobile') ?></label>
      <div class="controls">
        <input type="text" class="input-normal" id="contact-mobile" name="mobile">
      </div>
    </div>        

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('notes') ?></label>
      <div class="controls">
        <textarea name="notes"></textarea>
      </div>
    </div> 

	<button class="btn btn-primary" id="contact-save-submit"><?= lang('save') ?> <i class="icon-plus icon-white"></i></button>
	<span id="contact-save-result"></span>
<?= form_close() ?>
	    
	    <?php
		    endif;
?>

