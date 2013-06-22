<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crm extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        if (checkRights('crm','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('crm_model');        
    }
		
	public function overview(){
		$this->index();	
	}
	
	public function index()
	{

		logger(array('description'=>'user open CRM module', 'event'=>'CRM index'));			

		$menu = $this->crm_model->loadMenu();
		$conf = $this->crm_model->loadConf();
		$partners = $this->crm_model->getPartners();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('crm/index', array('partners'=>$partners));
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
	
	public function new_partner()
	{
		$menu = $this->crm_model->loadMenu();
		$conf = $this->crm_model->loadConf();		
		$partners = $this->crm_model->getPartners();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu));		
		$this->load->view('crm/new_partner', array('action'=>'add'));
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');
	}
	
	public function save_partner()
	{
		if(!isset($_POST['id'])):
			$partner_id = $this->crm_model->createPartner($_POST);
			logger(array('description'=>'partner created ('.$_POST['name'].')', 'event'=>'save_partner'));
		else:
			$partner_id = $this->crm_model->updatePartner($_POST);
			logger(array('description'=>'partner updated ('.$_POST['name'].')', 'event'=>'save_partner'));			
		endif;
		
		$this->show_partner($partner_id);			
	}
	
	public function show_partner($id = null)
	{
		$menu = $this->crm_model->loadMenu();
		$conf = $this->crm_model->loadConf();		

		$this->session->set_userdata('current_partner',$id);		
		
		$params = array();
		if($id):
			$params = array(0 => array('key' => 'id', 'val' => $id));
		endif;
		
		$params2 = array();
		if($id):
			$params2 = array(0 => array('key' => 'partner_id', 'val' => $id));
		endif;

		$partners = $this->crm_model->getPartners($params);
		$contacts = $this->crm_model->getContacts($params2); 
		$history = $this->crm_model->getHistory($params2); 
		$invoices = $this->crm_model->getInvoices($params2);
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu));		
		$this->load->view('crm/show_partner', array('partners'=>$partners,
													'contacts'=>$contacts,
													'history'=>$history,
													'invoices' =>$invoices));
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');
	}
	
	public function update_partner_name()
	{
		$id = $this->uri->segment(3);
		$name = $this->uri->segment(4);
		$name = str_replace('%20', ' ', $name);
		$this->db->update('partners', array('name'=>$name), array('id'=>$id));
		echo $name;
	}
	
	public function address_switch($id = null)
	{
		$id = $this->uri->segment(3);
		$this->load->view('crm/_contacts-form-part', array('address_kind'=>$id));
	}
	
	public function save_address()
	{
		// check if exists
		$query = $this->db->get_where('partner_addresses', array('partner_id'=>$_POST['partner_id'], 
														   'address_kind'=>$_POST['address_kind']));
		$res = $query->result();

		if(sizeof($res) > 0):
			$id = $res[0]->id;
			$this->db->update('partner_addresses', $_POST, array('id'=>$id));
			echo "updated";
			logger(array('description'=>'partner address updated ('.$_POST['partner_id'].')', 'event'=>'save_address'));
		else:
			$this->db->insert('partner_addresses', $_POST);
			logger(array('description'=>'partner address created ('.$_POST['partner_id'].')', 'event'=>'save_address'));			
			echo "created";
		endif;
	}
	
	
	// contacts
	public function contact_new(){
		if($this->uri->segment(3)):
			$id = $this->uri->segment(3);
		else:
			$id = 0;
		endif;
		$this->load->view('crm/_contacts-form-new', array('id'=>$id));
	}
	
	
	public function save_contact()
	{
		// check if exists
		$this->db->where('partner_id',$_POST['partner_id']);
		if(isset($_POST['id'])):
			$this->db->where('partner_id',$_POST['id']);	
		endif;
		
		$query = $this->db->get('contacts');
		
		$res = $query->result();

		if(sizeof($res) > 0):
			$id = $res[0]->id;
			$this->db->update('contacts', $_POST, array('id'=>$id));
			echo "updated";
			logger(array('description'=>'contact info updated ('.$_POST['partner_id'].')', 'event'=>'save_contact'));
		else:
			$this->db->insert('contacts', $_POST);	
			echo "created";
			logger(array('description'=>'contact record created ('.$_POST['partner_id'].')', 'event'=>'save_contact'));				
		endif;
	}	
	
	// importer
	
	public function importer()
	{
		$menu = $this->crm_model->loadMenu();
		$conf = $this->crm_model->loadConf();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('importer/importer');
		$this->load->view('tmpl/closing');				
		$this->load->view('tmpl/bottom');
	}	
	
	public function settings()
	{
		logger(array('description'=>'user open settings in CRM module', 'event'=>'CRM settings'));			

		$menu = $this->crm_model->loadMenu();
		$conf = $this->crm_model->loadConf();
		$partners = $this->crm_model->getPartners();
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('crm/settings');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
		
	}

	public function delete_partner()
	{
		$query = $this->db->get_where('partners', array('id' => $this->uri->segment(3)));
		$this->load->view('crm/delete_partner_confirm', array('data'=>$query->result()));
	}
	
	public function delete_partner_confirm()
	{
		$this->db->update('partners', array('status'=>0), array('id'=>$this->uri->segment(3)));
		$this->index();
	}
			
}