<?php 

function myModules(){
	$ci=& get_instance();
	
	$rights = $ci->session->userdata('rights');
	
	$els = array();
	foreach($rights as $r):
		if($r->action == 'view'):
			if($r->rule == 'allow'):
				$el = array('name'=> $r->module);
				array_push($els, $el);
			endif;
		endif;
	endforeach;

	return $els;
}

/*

it runs, but too much strict!!!

function checkRights($m,$a,$mode = null){
	$ci=& get_instance();
	$allowed = false;
	
	if(!$mode):	$mode = 'live'; endif;
	
	switch ($mode) {
	    case 'live':
	    	$rights = $ci->session->userdata('rights');
	    	foreach($rights as $r):
	    		if($r->module == $m && $r->action == $a && $r->rule == 'allow'):
	    			$allowed = true;
	    		endif;
	    	endforeach;
	        break;
	    case 'db':
	    	
	        break;
	}

	return $allowed;
	
}
*/

	
function checkRights($m,$a,$mode = null){
	$ci=& get_instance();
	$allowed = true;
	
	if (!$ci->session->userdata('u_logged_in')){
		$allowed = false;	
		
	}else{
	
	if(!$mode):	$mode = 'live'; endif;
	
	switch ($mode) {
	    case 'live':
	    	$rights = $ci->session->userdata('rights');
	    	foreach($rights as $r):
	    		if($r->module == $m && $r->action == $a && $r->rule == 'deny'):
	    			$allowed = false;
	    		endif;
	    	endforeach;
	        break;
	    case 'db':
	    	
	        break;
	}
	}
	return $allowed;
	
}

function createMenu($menu){
	$ci=& get_instance();
	
	foreach($menu as $m): 
		 	if($ci->uri->segment(2) == $m['label']): $s = 'active'; else: $s = ''; endif;
	?>
		    <li class="<?= $s ?>">
		    	<a href="<?= base_url().$m['action'] ?>"><i class="<?= $m['ico'] ?>"></i> <?= lang($m['label']) ?></a>
		    </li>
    <?php
    endforeach;
}
	
?>