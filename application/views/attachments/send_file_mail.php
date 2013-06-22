<p class="alert-warning">The invoice is ready to be sent to customer.Check the informations above.</p>

<?= form_open('actions/send_file/'.$attachment[0]->id, array('class' => 'form-horizontal well', 'onsubmit' => '')) ?>
<?php foreach($attachment as $r){ ?>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('to') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="email" value="" /> 
      </div>
	</div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('cc') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="email" value="<?= $this->session->userdata('email') ?>" /> 
      </div>
	</div>	

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="subject" value="invio file <?= $r->title ?>" /> 
      </div>
	</div>
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('body') ?></label>
      <div class="controls">
        <textarea name="msg" style="width:700px; height:150px;">Ciao,
seguendo il link di seguito riportato potrai scaricare il file <?= $r->userfile ?> che desideriamo condividere con te.

<?= md5($r->id) ?>


A presto.

--

        </textarea>
      </div>
	</div>	

<p align="center">
	<button class="btn" onclick="history.back()">back!</button>
	<button class="btn btn-danger">send now!</button>
</p>

<?php } ?>

<?= form_close() ?>