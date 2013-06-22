<?php

class Administration_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function loadMenu(){
		$menu = array(0 => array('label' => 'preferences',
								'action' => 'administration/preferences',
								'ico' => 'icon-wrench'),
					  1 => array('label' => 'users',
					  			'action' => 'administration/users',
					  			'ico' => 'icon-user'),
					  2 => array('label' => 'modules',
					  			'action' => 'administration/modules',
					  			'ico' => 'icon-gift'),
					  3 => array('label' => 'permissions',
					  			'action' => 'administration/permissions',
					  			'ico' => 'icon-fire'),
  		  			  4 => array('label' => 'workflows',
					  			'action' => 'administration/workflows',
					  			'ico' => 'icon-tasks'),
					  5 => array('label' => 'log',
					  			'action' => 'administration/log',
					  			'ico' => 'icon-list')
					  );
					  
					  
        return $menu;
	}    
	
	function getUsers($cond = null, $val = null){
		if($cond):
			$this->db->where($cond,$val);
		endif;
		$this->db->order_by('username DESC');
		$query = $this->db->get('users');
		
		return $query->result();
	}

	function getGroups($cond = null, $val = null){
		if($cond):
			$this->db->where($cond,$val);
		endif;
		$this->db->order_by('name DESC');
		$query = $this->db->get('groups');
		
		return $query->result();
	}

	function getModules($cond = null, $val = null){
		if($cond):
			$this->db->where($cond,$val);
		endif;
		$this->db->order_by('name DESC');
		$query = $this->db->get('modules');
		
		return $query->result();
	}
	
	function getPermissions($cond = null, $val = null){
		if($cond):
			$this->db->where($cond,$val);
		else:
			$this->db->group_by('module');
		endif;
		$query = $this->db->get('rights');
		
		return $query->result();
	}	
	
	function getPermissionsDetails($module){
		$this->db->select('rights.id, name, action, rule, module, status');
		$this->db->where('module',$module);
		$this->db->join('groups', 'groups.id = rights.gid');
		$query = $this->db->get('rights');
		return $query->result();
	}
	
	
	function modelData($ret = null){ 
		$data = array('preferences' => array(
							'table_name' => 'base_settings',
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
								'site_name' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,
									'bind_to' => false,
									'label' => 'site_name'
									),
								'order_request_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'order_request_code'
									),
								'quotation_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'quotation_code'
									),
								'project_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'project_code'
									),
								'purchase_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'purchase_code'
									),
								'invoice_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'invoice_code'
									),
								'default_language' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'select',
									'select_options' => array('select' => 'label', 
																'condition_field' =>'code',
																'condition_param' =>'',
																'order_by' => 'label DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'languages',
									'label' => 'default_language'
									),
								'licence_code' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'licence_code'
									),
								'licence_expire' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => false,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'licence_expire'
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
	
}

?>