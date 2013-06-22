<?php foreach($row as $r): ?>

<form method="post" name="<?= $r->id ?>" id="purchase_request_item_edit" onsubmit="return false">

<h3><?= $r->item ?></h3>

<input type="hidden" name="purchase_request_id" value="<?= $r->purchase_request_id ?>" />

<p><label><?= lang('description') ?></label><br />
<textarea name="description"><?= $r->description ?></textarea></p>

<p><label><?= lang('qty') ?></label><br />
<input type="text" class="input-xsmall" name="qty" value="<?= $r->qty ?>" /></p>

<p align="center"><button id="purchase_request_item_edit_submit" class="btn btn-primary"><?= lang('update') ?></button></p>


</form>

<?php endforeach; ?>