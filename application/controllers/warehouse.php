<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (checkRights('warehouse','view','live') != true):	redirect('errors/notallowed');	endif;
        $this->load->model('warehouse_model');        
        $this->load->model('sales_model');                                     
    }

	public function index()
	{

		logger(array('description'=>'user open Warehouse module', 'event'=>'Warehouse index'));			

		$menu = $this->warehouse_model->loadMenu();
		$conf = $this->warehouse_model->loadConf();
		
		
		$this->load->view('tmpl/top');
		$this->load->view('tmpl/nav');
		$this->load->view('tmpl/local', array('menu'=>$menu, 'conf'=>$conf));
		$this->load->view('warehouse/list');
		$this->load->view('tmpl/closing');		
		$this->load->view('tmpl/bottom');
	}
}