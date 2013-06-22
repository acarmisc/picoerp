<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th><?= lang('name') ?></th>
      <th><?= lang('description') ?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($groups as $u): ?>
    <tr>
      <td><?= $u->name ?></td>
      <td><?= $u->description ?></td>
      <td><a href="#" class="group-edit" id="group-<?= $u->id ?>"><i class="icon-pencil"></i></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
			
<button id="group-add" class="btn btn-primary"><?= lang('group_add') ?></button> 
<button id="group-list-reload" class="btn"><?= lang('reload') ?></button> 