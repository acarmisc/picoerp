<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2 well">
    <ul class="nav nav-list">
	  <li class="nav-header">
	    <?= lang('menu') ?>
	  </li>
	 <?php createMenu($menu); ?>
	 
	 <?php if(isset($conf)): ?>
	 <li class="nav-header">
	    <?= lang('configuration') ?>
	  </li>
	 <?php createMenu($conf); ?>
	 <?php endif; ?>
	</ul>
	    
    </div>
    
    <div class="span10" id="main-space">