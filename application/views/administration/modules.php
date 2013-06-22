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
		<table class="table table-striped table-bordered table-condensed">
		  <thead>
		    <tr>
		      <th><?= lang('name') ?></th>
		      <th><?= lang('description') ?></th>
		      <th><?= lang('author') ?></th>		      
		      <th></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($modules as $u): ?>
		    <tr>
		      <td><?= $u->name ?></td>
		      <td><?= substr($u->description,0,50).'...' ?></td>
		      <td><?= $u->author ?></td>		      
		      <td><a href="#" class="module-edit" id="module-<?= $u->id ?>"><i class="icon-pencil"></i></a></td>
		    </tr>
		    <?php endforeach; ?>
		  </tbody>
		</table>
    </div>
  </div>
</div>