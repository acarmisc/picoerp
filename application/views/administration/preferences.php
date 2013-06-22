<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2 well">
    <ul class="nav nav-list">
	  <li class="nav-header">
	    <?= lang('menu') ?>
	  </li>
	 <?php createMenu($menu); ?>
	</ul>
	    
    </div>
    <div class="span10">
			<p><?= lang('preferences_form_intro') ?></p>
		
			<?= showFlashes($flash_messages) ?>
		
			<?= form_open('administration/preferences/save', array('class'=>'well form-horizontal')) ?>

			<?php liveForm($this->administration_model->modelData('preferences'), 
							array('layout' => 'horiz', 
								   'values' => $this->session->userdata('settings')
								   )
						); ?>
			 
			 <br />
		    <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
		
			<?= form_close() ?>
		</div>

    </div>
  </div>
</div>