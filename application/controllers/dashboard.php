<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
        $this->load->model('crm_model');        
        $this->load->model('purchases_model');     
        $this->load->model('attachment_model'); 
        $this->load->model('account_model'); 
        $this->load->model('sales_model');         
    }
		
	public function index()
	{
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('dashboard/welcome');
		$this->load->view('tmpl/bottom');
	}
	
	public function add_news()
	{
		$this->db->insert('news', $_POST);
		$this->index();
	}

	public function delete_news()
	{
		$this->db->delete('news', array('id' => $this->uri->segment(3)));
		$this->index();
	}
	
}