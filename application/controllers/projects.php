<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	
		
 	public function __construct()
    {
        parent::__construct();
        if (checkRights('projects','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
        $this->load->model('projects_model');    
        $this->load->helper('projects_helper');       
        $this->load->model('attachment_model');                   
    }
		
	public function overview(){
		$this->index();	
	}
	
	public function index()
	{

		logger(array('description'=>'user open Projects module', 'event'=>'Projects index'));			

		$menu = $this->projects_model->loadMenu();
		$conf = $this->projects_model->loadConf();
		
		$projects = $this->projects_model->getProjects();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('projects/index', array('projects' => $projects));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
	
	public function fast_query(){
		$field = $this->uri->segment(3);
		$vals = $this->uri->segment(4);
		
		$params = array(0=>array('key'=>$field,'val'=>$vals));
		$projects = $this->projects_model->searchProjects($params);
		
		$this->load->view('projects/browser', array('projects' => $projects));
	}
	
	public function new_project()
	{

		logger(array('description'=>'user try to create new project', 'event'=>'Projects new_project'));			

		$menu = $this->projects_model->loadMenu();
		$conf = $this->projects_model->loadConf();
		
        $this->load->model('sales_model');  
		$sales = $this->sales_model->getQuotations(array(0=>array('key'=>'quotations.wf_step','val'=>'sent')));
				
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('projects/new', array('quotations' => $sales));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
	
	public function create()
	{
		$this->load->model('sales_model');  
		$sales = $this->sales_model->getQuotations(array(0=>array('key'=>'quotations.id','val'=>$this->uri->segment(3))));
		
		$this->load->view('projects/create', array('sales'=>$sales));
	}
	
	public function save_project()
	{	
		if($this->uri->segment(3) != ''){
			$prj = $this->db->update('projects', $_POST, array('id' => $this->uri->segment(3)));		
			logger(array('description'=>'user update project ('.$prj.')', 'event'=>'Projects save_project update'));		
		}else{
			$prj = $this->projects_model->createProject($_POST);	
			logger(array('description'=>'user create project ('.$prj.')', 'event'=>'Projects save_project'));
		}
	
		
		$this->index();
		
	}
	
	public function show_project($id = null)
	{
		logger(array('description'=>'user open project ('.$this->uri->segment(3).')', 'event'=>'Projects show_project'));			
		
		if(!$id):
			$this->session->set_userdata('current_project',$this->uri->segment(3));
			$id = $this->session->userdata('current_project');
		else:
			$this->session->set_userdata('current_project',$id);
		endif;
		
		
		$res = $this->projects_model->getProjectComplete(array(0=>array('key'=>'projects.id','val'=>$id)));
				
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('projects/show', array('project' => $res[0], 'items' => $res[1]));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}
	
	public function show_item()
	{
		$item = $this->projects_model->getItem($this->uri->segment(3));
		$this->load->view('projects/item_edit',array('item'=>$item));
	}
	
	public function save_item()
	{
		logger(array('description'=>'user update project item', 'event'=>'Projects save_item'));			
		
		$this->projects_model->saveItem($_POST);
		
		$this->show_project($_POST['project_id']);
	}

	public function create_item()
	{
		logger(array('description'=>'user add item to project', 'event'=>'Projects create_item'));			
		
		$this->db->insert('project_items', $_POST);
		
		$this->show_project($_POST['project_id']);
	}

	public function add_purchase_row()
	{
		$id = $this->session->userdata('current_project');
		$this->db->select('project_items.*, products.name as pname, products.brand as brand');
		$this->db->join('products','products.id = project_items.product_id','left');
		$this->db->order_by('project_items.code ASC');
		$query = $this->db->get_where('project_items', array('project_id'=>$this->uri->segment(3), 'wf_step != ' => 'progress'));
		
		

		$res = $query->result();
		$this->load->view('projects/items_list', array('items'=> $res));
		
	}
	
	public function add_purchase_request_row()
	{
	
		echo 'add_purchase_request_row';	
		$id = $this->session->userdata('current_project');
		$query = $this->db->get_where('project_items', array('project_id'=>$this->uri->segment(3), 'wf_step != ' => 'progress'));
		
		$res = $query->result();
		echo 'Res: '.sizeof($res);
		echo '<br />';
		$this->load->view('projects/items_list_rda', array('items'=> $res));
		
	}
	
	
	public function save_pic()
	{
				
		$config['upload_path'] = './assets/img/avatar/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			print_r($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$config['image_library'] = 'gd2';
			$config['source_image']	= $config['upload_path'].$data['upload_data']['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 48;
			$config['height']	= 48;
			
			$this->load->library('image_lib', $config); 
			
			$this->image_lib->resize();

			logger(array('description'=>'user update project with pic '.$data['upload_data']['file_name'], 'event'=>'Pic added')); 			
			
			$this->db->update('projects', array('userfile' => $data['upload_data']['file_name']), array('id' => $this->session->userdata('current_project')));
			
			$this->show_project($_POST['id']);
		}
	}
	
	public function add_item()
	{
		$this->load->view('projects/add_item');
	}
	
	public function delete_item()
	{
		$query = $this->db->get_where('project_items', array('id' => $this->uri->segment(3)));
		$this->load->view('projects/delete_item_confirm', array('data'=>$query->result()));
	}
	
	public function delete_item_confirm()
	{
		logger(array('description'=>'user delete an item ('.$this->uri->segment(3).') from project', 'event'=>'Projects delete_item'));			
		$this->db->delete('project_items', array('id' => $this->uri->segment(3)));
		$this->show_project($this->uri->segment(4));
	}
	
	public function delete_project()
	{
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('projects/delete_project_confirm');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}

	public function delete_project_confirm()
	{	
		logger(array('description'=>'user delete a project ('.$this->uri->segment(3).') from project', 'event'=>'Projects delete_project'));	
		$query = $this->db->get_where('projects', array('id' => $this->uri->segment(3)));
		foreach($query->result() as $r){
			
		}
		$this->db->insert('projects_deleted', $r);
		$this->db->delete('projects', array('id' => $this->uri->segment(3)));
		$this->index();
	}	
	
	public function sals()
	{
	
		$menu = $this->projects_model->loadMenu();
		$conf = $this->projects_model->loadConf();
		
		
		$this->db->select('attachments.*, projects.title as project_title, projects.name as number, scopes.label, scopes.id as scope_id');
		$this->db->join('projects', 'projects.id = attachments.related_to_id','left');
		$this->db->join('scopes', 'attachments.scope_id = scopes.id','left');		
		$this->db->where('related_to','projects');
		$this->db->where('scope_id','6');
		$this->db->or_where('scope_id','5');		
		$query = $this->db->get('attachments');
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));		
		$this->load->view('projects/sals', array('sals' => $query->result()));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');		
	}	
		
}
?>
