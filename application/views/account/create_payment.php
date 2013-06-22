<?= form_open('account/payment_save/'.$this->uri->segment(3), array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'invoice-details')) ?>
			
			<?php liveForm($this->account_model->modelData('payments'), 
							array('layout' => 'horiz'
								   )
						); ?>
			
			<input type="submit" class="btn btn-primary" value="<?= lang('create') ?>" />
			
<?= form_close() ?>
