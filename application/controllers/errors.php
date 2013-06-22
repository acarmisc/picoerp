<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller {
	
 	public function __construct()
    {
        parent::__construct();
    }
		
	public function notallowed()
	{
		logger(array('description'=>'User try to access a not allowed page ('.$this->uri->segment(1).')', 'event'=>'notallowed'));

		$this->load->view('tmpl/top');
 		if($this->session->userdata('u_logged_in')){ $this->load->view('tmpl/nav'); }
		$this->load->view('errors/notallowed');
		$this->load->view('tmpl/bottom');
		
	}
}
