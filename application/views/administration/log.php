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
		      <th><?= lang('when') ?></th>
		      <th><?= lang('who') ?></th>
		      <th><?= lang('what') ?></th>		      
   		      <th><?= lang('from') ?></th>		      
   		      <th><?= lang('where') ?></th>		      
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach($events as $e): ?>
		    <tr>
		      <td><?= date('Y-m-d H:i:s',$e->timestamp) ?></td>
		      <td><?= $e->username ?> (UID: <?= $e->uid ?>)</td>
		      <td><?= $e->description ?></td>		      
		      <td><?= $e->ipaddr ?></td>
		      <td><?= $e->event ?></td>
		    </tr>
		    <?php endforeach; ?>
		  </tbody>
		</table>

    </div>
  </div>
</div>