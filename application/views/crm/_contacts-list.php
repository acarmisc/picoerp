<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>
			<th><?= lang('email')?></th>	
			<th><?= lang('phone')?></th>
			<th><?= lang('mobile')?></th>			
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if($contacts):
			foreach($contacts as $p): ?>
		<tr>
			<td>
				<input type="checkbox" id="contact-sel-<?= $p->id ?>" />
			</td>	
			<td><a class="edit-contact" data-toggle="modal" href="#myModal" id="contact-<?= $p->id ?>"><?= $p->name.' '.$p->second ?></a></td>
			<td><a href="mailto:<?= $p->email ?>"><?= $p->email ?></a></td>
			<td><?= $p->phone ?></td>			
			<td><?= $p->mobile ?></td>						
			<td>
				<a class="edit-contact" data-toggle="modal" href="#myModal" id="contact-<?= $p->id ?>"><i class="icon-eye-open"></i></a>
				<a href="#" class="delete-contact" id="contact-<?= $p->id ?>"><i class="icon-trash icon-white"></i></a>
			</td>
		</tr>
		<?php endforeach; 
			endif;
		?>
	</tbody>
</table>