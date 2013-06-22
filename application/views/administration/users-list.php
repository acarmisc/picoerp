<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th><?= lang('username') ?></th>
      <th><?= lang('full_name') ?></th>
      <th><?= lang('email') ?></th>		      
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($users as $u): ?>
    <tr>
      <td><?= $u->username ?></td>
      <td><?= $u->second_name ?> <i><?= $u->first_name ?></i></td>
      <td><?= $u->email ?></td>		      
      <td><a href="#" class="user-edit" id="user-<?= $u->id ?>"><i class="icon-pencil"></i></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a title="Add item" data-toggle="modal" href="#myModal" class="users_add btn btn-primary" ><i class="icon-white icon-plus"></i> <?= lang('user_add') ?></a>
<button id="user-list-reload" class="btn"><?= lang('reload') ?></button> 