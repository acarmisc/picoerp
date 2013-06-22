<?php 
	function logger($params){
		$ci=& get_instance();
		
		$description = $params['description'];
		$event = $params['event'];
		$timestamp = time();
		$ipaddr = $ci->session->userdata('ip_address');
		$uagent = $ci->session->userdata('user_agent');
		
		if($ci->session->userdata('id') != ''):
			$uid = $ci->session->userdata('id');
		else:
			$uid = 0;
		endif;
		
		$data = array(
			'timestamp' => $timestamp,
			'ipaddr' => $ipaddr,
			'uagent' => $uagent,
			'uid' => $uid
		);
		
		$data = array_merge($params, $data);
		
		$ci->db->insert('log', $data);
		
	}
	
?>