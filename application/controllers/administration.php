<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        if (checkRights('administration','view','live') != true):	redirect('errors/notallowed');	endif;
        if ($this->uri->segment(2)){
	    	if (checkRights('administration',$this->uri->segment(2),'live') != true):	redirect('errors/notallowed');	endif;    
        }
        $this->load->model('administration_model');
        
    }
		
	public function index()
	{
		$menu = $this->administration_model->loadMenu();

		logger(array('description'=>'user open Administration module', 'event'=>'Administration index'));		

		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/index', array('menu'=>$menu));
		$this->load->view('tmpl/bottom');
	}
	
	public function users()
	{
		$menu = $this->administration_model->loadMenu();
		$users = $this->administration_model->getUsers();
		$groups = $this->administration_model->getGroups();		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/users', array('menu'=>$menu, 
														'users' => $users,
														'groups' => $groups));
		$this->load->view('tmpl/bottom');
	}
	
	public function user_info()
	{
		$u = $this->uri->segment(3);
		$u = str_replace('user-','',$u);
		$users = $this->administration_model->getUsers('id',$u);
		$this->load->view('administration/user-edit', array('users' => $users));
	}
	
	public function preferences()
	{
		$flash_messages = array();
		
		if($this->uri->segment(3) == 'save'){
			//TODO: update DB
			$this->db->update('base_settings', $_POST);
			$flash_messages = array_merge($flash_messages, 
											array(0 => array(
														'type' => 'success',
														'msg' => lang('data_saved_relogin')
														))
										);
		}
	
		$menu = $this->administration_model->loadMenu();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/preferences', array('menu'=>$menu, 'flash_messages'=>$flash_messages));
		$this->load->view('tmpl/bottom');
	}

	public function modules()
	{
		$menu = $this->administration_model->loadMenu();
		$modules = $this->administration_model->getModules();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/modules', array('menu'=>$menu,
														  'modules'=>$modules));
		$this->load->view('tmpl/bottom');
	}		
	
	public function permissions()
	{
		$menu = $this->administration_model->loadMenu();
		$permissions = $this->administration_model->getPermissions();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/permissions', array('menu'=>$menu,
														  'permissions'=>$permissions));
		$this->load->view('tmpl/bottom');
	}	
	
	public function log()
	{
		$menu = $this->administration_model->loadMenu();
		$this->db->limit(1000);
		$this->db->order_by('id desc');
		$this->db->select('log.*, users.username');
		$this->db->join('users','users.id = log.uid');
		$query = $this->db->get('log');
		$events = $query->result();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/log', array('menu'=>$menu,'events' => $events));
		$this->load->view('tmpl/bottom');
	}
	
	public function workflows()
	{
		$menu = $this->administration_model->loadMenu();
		$this->db->select('workflows.*, modules.name as related_to_name');
		$this->db->group_by('related_to');
		$this->db->join('modules', 'related_to = modules.id');
		$query = $this->db->get('workflows');
		$wfs = $query->result();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('administration/workflows', array('menu'=>$menu,'wfs' => $wfs));
		$this->load->view('tmpl/bottom');
	}	
	
	public function workflow_new()
	{	
		$steps = array();
		if($this->uri->segment(3)):
			$this->db->select('workflows_steps.*, groups.name as gname');
			$this->db->join('groups', 'groups.id = workflows_steps.gid');
			$query = $this->db->get_where('workflows_steps', array('wf_id'=>$this->uri->segment(3)));
			$steps = $query->result();
		endif;
		
		$this->load->view('administration/workflows/editor', array('steps'=>$steps));
	}
	
	public function user_form()
	{
		$this->load->view('administration/user_form');
	}
	
	public function create_user()
	{
		$_POST['password'] = md5($_POST['password']);
		
		$this->db->insert('users', $_POST);
		$this->users();
	}
	
	public function update_password_form()
	{
		$this->load->view('administration/update_password_form');
	}
	
	public function update_password()
	{		
		$p = md5($this->uri->segment('4'));
		$this->db->update('users', array('password' => $p), array('id' => $this->uri->segment(3)));
		echo '<span class="alert-success">updated.</span>';
	}
	
	public function update_user_group()
	{
		$gid = $this->uri->segment(4);
		$uid = $this->uri->segment(3);
		
		$query = $this->db->get_where('users_groups', array('gid' => $gid, 'uid' => $uid));
		$res = $query->result();
		
		if(sizeof($res) > 0){
			// record exists
			$this->db->delete('users_groups', array('id' => $res[0]->id));
		}else{
			// record not exists
			$this->db->insert('users_groups', array('gid' => $gid, 'uid' => $uid));
		}
	}
	
	public function save_rule()
	{
		$this->db->insert('rights', $_POST);
		redirect('administration/permissions');
	}
	
	public function delete_rule()
	{
		$this->db->delete('rights', array('id' => $this->uri->segment(3)));
	}
		
}
