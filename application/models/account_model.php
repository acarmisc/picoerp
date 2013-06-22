<?php

class Account_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'account/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'deadlines',
								'action' => 'account/deadlines',
								'ico' => 'icon-calendar')			  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array(0 => array('label' => 'reports',
								'action' => 'account/settings/reports',
								'ico' => 'icon-wrench',
								'level' => 9)
					  );
        return $menu;
	}      
	
		
	
	function modelData($ret = null){ 
		$data = array('invoice' => array(
							'table_name' => 'invoices',
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
								'number' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,
									'bind_to' => false,
									'label' => 'number'
									),
								'direction' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'select',
									'select_options' => array('select' => 'label', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'label DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'directions',
									'label' => 'direction'
									),									
								'description' => array(
									'type' => 'text',
									'widget' => 'textarea',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'description'
									),
								'creation_date' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'date',
									'editable' => false,
									'viewable' => false,									
									'bind_to' => false,
									'default' => time(),
									'label' => 'creation_date'
									),
								'customer_order' => array(
											'type' => 'varchar',
											'lenght' => 200,
											'widget' => 'text',
											'editable' => true,
											'viewable' => true,
											'bind_to' => false,
											'default' => '',
											'label' => 'customer_order'
									),
								'partner_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC',
																'blank'=>true),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'partners',
									'label' => 'partner_id'
									),
								'project_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => false,
									'viewable' => false,									
									'bind_to' => 'projects',
									'label' => 'project_id'
									),
								'purchase_order_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'subject', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'subject DESC',
																'blank'=>true),
									'editable' => true,
									'viewable' => false,									
									'bind_to' => 'purchases',
									'label' => 'purchase_order_id'
									),							
								'sal_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'title', 
																'condition_param' =>'6',
																'filter_by' => 'scope_id',
																'order_by' => 'title DESC',
																'blank'=>true,
																'skippable'=>true),
									'editable' => false,
									'viewable' => true,									
									'bind_to' => 'attachments',
									'label' => 'sal_id'
									),
								'wf_flow' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'name as workflow_name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => false,
									'viewable' => false,									
									'bind_to' => 'workflows',
									'label' => 'workflow_name'
									),
								'wf_step' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'worflow',
									'editable' => false,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'wf_step'
									),
								'amount' => array(
									'type' => 'money',
									'lenght' => 200,
									'widget' => 'money',
									'editable' => true,
									'viewable' => true,									
									'label' => 'amount'
									),
								'amount_untaxed' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'money',
									'editable' => true,
									'viewable' => true,									
									'label' => 'amount_untaxed'
									),
								'residual' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'money',
									'editable' => false,
									'viewable' => false,									
									'label' => 'residual'
									),
								'transfer' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'money',
									'editable' => true,
									'viewable' => true,									
									'label' => 'transfer'
									),
								'taxes' => array(
									'type' => 'varchar',
									'lenght' => 5,
									'widget' => 'percent',
									'editable' => true,
									'viewable' => true,									
									'label' => 'taxes'
									),
								'period' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'period'
									),
								'progress_percentage' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'progress_percentage'
									),
								'progress_step' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'progress_step'
									),
								'payment_method_id' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'select',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'payment_methods',
									'label' => 'payment_method_id',
									'translate' => true
									),
								'date_due' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'date',
									'editable' => true,
									'viewable' => true,									
									'label' => 'date_due'
									),
								'invoice_date' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'date',
									'editable' => true,
									'viewable' => true,									
									'label' => 'invoice_date'
									)
								)
						),
					'invoice_line' => array(
							'table_name' => 'invoice_lines',
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
								'product_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'products',
									'label' => 'product_id'
									),
								'partner_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'name', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'partners',
									'label' => 'partner_id'
									),
								'invoice_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'number', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'name DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'invoices',
									'label' => 'invoice_id'
									),
								'price_external' => array(
									'type' => 'float',
									'lenght' => 11,
									'widget' => 'currency',
									'editable' => true,
									'viewable' => true,									
									'label' => 'price_external'
									),
								'printable' => array(
									'type' => 'int',
									'lenght' => 1,
									'widget' => 'bool',
									'editable' => true,
									'viewable' => true,									
									'label' => 'printable'
									),
								'quantity' => array(
									'type' => 'int',
									'lenght' => 1,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'quantity'
									),
								'unit' => array(
									'type' => 'varchar',
									'lenght' => 1,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'unit'
									),
								'taxes' => array(
									'type' => 'float',
									'lenght' => 1,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'taxes'
									),
								'creation_date' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'date',
									'editable' => false,
									'viewable' => false,									
									'bind_to' => false,
									'default' => time(),
									'label' => 'creation_date'
									)
							)
					),
					'payments' => array(
							'table_name' => 'invoice_payments',
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
								'invoice_id' => array(
									'type' => 'int',
									'lenght' => 11,
									'widget' => 'select',
									'select_options' => array('select' => 'number', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'number DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'invoices',
									'label' => 'invoice_id'
									),
								'amount' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'label' => 'amount'
									),
								'creation_date' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'date',
									'editable' => true,
									'viewable' => true,									
									'label' => 'creation_date'
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
	
	function getPayments($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->select('invoice_payments.*, invoices.number as number', FALSE);
		$this->db->join('invoices', 'invoices.id = invoice_payments.invoice_id');
		$query = $this->db->get('invoice_payments');
		
		return $query->result();
		
	}	
	
	function getInvoices($params = null, $year = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		if($year){
			$this->db->like('invoice_date',$year);
		}
		
		$this->db->order_by('number DESC');
		
		$this->db->select('invoices.*, partners.name as partner, directions.label as direction_name', FALSE);
		$this->db->join('partners', 'partners.id = invoices.partner_id');
		$this->db->join('directions', 'directions.id = invoices.direction');
		$query = $this->db->get('invoices');
		
		return $query->result();
		
	}
	
	function getInvoicesLimited($num){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;
		
		$this->db->order_by('invoice_date DESC, direction DESC');
		
		$this->db->select('invoices.*, partners.name as partner, directions.label as direction_name', FALSE);
		$this->db->join('partners', 'partners.id = invoices.partner_id');
		$this->db->join('directions', 'directions.id = invoices.direction');
		
		$this->db->limit($num);
		
		$query = $this->db->get('invoices');
		
		return $query->result();
		
	}
		
	
	function getLines($params = null){
		
		if($params):
		foreach($params as $p):
			$this->db->where($p['key'], $p['val']);
		endforeach;
		endif;

		$query = $this->db->get('invoice_lines');
		
		return $query->result();
		
	}

	function calculateInvoice($id){
		$res = array('rows' => 1, 'amount' => 10, 'taxes'=> 1.21);
		return $res;
	}


	function fetch_full($id){
	
		$this->db->select('invoices.*, payment_methods.name as payment, partners.name as partner_name, partners.vat as vat, projects.name as project_name, projects.title as project_title, projects.ordine_cliente as project_order');
		$this->db->join('partners', 'partners.id = invoices.partner_id','left');
		$this->db->join('projects', 'projects.id = invoices.project_id','left');
		$this->db->join('payment_methods', 'payment_methods.id = invoices.payment_method_id','left');
	
		$this->db->where('invoices.id',$id);
	
		$query = $this->db->get('invoices');
	
		$res = $query->result();
		$query->free_result();
	
		
	
		foreach($res as $r):
		$data['head'] = $r;
			
		endforeach;
	
		return $data;
	
	}
	
}

?>