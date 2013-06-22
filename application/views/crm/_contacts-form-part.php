<?php

	$query = $this->db->get_where('partner_addresses', array('partner_id'=>$this->session->userdata('current_partner'), 
														   'address_kind'=>$address_kind));

    if(sizeof($query->result())>0):
    foreach($query->result() as $r):

?>

<div class="control-group">
		<input type="hidden" name="address_kind" value="<?= $address_kind ?>" />
		<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
		
	      <label class="control-label"><?= lang('street') ?></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="partner-street" name="street" value="<?= chem($r->street) ?>">
	      </div>
	    </div>

		<div class="control-group">
	      <label class="control-label"><?= lang('city') ?> & <?= lang('zip') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="partner-street" name="city" value="<?= chem($r->city) ?>">
   	        <input type="text" class="input-small" id="partner-street" name="zip" placeholder="<?= lang('zip') ?>" value="<?= chem($r->zip) ?>">
	      </div>
	    </div>
	    
		<div class="control-group">
	      <label class="control-label"><?= lang('province') ?> & <?= lang('state') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="partner-street" name="province" value="<?= chem($r->province) ?>">
   	        <input type="text" class="input-small" id="partner-street" name="state" placeholder="<?= lang('state') ?>" value="<?= chem($r->state) ?>">
	      </div>
	    </div>	
	    
	    <div class="control-group">
	      <label class="control-label"><?= lang('email') ?></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="partner-street" name="email" value="<?= chem($r->email) ?>">
	      </div>
	    </div>    

		<div class="control-group">
	      <label class="control-label"><?= lang('phone') ?> & <?= lang('fax') ?></label>
	      <div class="controls">
	        <input type="text" class="input-small" id="partner-street" name="phone" placeholder="<?= lang('phone') ?>" value="<?= chem($r->phone) ?>">
   	        <input type="text" class="input-small" id="partner-street" name="fax" placeholder="<?= lang('fax') ?>" value="<?= chem($r->fax) ?>">
	      </div>
	    </div>	
    	
    	<button id="address-save-submit" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> <?= lang('save') ?></button> <span id="address-save-result"></span>
    	
    	<?php endforeach; 
	    	else:
    	?>
<div class="control-group">
		<input type="hidden" name="address_kind" value="<?= $address_kind ?>" />
		<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
		
	      <label class="control-label"><?= lang('street') ?></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="partner-street" name="street">
	      </div>
	    </div>

		<div class="control-group">
	      <label class="control-label"><?= lang('city') ?> & <?= lang('zip') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="partner-street" name="city">
   	        <input type="text" class="input-small" id="partner-street" name="zip" placeholder="<?= lang('zip') ?>">
	      </div>
	    </div>
	    
		<div class="control-group">
	      <label class="control-label"><?= lang('province') ?> & <?= lang('state') ?></label>
	      <div class="controls">
	        <input type="text" class="input-large" id="partner-street" name="province">
   	        <input type="text" class="input-small" id="partner-street" name="state" placeholder="<?= lang('state') ?>">
	      </div>
	    </div>	
	    
	    <div class="control-group">
	      <label class="control-label"><?= lang('email') ?></label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="partner-street" name="email">
	      </div>
	    </div>    

		<div class="control-group">
	      <label class="control-label"><?= lang('phone') ?> & <?= lang('fax') ?></label>
	      <div class="controls">
	        <input type="text" class="input-small" id="partner-street" name="phone" placeholder="<?= lang('phone') ?>">
   	        <input type="text" class="input-small" id="partner-street" name="fax" placeholder="<?= lang('fax') ?>">
	      </div>
	    </div>	
    	
    	<button id="address-save-submit" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> <?= lang('save') ?></button> <span id="address-save-result"></span>
    	<?php endif; ?>