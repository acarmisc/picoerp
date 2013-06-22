<p class="alert-warning">The invoice is ready to be sent to customer.Check the informations above.</p>

<?= form_open('actions/send_invoice/'.$invoice[0]->id, array('class' => 'form-horizontal well', 'onsubmit' => '')) ?>
<?php foreach($invoice as $r){ ?>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('to') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="email" value="<?= $partner[0]->email ?>" /> 
      </div>
	</div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="subject" value="invio fattura numero <?= $r->number ?>" /> 
      </div>
	</div>
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('body') ?></label>
      <div class="controls">
        <textarea name="msg" style="width:700px; height:150px;">Gentile cliente,
seguendo il link di seguito riportato potrai scaricare la fattura numero <?= $r->number ?> del <?= $r->invoice_date ?> relativa al tuo ordine.

<?= md5($r->id) ?>


Grazie per la fiducia accordataci.

--
Amministrazione 

        </textarea>
      </div>
	</div>	

<p align="center">
	<button class="btn btn-danger">send now!</button>
</p>

<?php } ?>

<?= form_close() ?>