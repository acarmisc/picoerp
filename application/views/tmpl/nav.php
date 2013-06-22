 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?= img('assets/img/logo.png') ?></a>
          <div class="nav-collapse">
            <ul class="nav">
            	<?php 
            		$ms = myModules();

            		foreach($ms as $m):
 	            		 $s = '';
 	            		 if($m['name'] != 'administration'){
            			 if($m['name'] == $this->uri->segment(1)): $s = 'active'; else: $s = ''; endif; ?>
            			<li class="<?= $s ?>"><a href="<?= base_url().$m['name'] ?>"><?= lang($m['name']) ?></a></li>
            	<?php }
            		endforeach;
            	?>

            </ul>
          </div>
	  		<ul class="nav pull-right">
	            <li id="fat-menu" class="dropdown">
	              <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user icon-white"></i><b class="caret"></b></a>
	              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
	              	<a title="Update password" data-toggle="modal" href="#myModal" class="update_password"><?= lang('update_password') ?></a>
    	            <li><a href="<?= base_url() ?>administration"><?= lang('administration') ?></a></li>
    	            <li><a href="<?= base_url() ?>logout"><?= lang('logout') ?></a></li>	

	              </ul>
	            </li>
	          </ul>          
        </div>
      </div>
    </div>
<script>
$('.dropdown-toggle').dropdown()
</script>
    <div class="container-fluid">