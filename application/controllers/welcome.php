<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
                
    }
		
	public function index()
	{
		$this->load->view('welcome/welcome');
	}
	
	public function login()
	{
		if($_POST['username']):
			$username = $_POST['username'];
			$password = $_POST['password'];
		endif;
		$password = md5($password);
		
		$this->db->limit(1);
		$query = $this->db->get_where('users',array('username'=>$username, 'password'=>$password));
		
		if( sizeof($query->result()) > 0):
			// storing data into session
			$u = $query->result();
			
			$this->db->select('groups.name, groups.id');
			$this->db->join('groups', 'groups.id = users_groups.gid');
			$query_g = $this->db->get_where('users_groups', array('uid'=>$u[0]->id));
			$gids = $query_g->result();
			$this->session->set_userdata('groups',$query_g->result());
			$rights = array();
			foreach($gids as $g):
				$this->db->order_by('modules.ordering ASC');	
				$this->db->select('rights.rule, rights.action, rights.module, modules.name, modules.ordering');
				$this->db->join('modules', 'modules.name = rights.module','left');			
				$q = $this->db->get_where('rights', array('gid'=>$g->id,'rights.status'=>1));
				$res = $q->result();
				$rights = array_merge($rights, $res); 
			
			endforeach;
			
			$query_set = $this->db->get('base_settings');
			$settings = $query_set->result();

			$this->session->set_userdata('rights', $rights);
			$this->session->set_userdata('settings', $settings[0]);
			$this->session->set_userdata($u[0]);
			$this->session->set_userdata('u_logged_in',true);
			
			logger(array('description'=>'User logged in', 'event'=>'login'));
			
			redirect('dashboard');
		else:
			logger(array('description'=>'User try to logging in and failed', 'event'=>'login failed'));
			
			redirect('welcome/index/failed');
		endif;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
