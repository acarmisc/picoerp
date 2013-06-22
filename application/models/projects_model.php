<?php

class Projects_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'projects/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'sal',
								'action' => 'projects/sals',
								'ico' => 'icon-thumbs-up')			  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array(0 => array('label' => 'activities',
								'action' => 'projects/settings/activities',
								'ico' => 'icon-wrench',
								'level' => 9)
					  );
        return $menu;
	}    

	function getProjects($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		
		$title = $_GET['reorder_by'];
		if(isset($title)){
			if($this->session->userdata('last_order') == 'DESC'){
				$dir = 'ASC';
			}else{$dir='DESC';
			}
			$this->session->set_userdata('last_order',$dir);
			$this->db->order_by("$title $dir");
				
		}else{
			$this->db->order_by('name ASC');
		}
		
		$this->db->select('projects.*, partners.name as partner, CONCAT(ci_users.first_name," ",users.second_name) as projectmanger', FALSE);
		$this->db->join('partners', 'partners.id = projects.partner_id','left');
		$this->db->join('users', 'users.id = projects.projectmanager_id','left');
		$query = $this->db->get('projects');
		
		return $query->result();
		
	}	
	
	function searchProjects($params = null){
	
		if($params):
		foreach($params as $p):
			$this->db->like($p['key'], $p['val']);
		endforeach;
		endif;
	
		$this->db->order_by('name DESC');
	
		$this->db->select('projects.*, partners.name as partner, CONCAT(ci_users.first_name," ",users.second_name) as projectmanger', FALSE);
		$this->db->join('partners', 'partners.id = projects.partner_id','left');
		$this->db->join('users', 'users.id = projects.projectmanager_id','left');
		$query = $this->db->get('projects');
		
		return $query->result();
		
		
	
	}	

	function createProject($data){
		$data['status'] = 1;
		$data['creation_uid'] = $this->session->userdata('id');
		$data['creation_date'] = time();
		$data['update_date'] = time();
		$data['wf_flow'] = '2';		
		$data['wf_step'] = 'fresh';		
		
		foreach ($data as &$value):	if ($value == 'on'):$value = 1;endif; 	endforeach;
		
		$this->db->insert('projects',$data);
		
		$prj = $this->db->insert_id();
		
		// generating activities from quotation rows
		$this->db->select('quotation_rows.*, products.name as product');
		$this->db->join('products', 'products.id = quotation_rows.product_id');
		$query = $this->db->get_where('quotation_rows', array('quotation_id' => $data['quotation_id']));
		foreach($query->result() as $r):
			$item['item'] = $r->product;
			$item['product_id'] = $r->product_id;			
			$item['pos'] = '';
			$item['description'] = '';
			$item['qty'] = $r->quantity;
			$item['unit'] = $r->unit;			
			$item['delivery_time'] = '';
			$item['order_date'] = '';
			$item['supplier_id'] = $r->supplier_id;
			$item['price'] = $r->price_internal;
			$item['price_budget'] = $r->price_budget;
			$item['price_sold'] = 0;
			$item['notes'] = '';
			$item['creation_date'] = time();
			$item['creation_uid'] = $this->session->userdata('id');
			$item['update_date'] = time();
			$item['currency'] = $r->currency;	
			$item['project_id'] = $prj;	
			
			$this->db->insert('project_items', $item);
			
		endforeach;
		
		return $prj;
		
	}			
	
	function getProjectComplete($params = null){
		
		$res = array();
		
		if($params):
			foreach($params as $p):
				$this->db->where($p['key'], $p['val']);
			endforeach;
		endif;
		
		$this->db->select('projects.*, partners.name as partner, CONCAT(ci_users.first_name," ",users.second_name) as projectmanger', FALSE);
		$this->db->join('partners', 'partners.id = projects.partner_id');
		$this->db->join('users', 'users.id = projects.projectmanager_id');
		$query = $this->db->get('projects');
		
		$res[0] = $query->result();
		
		/*
		$this->db->select('project_items.*, partners.name as supplier');
		$this->db->join('partners', 'partners.id = project_items.supplier_id', 'left');
		$query2 = $this->db->get_where('project_items', array('project_id' => $p['val']));
		*/
		
		$this->db->select('project_items.*, products.brand');
		$this->db->join('products', 'project_items.product_id = products.id');
		$this->db->order_by('code asc');
		$query2 = $this->db->get_where('project_items', array('project_id' => $p['val']));
		
		$res[1] = $query2->result();
		return $res;
		
	}
	
	public function getItem($id){
		$this->db->select('project_items.*, partners.name as supplier, products.name as product');
		$this->db->join('partners', 'partners.id = project_items.supplier_id', 'left');
		$this->db->join('products', 'products.id = project_items.product_id', 'left');		
		$query = $this->db->get_where('project_items', array('project_items.id' => $id));
		
		$res[1] = $query->result();
		return $res;
	}
	
	public function saveItem($data){
		
		$data['update_date'] = time();
		
		$this->db->update('project_items', $data, array('id' => $this->uri->segment(3)));
		
	}
			
}

?>