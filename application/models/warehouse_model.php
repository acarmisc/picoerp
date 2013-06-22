<?php

class Warehouse_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'overview',
								'action' => 'warehouse/overview',
								'ico' => 'icon-list-alt'),
					  1 => array('label' => 'new_arrival',
								'action' => 'warehouse/new_arrival',
								'ico' => 'icon-plus')		  					  			
					  );
        return $menu;
	}  
	
	function loadConf(){
		$menu = array();
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
								'creation_date' => array(
											'type' => 'text','widget' => 'date',
											'editable' => true,'viewable' => false,'bind_to' => false,
											'label' => 'creation_date','default' => time()
									),
								'update_date' => array('type' => 'text','widget' => 'date',
											'editable' => false,'viewable' => false,'bind_to' => false,
											'label' => 'update_date','default' => time()
									),
								'product_id' => array('type' => 'int','lenght' => 11,'widget' => 'select',
											'editable' => true,'viewable' => true,'bind_to' => 'products',
											'label' => 'product_id',
											'select_options' => array('select' => 'name',
													'condition_field' =>'id',
													'condition_param' =>'',
													'order_by' => 'name DESC')),
								'name' => array('type' => 'text','lenght' => 200,'widget' => 'text',
											'editable' => true,'viewable' => true,'bind_to' => false,
											'label' => 'name'
									),
								'arrival_date' => array(
											'type' => 'varchar','lenght' => 10,'widget' => 'date',
											'editable' => true,'viewable' => true,'bind_to' => false,
											'label' => 'arrival_date'
									),
								'project_id' => array('type' => 'int','lenght' => 11,'widget' => 'select',
											'editable' => true,'viewable' => true,'bind_to' => 'projects',
											'label' => 'product_id',
											'select_options' => array('select' => 'title',
													'condition_field' =>'id',
													'condition_param' =>'',
													'order_by' => 'name DESC')),
								'delivered_to' => array(
									'type' => 'varchar','widget' => 'textarea',
									'editable' => true,'viewable' => true,'bind_to' => false,
									'label' => 'delivered_to'
									),
								'notes' => array(
									'type' => 'varchar','widget' => 'textarea','editable' => true,
									'viewable' => true,'bind_to' => false,'label' => 'notes'
									),
								'tobe_reintegrated' => array('type' => 'int','lenght' => 11,'widget' => 'text',
											'editable' => true,'viewable' => true,'bind_to' => false,
											'label' => 'tobe_reintegrated'
									),
								'quantity' => array('type' => 'int','lenght' => 11,'widget' => 'text',
											'editable' => true,'viewable' => true,'bind_to' => false,
											'label' => 'quantity'
									),
								'creation_uid' => array('type' => 'int','lenght' => 11,'widget' => 'text',
									'editable' => false,'viewable' => false,'bind_to' => false,
									'label' => 'creation_uid'
									),
								
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
	
	function getWarehouse($params = null){
	
		if($params):
			foreach($params as $p):
				$this->db->where($p['key'], $p['val']);
			endforeach;
		endif;
	
		//$this->db->where('status',1);
	
		$this->db->order_by('id DESC');
		$query = $this->db->get('partners');
	
		return $query->result();
	
	}	
	
}

?>