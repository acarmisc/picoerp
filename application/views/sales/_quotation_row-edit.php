<form name="quotation_row_form_<?= $id ?>" id="quotation_row_form_<?= $id ?>">
<td>
	<input type="checkbox" id="product-sel-<?= $id ?>" />		
</td>
<td><?= $name ?><br />
	<small><?= $brand ?></small><br />	
	<textarea class="input-small" rows="" name="description" cols=""><?= $description?></textarea>
</td>

<td><input type="text" size="2" class="input-small" value="<?= $quantity ?>" name="quantity" />
<input type="text" size="2" class="input-small" value="<?= $unit ?>" name="unit" /></td>

<td><input type="text" size="4" class="input-small" value="<?= $price_internal ?>" name="price_internal" /> <?= $currency ?></td>
<td><input type="text" size="5" class="input-small" value="<?= $price_external ?>" name="price_external" /> <?= $currency ?></td>
<td><input type="text" size="3" class="input-small" value="<?= $discount ?>" name="discount" />%</td>
<td valign="middle">
	<a href="#" class="save-quotation_row cmd-save" id="quotation_row_edit-<?= $id ?>"><i class="icon-hdd"></i></a>
</td>
</form>