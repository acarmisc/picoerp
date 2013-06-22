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
		      <th><?= lang('creation_date') ?></th>		      
   		      <th><?= lang('related_to') ?></th>		      
   		      <th></th>		      
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($wfs as $w): ?>
		    <tr>
		      <td><?= $w->name ?></td>
		      <td><?= $w->description ?></td>
		      <td><?= date('d-m-Y',$w->creation_date) ?></td>		      
		      <td><?= $w->related_to_name ?></td>
		      <td>
			  	<a class="edit-workflow" data-toggle="modal" href="#myModal" id="workflow-<?= $w->id ?>"><i class="icon-eye-open"></i></a>
		      </td>
		    </tr>
		    <?php endforeach; ?>
		  </tbody>
		</table>

    </div>
  </div>
</div>