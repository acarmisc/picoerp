<?php

class Attachment_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

		
	
	function modelData($ret = null){ 
		$data = array('attachments' => array(
							'table_name' => 'attachments',
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
								'userfile' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'file',
									'editable' => true,
									'viewable' => true,
									'bind_to' => false,
									'label' => 'userfile'
									),
								'title' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'text',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'title'
									),
								'description' => array(
									'type' => 'textarea',
									'widget' => 'textarea',
									'editable' => true,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'description'
									),
								'version' => array(
									'type' => 'int',
									'widget' => 'text',
									'editable' => false,
									'viewable' => true,									
									'bind_to' => false,
									'label' => 'version'
									),
								'scope' => array(
									'type' => 'varchar',
									'lenght' => 200,
									'widget' => 'select',
									'select_options' => array('select' => 'label', 
																'condition_field' =>'id',
																'condition_param' =>'',
																'order_by' => 'label DESC'),
									'editable' => true,
									'viewable' => true,									
									'bind_to' => 'scopes',
									'label' => 'scope_id'
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
	
	function getAttachments($params = null){
		
		if($params):
		foreach($params as $p):
			if($p['key'] == 'order_by'){
				$this->db->order_by($p['val']);			
			}else{
				$this->db->where($p['key'], $p['val']);	
			}
		endforeach;
		endif;
		
		$this->db->select('attachments.*, MAX(version) as version');
		$this->db->group_by('title');
		$this->db->order_by('version DESC');
				
		$query = $this->db->get('attachments');
//		echo $this->db->last_query();
		return $query->result();
		
	}	
	
}

?>