<td>
	<input type="checkbox" id="product-sel-<?= $id ?>" />		
</td>
<td><?= $name ?><br />
	<small><?= $brand ?></small>
	<span><?= $description ?></span>
</td>

<td><?= $quantity ?> <?= $unit ?></td>

<!-- <td><?= $margin ?></td>		 -->
<td><?= money_format('%.2n',$price_internal) ?> </td>
<td><?= money_format('%.2n',$price_external) ?></td>
<td><?= $discount ?> % </td>
<td valign="middle">
	<a href="#" class="edit-quotation_row cmd-edit" id="quotation_row-<?= $id ?>"><i class="icon-pencil"></i></a>
	<a rel="tooltip" title="delete row" data-toggle="modal" href="#myModal" id="quotation_delete_item" name="<?= $id ?>"><i class="icon-trash"></i></a>
</td>