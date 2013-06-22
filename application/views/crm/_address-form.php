<div id="crm-address-form">

	      <select name="address_kind" id="address_kind">
		  		<?= ttoselect('informations_kinds') ?>
		  </select>

	<?= form_open('crm/save_address', array('onsubmit'=>'return false', 'class'=>'form-horizontal', 'id'=>'address-details')) ?>

		<?= $this->load->view('crm/_contacts-form-part', array('address_kind'=>1)) ?>

	<?= form_close() ?>
</div>

