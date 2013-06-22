<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2 well">
    <ul class="nav nav-list">
	  <li class="nav-header">
	    <?= lang('menu') ?>
	  </li>
	 <?php foreach($menu as $m): 
		 	if($this->uri->segment(2) == $m['label']): $s = 'active'; else: $s = ''; endif;
		 	?>
		    <li class="<?= $s ?>">
		    	<a href="<?= base_url().$m['action'] ?>"><i class="<?= $m['ico'] ?>"></i> <?= lang($m['label']) ?></a>
		    </li>
     <?php endforeach; ?>
	</ul>
	    
    </div>
    <div class="span10">
    
    
    <div class="tabbable"> 
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab1" data-toggle="tab"><?= lang('users') ?></a></li>
	    <li><a href="#tab2" data-toggle="tab"><?= lang('groups') ?></a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab1">
		    
		    <?= $this->load->view('administration/users-list') ?>

	    </div>
	    <div class="tab-pane" id="tab2">

		    <?= $this->load->view('administration/groups-list') ?>

	    </div>
	  </div>
	</div>


		
    </div>
  </div>
</div>