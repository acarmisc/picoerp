<?php

class Sales_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'sales/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'new_quote',
								'action' => 'sales/new_quote',
								'ico' => 'icon-plus'),
					  2 => array('label' => 'quote_requests',
					  			'ico' => 'icon-folder-open',
								'action' => 'sales/quote_requests'),
					  3 => array('label' => 'quote_rows_requests',
					  			'action' => 'sales/quote_rows_requests',
								'ico' => 'icon-folder-open'),								
					  4 => array('label' => 'products',
								'action' => 'sales/products',
								'ico' => 'icon-gift'),
					  5 => array('label' => 'ddt',
								'action' => 'sales/ddt',
								'ico' => 'icon-file'),
					  6 => array('label' => 'sals',
								'action' => 'sales/sal',
								'ico' => 'icon-file'),
					  7 => array('label' => 'importing',
								'action' => 'sales/importer',
								'ico' => 'icon-random')				  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array(0 => array('label' => 'templates',
								'action' => 'sales/settings/templates',
								'ico' => 'icon-wrench',
								'level' => 9),
					1 => array('label' => 'mesures',
								'action' => 'sales/settings/mesures',
								'ico' => 'icon-wrench',
								'level' => 9),
					2 => array('label' => 'workflow',
								'action' => 'sales/settings/workflow',
								'ico' => 'icon-tasks',
								'level' => 9)
					  );
        return $menu;
	}    
	
	
	function modelData($ret = null){ 
		$data = array('quotationreq' => array(
							'table_name' => 'quotationreq',
							'fields' => array(
								'id' => array(
									'type' => 'int','lenght' => 11,'extra' => 'auto_increment',
									'widget' => 'text','editable' => false,'viewable' => false,
									'bind_to' => false,'label' => 'id'
									),
								'subject' => array(
									'type' => 'varchar','lenght' => 200,'widget' => 'text',
									'editable' => true,'viewable' => true,'bind_to' => false,
									'label' => 'subject'
									),
								'userfile' => array(
									'type' => 'varchar','widget' => 'file','editable' => true,
									'viewable' => true,'bind_to' => false,'label' => 'userfile'
									),
								'userfile_type' => array(
									'type' => 'varchar','widget' => 'file','editable' => false,
									'viewable' => false,'bind_to' => false,'label' => 'userfile_type'
									),
								'notes' => array(
									'type' => 'varchar','widget' => 'textarea','editable' => true,
									'viewable' => true,'bind_to' => false,'label' => 'notes'
									),
								'creation_date' => array(
									'type' => 'text','widget' => 'date',
									'editable' => true,'viewable' => false,'bind_to' => false,
									'label' => 'creation_date','default' => time()
									),
								'update_date' => array('type' => 'text','widget' => 'date',
									'editable' => false,'viewable' => false,'bind_to' => false,
									'label' => 'update_date','default' => time()
									),
								'wf_step' => array('type' => 'varchar','widget' => 'worflow',
									'editable' => false,'viewable' => false,'bind_to' => false,
									'label' => 'wf_step'
									),
								'creation_uid' => array('type' => 'int','lenght' => 11,'widget' => 'text',
									'editable' => false,'viewable' => false,'bind_to' => false,
									'label' => 'creation_uid'
									),
								'partner_id' => array('type' => 'int','lenght' => 11,'widget' => 'select',
									'editable' => true,'viewable' => true,'bind_to' => 'partners',
									'label' => 'partner_id',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC')
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
	
	function getQuotations($params = null){
		
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
			$this->db->order_by('id DESC');
		}
		

		$this->db->select('quotations.*, partners.name');
		$this->db->join('partners', 'partners.id = quotations.partner_id');
		$query = $this->db->get('quotations');
		return $query->result();
		
	}	
	
	function searchQuotation($params = null){
	
		if($params):
		foreach($params as $p):
			$this->db->like($p['key'], $p['val']);
		endforeach;
		endif;
	
		$this->db->order_by('name DESC');
	
		$this->db->select('quotations.*, partners.name');
		$this->db->join('partners', 'partners.id = quotations.partner_id');
		$query = $this->db->get('quotations');
		return $query->result();
		
	}	
	
	function searchProducts($params = null){
	
		if($params):
			foreach($params as $p):
				$this->db->like($p['key'], $p['val']);
			endforeach;
		endif;
		
		$this->db->order_by('name ASC');
		$query = $this->db->get('products');
	
		return $query->result();
	
	}	

	function getQuotationRows($params = null){
		
		if($params):
			foreach($params as $p):
				$this->db->where($p['key'], $p['val']);
			endforeach;
		endif;
		
		$this->db->select('quotation_rows.*, products.name, products.brand');
		$this->db->join('products', 'products.id = quotation_rows.product_id');

		$query = $this->db->get('quotation_rows');
		
		return $query->result();
		
	}	

	function getProducts($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		$this->db->order_by('name ASC');
		$query = $this->db->get('products');
		
		return $query->result();
		
	}	

	function createQuotation($data){
		$data['status'] = 1;
		$data['creation_uid'] = $this->session->userdata('id');
		$data['creation_date'] = time();
		$data['update_date'] = time();
				
		foreach ($data as &$value):	if ($value == 'on'):$value = 1;endif; 	endforeach;
		
		$this->db->insert('quotations',$data);
		
		return $this->db->insert_id();
	}

	function updateQuotation($data){
		
		$this->db->update('quotations',$_POST, array('id'=>$_POST['id']));
		
		return $this->db->insert_id();
	}
	
	function calculateQuotation($id = null){
		if(!$id){
			$id = $this->session->userdata('current_quotation');
		}
		
		// get quotation rows
		$query = $this->db->get_where('quotation_rows', array('quotation_id'=>$id));
		$qrows = $query->result();
		
		// parsing rows
		$amount = 0.0;
		$taxes = 0.0;
		$i = 0;
		$internal = 0.0;
		
		foreach($qrows as $qr):
			$amount = $amount+ ($qr->price_external*$qr->quantity);
			$internal = $internal+ ($qr->price_internal*$qr->quantity);
			$taxes = $taxes + ($qr->price_external / 100 * $qr->taxes);
			$i++;
		endforeach;
		
		$res = array('amount'=>$amount, 
					 'taxes'=>$taxes,
					 'rows'=>$i,
				     'internal'=>$internal);

		return $res;
	}
	
	function getQuoteRequests($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->select('quotationreq.*, partners.name AS partner_name');
		$this->db->join('partners', 'partners.id = quotationreq.partner_id');
		$query = $this->db->get('quotationreq');
		return $query->result();
		
	}	

	function saveQuotationRequests($data){
		$this->db->insert('quotationreq', $_POST);
	}
	
	function bindReqToQuote($quote, $req){
		$data['creation_uid'] = $this->session->userdata('id');
		$data['creation_date'] = time();
		$data['quotation_id'] = $quote;
		$data['request_id'] = $req;
		
		$this->db->insert('req_quotation',$data);
		
		$this->db->update('quotationreq', array('wf_step' => 'binded'), array('id' => $req));
		
		return $this->db->insert_id();
	}
	
	function getDdts($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;

		$this->db->where('scope_id', 5);
		
		$this->db->select('attachments.*, projects.name as project_name, projects.title as project_title');
		$this->db->join('projects', 'projects.id = attachments.related_to_id');
		$this->db->where('related_to','projects');
		$query = $this->db->get('attachments');
		return $query->result();
		
	}		

	function getSals($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->where('scope_id', 6);
		
		$this->db->select('attachments.*, projects.name as project_name, projects.title as project_title');
		$this->db->join('projects', 'projects.id = attachments.related_to_id');
		$this->db->where('related_to','projects');
		$query = $this->db->get('attachments');
		return $query->result();
		
	}	



	function searchSals($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->like($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->where('scope_id', 6);
		
		$this->db->select('attachments.*, projects.name as project_name, projects.title as project_title');
		$this->db->join('projects', 'projects.id = attachments.related_to_id');
		$this->db->where('related_to','projects');
		$query = $this->db->get('attachments');
		return $query->result();
		
	}	
	
	
	function fetch_full($id){
		
		$this->db->select('quotations.*, partners.name, partners.vat as vat');
		$this->db->join('partners', 'partners.id = quotations.partner_id');

		$this->db->where('quotations.id',$id);
		
		$query = $this->db->get('quotations');
				
		$res = $query->result();
		$query->free_result();

		$this->db->select('quotation_rows.*, products.name as product_name');
		$this->db->join('products', 'products.id = quotation_rows.product_id','left');
		$query_inside = $this->db->get_where('quotation_rows', array('quotation_id' => $id));
		
		$res_inside = $query_inside->result();
		
		foreach($res as $r):
			$data['head'] = $r;
			
			$data['childs'] = $res_inside;
			
		endforeach;
		
		return $data;
		
	}
	
}

?>