<?php

class Crm_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'crm/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'new_partner',
								'action' => 'crm/new_partner',
								'ico' => 'icon-user'),
					  2 => array('label' => 'importing',
								'action' => 'crm/importer',
								'ico' => 'icon-random')				  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array(0 => array('label' => 'categories',
								'action' => 'crm/settings/categories',
								'ico' => 'icon-wrench',
								'level' => 9),
					  1 => array('label' => 'kinds',
								'action' => 'crm/settings/kinds',
								'ico' => ' icon-wrench',
								'level' => 9)
					  );
        return $menu;
	}    
	
	function getPartners($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->where('status',1);
		
		$this->db->order_by('name ASC');
		$query = $this->db->get('partners');
		
		return $query->result();
		
	}
	
	function getContacts($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$query = $this->db->get('contacts');
		
		return $query->result();
		
	}	
	
	function createPartner($data){
		$data['status'] = 1;
		$data['creation_uid'] = $this->session->userdata('id');
		$data['creation_date'] = time();
		$data['update_date'] = time();
		
		foreach ($data as &$value):	if ($value == 'on'):$value = 1;endif; 	endforeach;
		
		$this->db->insert('partners',$data);
		
		return $this->db->insert_id();
	}
	
	function getHistory($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$query = $this->db->get('quotations');
		
		return $query->result();
		
	}	
	
	function getInvoices($params = null){
	
		if($params):
		foreach($params as $p):
		$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
	
		$query = $this->db->get('invoices');
	
		return $query->result();
	
	}	
	
}

?>