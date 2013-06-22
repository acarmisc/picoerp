<?php

class Purchases_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'purchases/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'purchase_requests',
								'action' => 'purchases/purchase_requests',
								'ico' => 'icon-list-alt')			  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array(0 => array('label' => 'categories',
								'action' => 'purchases/settings/',
								'ico' => 'icon-wrench',
								'level' => 9)
					  );
        return $menu;
	}    


	function getPurchases($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$title = $_GET['reorder_by'];
		if(isset($title)){
			if($this->session->userdata('last_order') == 'DESC'){ $dir = 'ASC';}else{$dir='DESC';}
			$this->session->set_userdata('last_order',$dir);
			$this->db->order_by("$title $dir");
			
		}else{
			$this->db->order_by('number DESC');
		}
		
		$this->db->select('purchases.*, partners.name');
		$this->db->join('partners', 'partners.id = purchases.partner_id');
		$query = $this->db->get('purchases');
		return $query->result();
		
	}	
	
	function searchPurchases($params = null){
	
		if($params):
		foreach($params as $p):
			$this->db->like($p['key'], $p['val']);
		endforeach;
		endif;
		
		$title = $_GET['reorder_by'];
		if(isset($title)){
			if($this->session->userdata('last_order') == 'DESC'){ $dir = 'ASC';}else{$dir='DESC';}
			$this->session->set_userdata('last_order',$dir);
			$this->db->order_by("$title $dir");
			
		}else{
			$this->db->order_by('id ASC');
		}
		
		$this->db->select('purchases.*, partners.name');
		$this->db->join('partners', 'partners.id = purchases.partner_id');
		$query = $this->db->get('purchases');
		return $query->result();
		
		
	}	
	
	function getPurchasesRequests($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->select('purchase_request.*, projects.name');
		$this->db->join('projects', 'projects.id = purchase_request.project_id');
		$query = $this->db->get('purchase_request');
		return $query->result();
		
	}		
	
	function modelData($ret = null){ 
		$data = array('purchase_request' => array(
							'table_name' => 'purchase_request',
							'fields' => array(
								'id' => array(
									'type' => 'int',
									'lenght' => 11,
									'extra' => 'auto_increment',
									'widget' => 'text',
									'editable' => false,
									'viewable' => false,									
									'bind_to' => false,
									'label' => 'id'
									),
								'creation_date' => array(
									'type' => 'varchar',
									'lenght' => 100,
									'widget' => 'date',
									'editable' => false,
									'viewable' => true,									
									'label' => 'creation_date'
									),
								'creation_uid' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'hidden',
									'editable' => false,
									'viewable' => false,									
									'label' => 'creation_uid',
									'default' => $this->session->userdata('u_logged_in')
									),
								'update_date' => array(
									'type' => 'varchar',
									'lenght' => 100,
									'widget' => 'hidden',
									'editable' => false,
									'viewable' => true,									
									'label' => 'creation_date',
									'default' => time()
									),
								'subject' => array(
									'type' => 'varchar','lenght' => 200,'widget' => 'text',
									'editable' => true,'viewable' => true,'bind_to' => false,
									'label' => 'subject'
									),
								'notes' => array(
									'type' => 'varchar','widget' => 'textarea','editable' => true,
									'viewable' => true,'bind_to' => false,'label' => 'notes'
									),
								'wf_step' => array('type' => 'varchar','widget' => 'worflow',
									'editable' => false,'viewable' => false,'bind_to' => false,
									'label' => 'wf_step'
									),
								'project_id' => array('type' => 'int','lenght' => 11,'widget' => 'select',
									'editable' => true,'viewable' => true,'bind_to' => 'projects',
									'label' => 'project_id',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
								
								'userfile' => array(
									'type' => 'varchar','widget' => 'file','editable' => true,
									'viewable' => true,'bind_to' => false,'label' => 'userfile'
									)
							)
						)
					)
					);
		if(isset($ret)){
			return $data[$ret];				
		}else{
			return $data;			
		}

	}
	
	function fetch_full($id){
		
		$this->db->select('purchases.*, partners.name as partner_name, partners.vat as vat, projects.name as project_name, projects.title as project_title');
		$this->db->join('partners', 'partners.id = purchases.partner_id','left');
		$this->db->join('projects', 'projects.id = purchases.project_id','left');
		
		$this->db->where('purchases.id',$id);
		
		$query = $this->db->get('purchases');
		
		$res = $query->result();
		$query->free_result();

		$this->db->select('purchase_rows.*, project_items.item');
		$this->db->join('project_items', 'project_items.id = purchase_rows.project_item_id','left');
		$query_inside = $this->db->get_where('purchase_rows', array('purchase_id' => $id));
		
		$res_inside = $query_inside->result();
		
		foreach($res as $r):
			$data['head'] = $r;
			
			$data['childs'] = $res_inside;
			
		endforeach;
		
		return $data;
		
	}
	
	function fetch_full_request($id){
		
		$this->db->select('purchase_request.*, partners.name, projects.name as project_name, projects.title as project_title');
		$this->db->join('partners', 'partners.id = purchase_request.supplier_id');
		$this->db->join('projects', 'projects.id = purchase_request.project_id');
		
		$this->db->where('purchase_request.id',$id);
		
		$query = $this->db->get('purchase_request');
		
		$res = $query->result();
		$query->free_result();

		$this->db->select('purchase_request_rows.*, project_items.item');
		$this->db->join('project_items', 'project_items.id = purchase_request_rows.project_item_id');
		$query_inside = $this->db->get_where('purchase_request_rows', array('purchase_request_id' => $id));
		
		$res_inside = $query_inside->result();
		
		foreach($res as $r):
			$data['head'] = $r;
			
			$data['childs'] = $res_inside;
			
		endforeach;
		
		return $data;
		
	}	
	
}

?>